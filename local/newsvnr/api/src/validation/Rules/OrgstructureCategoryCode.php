<?php 

namespace local_newsvnr\api\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class OrgstructureCategoryCode extends AbstractRule
{
    public function validate($input): bool
    {
    	$check_categorycode =  find_orgstructure_category_by_code($input);
		if($check_categorycode) {
			return false;
		}
	    return true;
    }
}