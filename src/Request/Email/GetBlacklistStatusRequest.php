<?php

namespace BlacklistHubBridge\Request\Email;

use BlacklistHubBridge\Dto\Email\EmailBlacklistSearchDto;
use BlacklistHubBridge\Request\BaseRequest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Request for fetching information about the emails blacklist status
 * - {@see GetBlacklistStatusResponse}
 */
class GetBlacklistStatusRequest extends BaseRequest
{
    private const URI = "api/blacklist/email/check";

    private array $emailBlacklistSearchDtos = [];

    /**
     * @return EmailBlacklistSearchDto[]
     */
    public function getEmailBlacklistSearchDtos(): array
    {
        return $this->emailBlacklistSearchDtos;
    }

    /**
     * @param EmailBlacklistSearchDto[] $emailBlacklistSearchDtos
     */
    public function setEmailBlacklistSearchDtos(array $emailBlacklistSearchDtos): void
    {
        $this->emailBlacklistSearchDtos = $emailBlacklistSearchDtos;
    }

    /**
     * {@inherticdoc}
     */
    public function getRequestUri(): string
    {
        return self::URI;
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return Request::METHOD_POST;
    }
}