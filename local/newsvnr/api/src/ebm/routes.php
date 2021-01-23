<?php

// Tích hợp lớp học
$app->post('/ebm/courses/trackclass-create', local_newsvnr\api\controllers\ebm\CourseController::class . ':create_and_update');
$app->post('/ebm/courses/user-unenrol', local_newsvnr\api\controllers\ebm\CourseController::class . ':unenrol_user');
$app->post('/ebm/courses/delete', local_newsvnr\api\controllers\ebm\CourseController::class . ':delete');
$app->post('/ebm/courses/user-enrol', local_newsvnr\api\controllers\ebm\CourseController::class . ':enrol_users');

//Tích hợp giáo viên +  học viên
$app->post('/ebm/users/create', local_newsvnr\api\controllers\ebm\UserController::class . ':create_and_update');
$app->post('/ebm/users/delete', local_newsvnr\api\controllers\ebm\UserController::class . ':delete');
//Tích hợp kì thi đầu vào
$app->post('/ebm/quizes/testregister-create', local_newsvnr\api\controllers\ebm\QuizController::class . ':create_and_update_testregister');
//Tích hợp kì thi trong lớp
$app->post('/ebm/quizes/exam-create', local_newsvnr\api\controllers\ebm\QuizController::class . ':create_and_update_exam');
//Xóa kì thi trong hoặc kì thi đầu vào
$app->post('/ebm/quizes/delete', local_newsvnr\api\controllers\ebm\QuizController::class . ':delete');
// Tích hợp kì thi đầu vào
$app->post('/ebm/exams/create', local_newsvnr\api\controllers\ebm\ExamController::class . ':create_and_update');
$app->post('/ebm/exams/delete', local_newsvnr\api\controllers\ebm\ExamController::class . ':delete');
$app->post('/ebm/exams/enrol-user', local_newsvnr\api\controllers\ebm\ExamController::class . ':enrol_exam_user');
$app->post('/ebm/exams/unenrol-user', local_newsvnr\api\controllers\ebm\ExamController::class . ':unenrol_exam_user');