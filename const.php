<?php
$a = explode("\\", __DIR__);
$path = "/{$a[1]}/{$a[2]}/{$a[3]}";
$root = "/{$a[3]}";


define("TITLE"      , "Access control");
define("DESCRIPTION", "Sistema genérico para cadastro de usuários e controle de acessos");
define("KEYWORDS"   , "login, senha, cadastro, php, sql, sistema, web");
define("AUTHOR"     , "Brayan Escouto b.");

define("ROOT"       , $root);
define("PATH"       , $path);

define("ASSETS"     , ROOT."/assets");
define("MODEL"      , PATH."/src/model");
define("VIEW"       , ROOT."/src/view");
define("CONTROLLER" , PATH."/src/controller");

//Banco de dados
define("MYSQL_SERVER"   , "localhost");
define("MYSQL_PORT"     , 3306);
define("MYSQL_DATABASE" , "access_control");
define("MYSQL_CHARSET"  , "utf8");
define("MYSQL_USER"     , "root");
define("MYSQL_PASS"     , "");
