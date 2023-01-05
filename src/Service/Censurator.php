<?php

namespace App\Service;

class Censurator
{

    public const CENSORED_WORDS = [
        'suicide',
        'tuer',
        'mort',
        'enterrer'
    ];

    /**
     * Purify a string
     *
     * @param string $string
     * @return string
     */
    public function purify($string)
    {

        foreach (self::CENSORED_WORDS as $word) {
            if (($pos = strpos(strtolower($string), $word)) !== false) {
                $string = substr_replace(
                    $string,
                    implode('', array_fill(1, strlen($word), '*')),
                    $pos,
                    strlen($word)
                );
            }
        }

        return $string;
    }
}
