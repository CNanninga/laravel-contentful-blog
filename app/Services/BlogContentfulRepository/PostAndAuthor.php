<?php
namespace App\Services\BlogContentfulRepository;

use App\Contracts\Blog\Author;
use App\Contracts\Blog\Post as PostModel;
use App\Services\ContentfulClient;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class PostAndAuthor
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
            displayDate
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
    authorCollection(
        limit: 1
    ){
        items {
            name
            image {
                description
                url
            }
            tagLine
            linkedInUrl
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
    ): array {
        $variables = [
            'slug' => $slug,
        ];

        $post = null;
        $author = null;

        try {
            $result = $this->client->execute(self::QUERY, $variables);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        if (isset($result['data']['postCollection']['items'][0])) {
            $post = App::makeWith(PostModel::class, ['graphqlData' => $result['data']['postCollection']['items'][0]]);
        }
        if (isset($result['data']['authorCollection']['items'][0])) {
            $author = App::makeWith(Author::class, ['graphqlData' => $result['data']['authorCollection']['items'][0]]);
        }

        return [$post, $author];
    }
}
