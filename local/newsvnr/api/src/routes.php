<?php 

$app->get('/token', local_newsvnr\api\controllers\TokenController::class . ':getToken');
$app->get('/users', local_newsvnr\api\controllers\UsersController::class . ':getUser');
