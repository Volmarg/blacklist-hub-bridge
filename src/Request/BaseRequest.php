<?php

namespace BlacklistHubBridge\Request;

/**
 * Base class for building any bridge between services
 *
 * @package BlacklistHubBridge\Request
 */
abstract class BaseRequest
{
    /**
     * Request Uri to be called
     *
     * @return string
     */
    public abstract function getRequestUri(): string;

    /**
     * GET, POST etc.
     *
     * @return string
     */
    public abstract function getRequestMethod(): string;

}