<?php

namespace BlacklistHubBridge\Request\Email;

use BlacklistHubBridge\Request\BaseRequest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Request for getting url that can be used for blacklisting single E-Mail address
 * - {@see GetBlacklistStatusResponse}
 */
class GetBlacklistingSingleEmailUrlRequest extends BaseRequest
{
    private const URI = "api/lp/get/add-to-blacklist-url/";

    /**
     * @var string $recipient
     */
    private string $recipient;

    /**
     * @var string|null $fromAddress
     */
    private ?string $fromAddress = null;

    /**
     * @return string
     */
    public function getRecipient(): string
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     */
    public function setRecipient(string $recipient): void
    {
        $this->recipient = $recipient;
    }

    /**
     * @return string|null
     */
    public function getFromAddress(): ?string
    {
        return $this->fromAddress;
    }

    /**
     * @param string|null $fromAddress
     */
    public function setFromAddress(?string $fromAddress): void
    {
        $this->fromAddress = $fromAddress;
    }

    /**
     * {@inherticdoc}
     */
    public function getRequestUri(): string
    {
        $uri = self::URI . $this->getRecipient();
        if (!empty($this->getFromAddress())) {
            $uri .= "/" . $this->getFromAddress();
        }

        return $uri;
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return Request::METHOD_GET;
    }
}