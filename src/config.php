<?php

/**
 *  Database configuration
 *
 */
$dbPassword = "root";
$databaseHandle = new PDO('mysql:host=littlebotanists-mysql;dbname=littlebotanists', "root", $dbPassword);
