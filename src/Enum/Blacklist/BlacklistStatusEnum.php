<?php

namespace BlacklistHubBridge\Enum\Blacklist;

/**
 * Statuses describing the state of resource blacklist
 */
enum BlacklistStatusEnum
{
    case NOT_BLOCKED;
    case BLOCKED;
    case DIRECTIONAL_BLOCK;
    case BLOCKED_ENTIRE_HOST; // for E-Mails only
}