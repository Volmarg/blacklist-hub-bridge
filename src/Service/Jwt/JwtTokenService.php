<?php

namespace BlacklistHubBridge\Service\Jwt;

use DateTime;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Provides base logic for jwt tokens handling
 */
class JwtTokenService
{
    // must be in sync with what's set in blacklist hub
    private const ID_FIELD_NAME      = "UserIdentifier";
    private const FIELD_MAX_LIFETIME = "exp";

    public function __construct(
        private readonly JWTEncoderInterface   $encoder,
        private readonly ParameterBagInterface $parameterBag
    ){}

    /**
     * @return string
     * @throws JWTEncodeFailureException
     */
    public function encode(): string
    {
        $expirationStamp = (new DateTime())->modify("+" . $this->parameterBag->get("jwt_lifetime_hours") . " HOURS")->getTimestamp();

        $data = [
            self::ID_FIELD_NAME      => $this->parameterBag->get("jwt_user_name"),
            self::FIELD_MAX_LIFETIME => $expirationStamp,
        ];

        return $this->encoder->encode($data);
    }

}
