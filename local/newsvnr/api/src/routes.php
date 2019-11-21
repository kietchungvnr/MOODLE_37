<?php 

$app->get('/token', local_newsvnr\api\controllers\TokenController::class . ':getToken');
$app->get('/users', local_newsvnr\api\controllers\UsersController::class . ':getUser');
$app->post('/orgstructures/add', local_newsvnr\api\controllers\OrgstructureCategoryController::class . ':create');


// $app->get('/user/{id}', function (Request $request, Response $response) {
//     global $DB;
//     $this->logger->info("Lấy thông tin user ....!");
//     $id = $request->getAttribute('id');
//     $arr = $DB->get_records('user', ['id' => $id]); 
//     return $this->response->withJson($arr);
    
// });



// $nameValidator = v::alnum()->noWhitespace()->length(1, 10);
// $codeValidator = v::alnum()->noWhitespace()->length(1, 20);
// $validators = array(
//   'name' => $nameValidator,
//   'code' => $codeValidator
// );


// $app->add(new \DavidePastore\Slim\Validation\Validation($validators));



// $app->get('/orgstructures/{id}', function (Request $request, Response $response) {
//     global $DB;

//     $id = $request->getAttribute('id');
//     $arr = $DB->get_records('user', ['id' => $id]); 
//     return $response->withJson($arr);
    
// });

// $app->post('/orgstructures/add', function (Request $request, Response $response) {
// 	// if($request->getAttribute('has_errors')){
//  //    	$errors = $request->getAttribute('errors');
//  //    	return $response->withJson($errors);
//  //    } else {
//  //    	global $DB;
// 	//     $name = $request->getParam('name');
// 	//     $code = $request->getParam('code');
// 	//     $description = $request->getParam('description');
// 	//     $arr = '';
// 	//     try {
// 	//     	$arr .= "ĐC ròi";

// 	//     } catch(Exception $e) {
// 	//     	echo "$strerror: ",  $e->getMessage(), "\n";
// 	//     	die;
// 	//     }
// 	//     return $response->withJson($arr);
//  //    }
    
    
    
//     $container = new Awurth\SlimValidation\Validator();
    // $defaultMessages = [
    //     'length' => 'This field must have a length between {{minValue}} and {{maxValue}} characters',
    //     'notBlank' => 'This field is required'
    // ];
//     $validator = $container->validate($request, [
//     'name' => [
//         'rules' => v::notEmpty()->notBlank(),
//         'message' => 'Không rỗng, không khoảng trắng và từ 1 đến 10 ký tự'
//     ],

//      // 'code' => v::alnum()->noWhitespace()->length(1, 10)
//     ]);

//     if ($validator->isValid()) {
//        echo "okay";
//     } else {
//         $errors = $validator->getErrors();
//         return $response->withStatus(200)->withJson($errors);
//     }


    
// });

// $app->get("/token", function (Request $request, Response $response) {

//     $settings = $this->get('settings');
//     $tokenId = Uuid::uuid1()->toString();
//     $issuedAt = time();
//     $notBefore = $issuedAt;
//     $expire = $notBefore + 60 * 60;
//     $serverName = $request->withUri($request->getUri(), true);
//     $token = JWT::encode([
//         'iat'  => $issuedAt,         // Issued at: time when the token was generated
//         'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
//         'iss'  => $serverName,       // Issuer
//         'nbf'  => $notBefore,        // Not before
//         'exp'  => $expire,
//         'dta' => [ // payload
//             'id' => 1,
//             'email' => 'johndoe@domain.com'
//         ]
//     ], "5U3Gn3gp4LrQpS34d7Gj", "HS512");
//     var_dump($token);die;
//     return $response->withJson(['token' => $token]);
// });
// $app->delete("/item/{id}", function ($request, $response, $arguments) {
//     $token = $request->getAttribute("token");
//     if (in_array("delete", $token["scope"])) {
//         /* Code for deleting item */
//     } else {
//         /* No scope so respond with 401 Unauthorized */
//         return $response->withStatus(401)->withJson(['aa' => 'xxx']);
//     }
// });

