<?php 

namespace local_newsvnr\api\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface as Container;


class BaseController {

	protected $container;
   	protected $logger;
   	protected $settings;
   	protected $request;
   	protected $response;
    protected $validator;
    protected $v;

   	public function __construct(Container $container) {
   		$this->container = $container;
        $this->logger = $container['logger'];
        $this->settings = $container['settings'];
        $this->validator = $container['validator'];
        $this->response = $container['response'];
        $this->request = $container['request'];
        $this->v = $container['v'];
   	}

    public function validate() {
        //Khai báo new rules cho validation
        $this->v::with('local_newsvnr\\api\\Validation\\Rules\\');
        $this->validate = $this->validator->validate($this->request, [
            'name' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'code' => $this->v::notEmpty()->notBlank(),
        ]);
    }
}