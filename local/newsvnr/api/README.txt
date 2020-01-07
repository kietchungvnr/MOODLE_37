composer require phpoffice/phpspreadsheet //cài đặt xử lý office php (.csv,.xls,..) 
 - https://phpspreadsheet.readthedocs.io/en/latest/#hello-world
composer require slim/slim "^3.0" //cài đặt slim framework
 - http://www.slimframework.com/
composer require davidepastore/slim-validation //cài đặt validation cho field không custom message
 - https://github.com/DavidePastore/Slim-Validation
composer require awurth/slim-validation //cài đặt validation cho field custom đc mesage (nên dùng cái này)
 - https://github.com/awurth/SlimValidation
composer require tuupola/slim-jwt-auth //cài đặt jwt cho api
 - https://github.com/tuupola/slim-jwt-auth
 - Ex: https://github.com/elaugier/testSTOKEN
composer require monolog/monolog //cài đặt ghi log cho api
 - https://github.com/Seldaek/monolog
composer require ramsey/uuid //mã hoá id
composer require moontoast/math //đi kèm với uuid
// Câu lệnh chung
composer require phpoffice/phpspreadsheet slim/slim "^3.0" awurth/slim-validation tuupola/slim-jwt-auth monolog/monolog ramsey/uuid moontoast/math

//Thêm autoload vào composer.json ở composer.json tổng: 
 	- Ví dụ Path xampp: htdocs/vendor/....
	"autoload": {
        "psr-4": {
            "local_newsvnr\\api\\": "local/newsvnr/api/src/"
        }
    }