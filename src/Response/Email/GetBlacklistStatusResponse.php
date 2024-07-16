<?php

namespace BlacklistHubBridge\Response\Email;

use BlacklistHubBridge\Dto\Email\BlacklistCheckStatusDto;
use BlacklistHubBridge\Enum\Blacklist\BlacklistStatusEnum;
use BlacklistHubBridge\Exception\MalformedJsonException;
use BlacklistHubBridge\Request\Email\GetBlacklistStatusRequest;
use BlacklistHubBridge\Response\BaseResponse;
use BlacklistHubBridge\Service\Serializer\SerializerService;
use Exception;

/**
 * Response containing information if given email address were blacklisted, and what's the
 * blacklist status
 * - {@see GetBlacklistStatusRequest}
 */
class GetBlacklistStatusResponse extends BaseResponse
{
    /**
     * @var BlacklistCheckStatusDto[] $blacklistCheckResults
     */
    private array $blacklistCheckResults = [];

    /**
     * @return BlacklistCheckStatusDto[]
     */
    public function getBlacklistCheckResults(): array
    {
        return $this->blacklistCheckResults;
    }

    /**
     * @param BlacklistCheckStatusDto[] $blacklistCheckResults
     */
    public function setBlacklistCheckResults(array $blacklistCheckResults): void
    {
        $this->blacklistCheckResults = $blacklistCheckResults;
    }

    /**
     * Check if any information about E-Mail address has been returned at all
     *
     * @param string $emailAddress
     *
     * @return bool
     */
    public function hasRecipientEmail(string $emailAddress): bool
    {
        foreach ($this->blacklistCheckResults as $checkResult) {
            if ($checkResult->getEmailBlacklistSearchDto()->getRecipient() === $emailAddress) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $emailAddress
     *
     * @return string
     *
     * @throws Exception
     */
    public function getStatusForRecipient(string $emailAddress): string
    {
        foreach ($this->blacklistCheckResults as $checkResult) {
            if ($checkResult->getEmailBlacklistSearchDto()->getRecipient() === $emailAddress) {
                return $checkResult->getStatus();
            }
        }

        throw new Exception("Recipient E-Mail address not found in check results");
    }

    /**
     * @param string $emailAddress
     *
     * @return bool
     *
     * @throws Exception
     */
    public function isRecipientBlacklisted(string $emailAddress): bool
    {
        if (!$this->hasRecipientEmail($emailAddress)) {
            return false;
        }

        $status = $this->getStatusForRecipient($emailAddress);

        return (
                $status === BlacklistStatusEnum::BLOCKED_ENTIRE_HOST->name
            ||  $status === BlacklistStatusEnum::BLOCKED->name
        );
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
        $response                 = parent::prefillBaseFieldsFromJsonString($json);
        $dataArray                = json_decode($json, true);
        $blacklistCheckStatusData = $dataArray['blacklistCheckStatusData'];
        $checkResultDtos          = array_map(
            fn(string $statusJson) => SerializerService::getSerializer()->deserialize($statusJson, BlacklistCheckStatusDto::class, "json"),
            $blacklistCheckStatusData
        );

        $response->setBlacklistCheckResults($checkResultDtos);

        return $response;
    }

}