<?php 

namespace local_newsvnr\api\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class OrgstructureCategoryName extends AbstractRule
{
    public function validate($input): bool
    {
    	$check_categoryname =  find_orgstructure_category_by_name($input);
		if($check_categoryname) {
			return false;
		}
	    return true;
    }
}