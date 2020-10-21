<?php 

namespace local_newsvnr\api\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class OrgstructureCategoryCodeException extends ValidationException
{	
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Mã loại phòng ban đã tồn tại',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Mã loại phòng ban đã tồn tại',
        ],
    ];
}