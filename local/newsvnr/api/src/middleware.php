<?php
// Application middleware

// Khai báo Authentication cho API dùng JWT
// Truy cập https://github.com/tuupola/slim-jwt-auth để xem hướng dẫn
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "path"      => [
	    				"/users","/user",
	    				"/orgstructures","/orgstructure",
	    				"/quizes","quiz",
	    				"/courses",
	    				"/competencies",
	    				// "/course-category",
    				],
    "ignore"    => ["/api/token"],
    "secure"    => false,
    "error" 	=> function ($response, $arguments) {
    	// switch (json_last_error()) {
	    //     case JSON_ERROR_NONE:
	    //         $arguments["message"] = 'No errors';
	    //     break;
	    //     case JSON_ERROR_DEPTH:
	    //         $arguments["message"] = 'Maximum stack depth exceeded';
	    //     break;
	    //     case JSON_ERROR_STATE_MISMATCH:
	    //         $arguments["message"] = 'Underflow or the modes mismatch';
	    //     break;
	    //     case JSON_ERROR_CTRL_CHAR:
	    //         $arguments["message"] = 'Unexpected control character found';
	    //     break;
	    //     case JSON_ERROR_SYNTAX:
	    //         $arguments["message"] = 'Xác thực không thành công!';
	    //     break;
	    //     case JSON_ERROR_UTF8:
	    //         $arguments["message"] = 'Malformed UTF-8 characters, possibly incorrectly encoded';
	    //     break;
	    //     default:
	    //         $arguments["message"] = 'Unknown error';
	    //     break;
    	// }
    	$data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json;charset=utf-8")
            ->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    },
    // "header" 	=> "X-Token",
    // "regexp"    => "/(.*)/",
    "secret"    => "5U3Gn3gp4LrQpS34d7Gjxxxx",
    "algorithm" => ["HS512"],
    "logger"    => $container->get("logger"),
    "attribute" => "jwt"
]));

