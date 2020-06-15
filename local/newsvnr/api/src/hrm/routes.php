<?php

//Tích hợp phòng ban, chức danh, chức vụ (EL - HRM)
$app->post('/hrm/orgstructures/orgstructure', local_newsvnr\api\controllers\hrm\OrgstructureController::class . ':create');
$app->put('/hrm//orgstructures/orgstructure/{id}', local_newsvnr\api\controllers\hrm\OrgstructureController::class . ':update');
$app->post('/hrm//orgstructures/orgstructurecategory', local_newsvnr\api\controllers\hrm\OrgstructureCategoryController::class . ':create');
$app->put('/hrm//orgstructures/orgstructurecategory/{id}', local_newsvnr\api\controllers\hrm\OrgstructureCategoryController::class . ':update');
$app->post('/hrm//orgstructures/orgstructurejobtitle', local_newsvnr\api\controllers\hrm\OrgstructureJobtitleController::class . ':create');
$app->put('/hrm//orgstructures/orgstructurejobtitle/{id}', local_newsvnr\api\controllers\hrm\OrgstructureJobtitleController::class . ':update');
$app->post('/hrm//orgstructures/orgstructureposition', local_newsvnr\api\controllers\hrm\OrgstructurePositionController::class . ':create');
$app->put('/hrm//orgstructures/orgstructureposition/{id}', local_newsvnr\api\controllers\hrm\OrgstructurePositionController::class . ':update');

//Tích hợp đào tạo, tuyển dụng (EL - HRM)
$app->post('/hrm/courses/course-category', local_newsvnr\api\controllers\hrm\CourseCategoryController::class . ':create');
$app->put('/hrm/courses/course-category/{id}', local_newsvnr\api\controllers\hrm\CourseCategoryController::class . ':update');
$app->post('/hrm/courses/course-setup', local_newsvnr\api\controllers\hrm\CourseSetupController::class . ':create');
$app->put('/hrm/courses/course-setup/{id}', local_newsvnr\api\controllers\hrm\CourseSetupController::class . ':update');
$app->post('/hrm/courses/course-create', local_newsvnr\api\controllers\hrm\CourseController::class . ':create');
$app->put('/hrm/courses/course-create/{id}', local_newsvnr\api\controllers\hrm\CourseController::class . ':update');
$app->post('/hrm/courses/course-add-competency', local_newsvnr\api\controllers\hrm\CourseAddCompetencyController::class . ':create');
$app->put('/hrm/courses/course-add-competency/{id}', local_newsvnr\api\controllers\hrm\CourseAddCompetencyController::class . ':update');
$app->post('/hrm/courses/course-add-student', local_newsvnr\api\controllers\hrm\CourseAddUserController::class . ':add_student');
$app->post('/hrm/courses/course-add-teacher', local_newsvnr\api\controllers\hrm\CourseAddUserController::class . ':add_teacher');
$app->post('/hrm/courses/training/course-add-student', local_newsvnr\api\controllers\hrm\CourseAddUserController::class . ':enroll_user_training');
$app->post('/hrm/courses/training/course-delete-student', local_newsvnr\api\controllers\hrm\CourseAddUserController::class . ':delete_enroll_course');
$app->post('/hrm/courses/interview/course-add-student', local_newsvnr\api\controllers\hrm\CourseAddUserController::class . ':create_and_enroll_user_interview');
$app->post('/hrm/courses/interview/course-delete-student', local_newsvnr\api\controllers\hrm\CourseAddUserController::class . ':delete_recruitment');

$app->get('/hrm/courses/course-list', local_newsvnr\api\controllers\hrm\ListModuleController::class . ':read_course');

$app->post('/hrm/competencies/competency-create', local_newsvnr\api\controllers\hrm\CompetencyController::class . ':create');
$app->post('/hrm/competencies/competency-framework-create', local_newsvnr\api\controllers\hrm\CompetencyFrameWorkController::class . ':create');
$app->put('/hrm/competencies/competency-create/{id}', local_newsvnr\api\controllers\hrm\CompetencyController::class . ':update');
$app->post('/hrm/competencies/competency-add-orgposition', local_newsvnr\api\controllers\hrm\CompetencyAddOrgPositionController::class . ':create');
$app->put('/hrm/competencies/competency-add-orgposition/{id}', local_newsvnr\api\controllers\hrm\CompetencyAddOrgPositionController::class . ':update');

$app->get('/hrm/quizses/quiz-list', local_newsvnr\api\controllers\hrm\ListModuleController::class . ':read_quiz');