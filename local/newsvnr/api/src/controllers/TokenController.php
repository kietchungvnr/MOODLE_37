<?php 

namespace local_newsvnr\api\controllers;

use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;
use Firebase\JWT\JWT;

defined('MOODLE_INTERNAL') || die;

class TokenController extends BaseController
{

   	public function __construct($container) {
      	parent::__construct($container);
   	}

   	public function checkUser($username,$password) {
   		global $DB;
	    $sql = "
	            SELECT u.id, u.username, u.password
	            FROM {user} AS u 
	            WHERE u.username =  ?";
	    $findUser = $DB->get_record_sql($sql, array($username));
	    if($findUser)
	    {
	        $checkAuthenticate = password_verify($password, $findUser->password);
	        return $checkAuthenticate; 
	    }
   	}
   	
    public function getToken($request, $response, $args) {
	    // error_reporting(E_ALL & ~E_NOTICE);
	    $checkUser = $this->checkUser($request->getParam('username'),$request->getParam('password'));
	    if($checkUser) {
	    	$this->logger->info("Xác thực thành công!");
	        $settings = $this->settings;
	        $tokenId = Uuid::uuid1()->toString();
	        $issuedAt = time();
	        $notBefore = $issuedAt;
	        $expire = $notBefore + 60 * 600;
	        $serverName = $this->request->withUri($this->request->getUri(), true);
	        $token = JWT::encode([
	            'iat'  => $issuedAt,         // Issued at: time when the token was generated
	            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
	            'iss'  => $serverName,       // Issuer
	            'nbf'  => $notBefore,        // Not before
	            'exp'  => $expire,
	        ], "5U3Gn3gp4LrQpS34d7Gjxxxx", "HS512");
	        return $this->response->withJson(['token_type' => 'Bearer', 'access_token' => $token]);
	    } else {
	    	return $this->response->withJson(['message' => 'Sai tên đăng nhập hoặc mật khẩu!']);
	    }
        
    }
   
}