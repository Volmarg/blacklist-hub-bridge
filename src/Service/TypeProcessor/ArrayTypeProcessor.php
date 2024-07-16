<?php

namespace BlacklistHubBridge\Service\TypeProcessor;

/**
 * Provides logic for handling arrays
 */
class ArrayTypeProcessor
{
    /**
     * Takes an array and searches for value in it by using dot separated string such as:
     * - "word1.word2.word3"
     *
     * @param array       $arrayToSearchInto
     * @param string|null $parsedString
     *
     * @return mixed
     */
    public static function getDataFromArrayByDotSeparatedString(array $arrayToSearchInto, ?string $parsedString): mixed
    {
        $arrayOfKeys    = self::dotSeparatedStringToArrayOfKeys($parsedString);
        $traversedValue = $arrayToSearchInto;
        $countOfKeys    = count($arrayOfKeys) - 1;

        foreach ($arrayOfKeys as $index => $key) {

            $traversedValue = $traversedValue[$key] ?? null;
            if (
                    !is_array($traversedValue)
                ||  $index === $countOfKeys
            ) {
                return $traversedValue;
            }
        }

        return null;
    }

    /**
     * Takes string in form:
     * - "word.word2.word3"
     *
     * Turns it into
     * - ["word", "word2", "word3"]
     *
     * @param string $parsedString
     *
     * @return array
     */
    public static function dotSeparatedStringToArrayOfKeys(string $parsedString): array
    {
        $arrayOfKeys = explode(".", $parsedString);

        return $arrayOfKeys;
    }

}