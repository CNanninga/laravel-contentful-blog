<?php
namespace App\Services;

use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GraphqlClient
{
    const RETRY_ATTEMPTS = 3;
    const RETRY_DELAY = 100;

    public function execute(
        string $url,
        string $token,
        string $query,
        ?array $variables = null
    ): array {
        $data = ['query' => $query];
        if ($variables !== null) {
            $data['variables'] = $variables;
        }

        try {
            $response = Http::retry(self::RETRY_ATTEMPTS, self::RETRY_DELAY)
                ->withToken($token)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->asJson()
                ->post($url, $data);

            $result = $response->json();
        } catch (HttpClientException $e) {
            Log::error($e->getMessage());
            $result = [];
        }

        return $result;
    }
}
