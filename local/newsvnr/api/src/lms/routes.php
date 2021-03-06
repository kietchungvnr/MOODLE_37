<?php

$app->post('/chatbot/hello', local_newsvnr\api\controllers\lms\chatbot\HelloController::class . ':hello');

$app->post('/chatbot/mycourses', local_newsvnr\api\controllers\lms\chatbot\ReportController::class . ':list_course');