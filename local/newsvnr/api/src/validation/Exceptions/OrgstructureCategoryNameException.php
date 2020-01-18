<?php 

namespace local_newsvnr\api\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class OrgstructureCategoryNameException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Tên phòng ban đã được sử dụng',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Tên phòng ban đã được sử dụng',
        ],
    ];
}