<?php
/**
 * Created by PhpStorm.
 * User: selecto
 * Date: 25.09.18
 * Time: 11:55
 */

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class EmailAvailableException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Email is already taken'
        ]
    ];
}