<?php
require "environment.php";

if (ENVIRONMENT == 'development') {
    define("BASE_URL", "http://localhost/classificados/");
    $config = array(
        'dbname' => 'classificados',
        'dbhost' => 'localhost',
        'dbuser' => 'root',
        'dbpass' => '',
        'charset' => array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
}else{
    define("BASE_URL", "https://classificados.com.br/");
    $config = array(
        'dbname' => 'server_classificados',
        'dbhost' => 'server_host',
        'dbuser' => 'server_user',
        'dbpass' => 'server_pass',
        'charset' => array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
}

global $conn;
try {
    $conn = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['dbhost'], $config['dbuser'], $config['dbpass'], $config['charset']);
} catch (PDOException $e) {
    echo "ERRO: ".$e->getMessage();
}