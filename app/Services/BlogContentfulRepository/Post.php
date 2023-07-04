<?php
namespace App\Services\BlogContentfulRepository;

use App\Contracts\Blog\Post as PostModel;
use App\Services\ContentfulClient;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class Post
{
    const QUERY = '
query getPost(
    $slug: String!
){
    postCollection(
        limit: 1,
        where: {slug: $slug}
    ) {
        items {
            title
            slug
            description
            publishDate
            image {
                description
                url
            }
            contentItemsCollection {
                items {
                    __typename
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
        string $slug = ''
    ): ?PostModel {
        $variables = [
            'slug' => $slug,
        ];

        $post = null;

        try {
            $result = $this->client->execute(self::QUERY, $variables);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        if (isset($result['data']['postCollection']['items'][0])) {
            $post = App::makeWith(PostModel::class, ['graphqlData' => $result['data']['postCollection']['items'][0]]);
        }

        return $post;
    }
}
