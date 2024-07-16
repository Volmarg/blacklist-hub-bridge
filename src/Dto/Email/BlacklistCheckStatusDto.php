<?php

namespace BlacklistHubBridge\Dto\Email;

/**
 * Represents the result of searching for the blacklisted emails
 */
class BlacklistCheckStatusDto
{
    /**
     * @param string                  $status
     * @param EmailBlacklistSearchDto $emailBlacklistSearchDto
     */
    public function __construct(
        private readonly string                  $status,
        private readonly EmailBlacklistSearchDto $emailBlacklistSearchDto,
    ){

    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return EmailBlacklistSearchDto
     */
    public function getEmailBlacklistSearchDto(): EmailBlacklistSearchDto
    {
        return $this->emailBlacklistSearchDto;
    }

}
