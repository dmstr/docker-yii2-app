<?php
/**
 * Created by PhpStorm.
 * User: Pavel Tsvetkov
 * Date: 09.08.2018
 * Time: 11:29
 */

namespace app\enums;

/**
 * Class TransferTypeEnum
 * @package app\controllers
 */
/**
 * Class TransferTypeEnum
 * @package app\enums
 */
class TransferTypeEnum
{
    /** @const int */
    const FILL = 1;
    /** @const int */
    const TRANSFER = 2;

    /**
     * @param $type
     * @return string
     */
    public static function getTypeName($type)
    {
        switch ($type) {
            case self::FILL:
                $answer = 'Refill';
                break;
            case self::TRANSFER:
                $answer = 'Transfer';
                break;
            default:
                $answer = 'undefined';
                break;
        }

        return $answer;
    }
}
