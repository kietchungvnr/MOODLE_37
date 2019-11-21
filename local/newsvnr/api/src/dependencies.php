<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
// $container['renderer'] = function ($c) {
//     $settings = $c->get('settings')['renderer'];
//     return new Slim\Views\PhpRenderer($settings['template_path']);
// };

//Khai bái monolog để ghi logs 
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

//Khai báo validator (không có custom)
$container['v'] = function () {
    return new Respect\Validation\Validator();
};

//Khai báo validator (có custom) cho các field
$container['validator'] = function () {
    //Custom messages mặc định của validator
	$defaultMessages = [
	        'notBlank' => 'Thiếu trường này',
	        'notEmpty' => 'Trường này không được phép rỗng',
	        'noWhitespace' => 'Trường này không được chứa khoảng trắng'
	    ];
    return new Awurth\SlimValidation\Validator(false,$defaultMessages);
};



