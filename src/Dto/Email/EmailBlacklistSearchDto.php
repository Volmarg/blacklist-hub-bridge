<?php

namespace BlacklistHubBridge\Dto\Email;

/**
 * Dto used for searching blacklisted address
 */
class EmailBlacklistSearchDto
{
    /**
     * @param string      $recipient
     * @param string|null $fromAddress - Can be null, because maybe the check should be just for the recipient generally
     */
    public function __construct(
        private string  $recipient,
        private ?string $fromAddress = null
    ){

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

}
