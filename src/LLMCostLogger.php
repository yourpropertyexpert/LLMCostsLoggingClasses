<?php

/**
 * LLMCostLogger class
 * @copyright Mark Harrison 2025
 * @package llmcosts/llm-cost-logger
 */

namespace LLMCosts;


class LLMCostLogger
{
    private \GuzzleHttp\Client $client;
    private const string URI ="https://llmcosts.fyi/api/logcall";

    // Constructor property promotion
    public function __construct(private string $key = "")
    {
        if ($key = "") {
            throw new \Exception("No Key Provided");
        }
        $this->client = new \GuzzleHttp\Client();
    }

    public function logCall(string $provider, array $body)
    {
        if ($provider == "OpenAI") {
            // Attempt to strip response content leaving only the metadata
            $body["choices"] = [];
        }
        // Make a Guzzle HTTP call
        try {
            $response = $this->client->post(self::URI, [
                'form_params' => [
                    'apikey' => $this->key,
                    'provider' => $provider,
                    'body' => json_encode($body),
                ],
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new \Exception("Failed to log call: " . $e->getMessage());
        }
    }
}
