<?php
namespace App\Services\BlogContentfulRepository;

use App\Contracts\Blog\Post;
use App\Services\ContentfulClient;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class Posts
{
    const QUERY = '
query getPosts(
    $limit: Int,
    $skip: Int
) {
    postCollection(
        order: [publishDate_DESC],
        limit: $limit,
        skip: $skip
    ) {
        total
        skip
        limit
        items {
            title
            slug
            description
            publishDate
            contentItemsCollection {
                items {
                    ... on ContentText {
                        content
                    }
                    ... on ContentImage {
                        image: content {
                            description
                            url
                        }
                    }
                }
            }
        }
    }
}
';

    private ContentfulClient $client;

    public function __construct(
        ContentfulClient $client
    ) {
        $this->client = $client;
    }

    public function execute(
        int $limit = 10,
        int $skip = 0
    ): array {
        $variables = [
            'limit' => $limit,
            'skip' => $skip,
        ];

        $posts = [];
        $totalPosts = 0;

        try {
            $result = $this->client->execute(self::QUERY, $variables);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        if (isset($result['data']['postCollection']['items'])) {
            $totalPosts = $result['data']['postCollection']['total'] ?? 0;
            foreach ($result['data']['postCollection']['items'] as $postData) {
                $posts[] = App::makeWith(Post::class, ['graphqlData' => $postData]);
            }
        }

        return [$posts, $totalPosts];
    }
}
