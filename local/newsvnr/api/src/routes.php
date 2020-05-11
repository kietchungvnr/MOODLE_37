<?php 

$app->get('/token', local_newsvnr\api\controllers\TokenController::class . ':getToken');
$app->get('/users', local_newsvnr\api\controllers\UsersController::class . ':getUser');

//Tích hợp phòng ban, chức danh, chức vụ (EL - HRM)
$app->post('/orgstructures/orgstructure', local_newsvnr\api\controllers\OrgstructureController::class . ':create');
$app->put('/orgstructures/orgstructure/{id}', local_newsvnr\api\controllers\OrgstructureController::class . ':update');
$app->post('/orgstructures/orgstructurecategory', local_newsvnr\api\controllers\OrgstructureCategoryController::class . ':create');
$app->put('/orgstructures/orgstructurecategory/{id}', local_newsvnr\api\controllers\OrgstructureCategoryController::class . ':update');
$app->post('/orgstructures/orgstructurejobtitle', local_newsvnr\api\controllers\OrgstructureJobtitleController::class . ':create');
$app->put('/orgstructures/orgstructurejobtitle/{id}', local_newsvnr\api\controllers\OrgstructureJobtitleController::class . ':update');
$app->post('/orgstructures/orgstructureposition', local_newsvnr\api\controllers\OrgstructurePositionController::class . ':create');
$app->put('/orgstructures/orgstructureposition/{id}', local_newsvnr\api\controllers\OrgstructurePositionController::class . ':update');

//Tích hợp đào tạo, tuyển dụng (EL - HRM)
$app->post('/courses/course-category', local_newsvnr\api\controllers\CourseCategoryController::class . ':create');
$app->put('/courses/course-category/{id}', local_newsvnr\api\controllers\CourseCategoryController::class . ':update');
$app->post('/courses/course-setup', local_newsvnr\api\controllers\CourseSetupController::class . ':create');
$app->put('/courses/course-setup/{id}', local_newsvnr\api\controllers\CourseSetupController::class . ':update');
$app->post('/courses/course-create', local_newsvnr\api\controllers\CourseCreateController::class . ':create');
$app->put('/courses/course-create/{id}', local_newsvnr\api\controllers\CourseCreateController::class . ':update');
$app->post('/courses/course-add-competency', local_newsvnr\api\controllers\CourseAddCompetencyController::class . ':create');
$app->put('/courses/course-add-competency/{id}', local_newsvnr\api\controllers\CourseAddCompetencyController::class . ':update');
$app->post('/courses/course-add-student', local_newsvnr\api\controllers\CourseAddUserController::class . ':add_student');
$app->post('/courses/course-add-teacher', local_newsvnr\api\controllers\CourseAddUserController::class . ':add_teacher');

$app->get('/courses/course-list', local_newsvnr\api\controllers\ListModuleController::class . ':read_course');

$app->post('/competencies/competency-create', local_newsvnr\api\controllers\CompetencyCreateController::class . ':create');
$app->post('/competencies/competency-framework-create', local_newsvnr\api\controllers\CompetencyFrameWorkController::class . ':create');
$app->put('/competencies/competency-create/{id}', local_newsvnr\api\controllers\CompetencyCreateController::class . ':update');
$app->post('/competencies/competency-add-orgposition', local_newsvnr\api\controllers\CompetencyAddOrgPositionController::class . ':create');
$app->put('/competencies/competency-add-orgposition/{id}', local_newsvnr\api\controllers\CompetencyAddOrgPositionController::class . ':update');

$app->get('/quizses/quiz-list', local_newsvnr\api\controllers\ListModuleController::class . ':read_quiz');

