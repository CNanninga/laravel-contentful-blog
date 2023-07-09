<?php
namespace App\Services\BlogContentfulRepository;

use App\Contracts\Blog\Author;
use App\Contracts\Blog\Publication;
use App\Services\ContentfulClient;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class PublicationsAndAuthor
{
    const TYPE_COURSE = 'Training Course';

    const COURSE_FILTER_TRUE = 'where: {type: "' . self::TYPE_COURSE . '"}';
    const COURSE_FILTER_FALSE = 'where: {type_not: "' . self::TYPE_COURSE . '"}';

    const QUERY = '
query getPublicationsAndAuthor(
    $limit: Int,
    $skip: Int
) {
    publicationCollection(
        order: [publishDate_DESC]
        limit: $limit,
        skip: $skip,
        ${COURSE_FILTER}
    ) {
        total
        skip
        limit
        items {
            title
            url
            description
            publishDate
            source
            type
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
            enableBlogPosts
        }
    }
}
';
    private ContentfulClient $client;

    public function __construct(
        ContentfulClient $contentfulClient
    ) {
        $this->client = $contentfulClient;
    }

    public function execute(
        int $limit = 10,
        int $skip = 0,
        bool $courses = false
    ): array {
        $variables = [
            'limit' => $limit,
            'skip' => $skip,
        ];

        $author = null;
        $pubs = [];
        $totalPubs = 0;

        try {
            $result = $this->client->execute($this->getQuery($courses), $variables);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        if (isset($result['data']['publicationCollection']['items'])) {
            $totalPubs = $result['data']['publicationCollection']['total'] ?? 0;
            foreach ($result['data']['publicationCollection']['items'] as $pubData) {
                $pubs[] = App::makeWith(Publication::class, ['graphqlData' => $pubData]);
            }
        }
        if (isset($result['data']['authorCollection']['items'][0])) {
            $author = App::makeWith(Author::class, ['graphqlData' => $result['data']['authorCollection']['items'][0]]);
        }

        return [$pubs, $author, $totalPubs];
    }

    private function getQuery(bool $courses = false) : string
    {
        $filter = ($courses) ? self::COURSE_FILTER_TRUE : self::COURSE_FILTER_FALSE;
        return str_replace('${COURSE_FILTER}', $filter, self::QUERY);
    }
}
