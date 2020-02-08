<?php 

$app->get('/token', local_newsvnr\api\controllers\TokenController::class . ':getToken');
$app->get('/users', local_newsvnr\api\controllers\UsersController::class . ':getUser');
$app->get('/quiz/read', local_newsvnr\api\controllers\QuizController::class . ':read');

$app->post('/orgstructures', local_newsvnr\api\controllers\OrgstructureCategoryController::class . ':create');
$app->put('/orgstructures/{id}', local_newsvnr\api\controllers\OrgstructureCategoryController::class . ':update');

$app->post('/courses/course-category', local_newsvnr\api\controllers\CourseCategoryController::class . ':create');
$app->put('/courses/course-category/{id}', local_newsvnr\api\controllers\CourseCategoryController::class . ':update');
$app->post('/courses/course-setup', local_newsvnr\api\controllers\CourseSetupController::class . ':create');
$app->put('/courses/course-setup/{id}', local_newsvnr\api\controllers\CourseSetupController::class . ':update');
$app->post('/courses/course-create', local_newsvnr\api\controllers\CourseCreateController::class . ':create');
$app->put('/courses/course-create/{id}', local_newsvnr\api\controllers\CourseCreateController::class . ':update');
$app->post('/courses/course-add-competency', local_newsvnr\api\controllers\CourseAddCompetencyController::class . ':create');
$app->put('/courses/course-add-competency/{id}', local_newsvnr\api\controllers\CourseAddCompetencyController::class . ':update');
$app->post('/courses/course-add-student', local_newsvnr\api\controllers\CourseAddUserController::class . ':create_student');
$app->post('/courses/course-add-teacher', local_newsvnr\api\controllers\CourseAddUserController::class . ':create_teacher');

$app->post('/competencies/competency-create', local_newsvnr\api\controllers\CompetencyCreateController::class . ':create');
$app->put('/competencies/competency-create/{id}', local_newsvnr\api\controllers\CompetencyCreateController::class . ':update');
$app->post('/competencies/competency-add-orgposition', local_newsvnr\api\controllers\CompetencyAddOrgPositionController::class . ':create');
$app->put('/competencies/competency-add-orgposition/{id}', local_newsvnr\api\controllers\CompetencyAddOrgPositionController::class . ':update');


