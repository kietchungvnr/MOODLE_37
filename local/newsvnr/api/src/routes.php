<?php 

$app->get('/token', local_newsvnr\api\controllers\TokenController::class . ':getToken');
$app->get('/users', local_newsvnr\api\controllers\UsersController::class . ':getUser');
$app->get('/quiz/read', local_newsvnr\api\controllers\QuizController::class . ':read');
$app->post('/orgstructures', local_newsvnr\api\controllers\OrgstructureCategoryController::class . ':create');
$app->put('/orgstructures/{id}', local_newsvnr\api\controllers\OrgstructureCategoryController::class . ':update');
