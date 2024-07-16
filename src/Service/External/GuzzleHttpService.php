<?php

namespace BlacklistHubBridge\Service\External;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GuzzleHttpService
{
    /**
     * @var Client $client
     */
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    const KEY_JSON    = "json";
    const KEY_HEADERS = "headers";

    /**
     * @param string $calledUrl
     * @param array $dataBag
     * @param array $headers
     * @return string
     * @throws GuzzleException
     */
    public function sendPostRequest(string $calledUrl, array $dataBag = [], array $headers = []): string
    {
        $response = $this->client->post($calledUrl, [
            self::KEY_JSON    => $dataBag,
            self::KEY_HEADERS => $headers,
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @param string $calledUrl
     * @param array $headers
     * @return string
     * @throws GuzzleException
     */
    public function sendGetRequest(string $calledUrl, array $headers = []): string
    {
        $response = $this->client->get($calledUrl, [
            self::KEY_HEADERS => $headers,
        ]);

        return $response->getBody()->getContents();
    }

}