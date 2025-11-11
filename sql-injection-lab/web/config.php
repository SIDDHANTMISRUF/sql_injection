<?php
// config.php - SQLite (serverless) connection for local demo

function get_db_conn(){
    // file path inside container: /var/www/html/data.sqlite
    $path = __DIR__ . '/data.sqlite';
    // create directory if missing (should be web root)
    if (!file_exists(dirname($path))) {
        mkdir(dirname($path), 0755, true);
    }
    // open sqlite, create file if missing
    $pdo = new PDO("sqlite:$path");
    // use exceptions for errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // For compatibility with MySQL-style queries in this lab, make sqlite return associative arrays
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
}
