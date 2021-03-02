<?php

//Tích hợp phòng ban, chức danh, chức vụ (EL - HRM)
$app->post('/chatbot/hello', local_newsvnr\api\controllers\lms\chatbot\HelloController::class . ':hello');