<?php

namespace BlacklistHubBridge\Response\Email;

use BlacklistHubBridge\Exception\MalformedJsonException;
use BlacklistHubBridge\Request\Email\GetBlacklistingSingleEmailUrlRequest;
use BlacklistHubBridge\Response\BaseResponse;

/**
 * Response for:
 * - {@see GetBlacklistingSingleEmailUrlRequest}
 */
class GetBlacklistingSingleEmailUrlResponse extends BaseResponse
{
    /**
     * @var string $url
     */
    public string $url;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * {@inheritDoc}
     * @param string $json
     *
     * @return $this
     * @throws MalformedJsonException
     */
    public function prefillBaseFieldsFromJsonString(string $json): static
    {
        $response  = parent::prefillBaseFieldsFromJsonString($json);
        $dataArray = json_decode($json, true);
        $url       = $dataArray['url'];

        $response->setUrl($url);

        return $response;
    }

}