<?php 

namespace local_newsvnr\api\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class MyRule extends AbstractRule
{
    public function validate($input): bool
    {
       return false;
    }
}