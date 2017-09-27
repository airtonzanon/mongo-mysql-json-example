<?php

require_once 'vendor/autoload.php';

// mysql
try {
    $dbh = new PDO('mysql:host=mysql;dbname=remembender', 'remembender', 'remembender');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// mongo
$db = new \MongoDB\Client('mongodb://mongodb:27017');
$collection = $db->selectDatabase('ivan');
