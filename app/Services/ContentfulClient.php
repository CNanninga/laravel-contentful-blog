<?php
namespace App\Services;

class ContentfulClient
{
    private GraphqlClient $client;

    public function __construct(
        GraphqlClient $client
    ) {
        $this->client = $client;
    }

    /**
     * @throws \Exception
     */
    public function execute(
        string $query,
        ?array $variables = null
    ): array {
        $url = config('blog.cms_base_url');
        $token = config('blog.cms_token');

        if (!$url || !$token) {
            throw new \Exception('No config values set for CMS GraphQL');
        }

        return $this->client->execute($url, $token, $query, $variables);
    }
}
