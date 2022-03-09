<?php
    define('USER', 'admin');
    define('PASSWORD', '123456');
    define('HOST', 'localhost');
    define('DATABASE', 'users');
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
        //echo 'Connect success !!!!';
        //check oke
        //$conn = null; close connection
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }

?>