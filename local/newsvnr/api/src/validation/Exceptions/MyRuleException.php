<?php 

namespace local_newsvnr\api\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class MyRuleException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Con ga.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Ga con.',
        ],
    ];
}