<?php

require_once 'vendor/autoload.php';

$db = new \MongoDB\Client('mongodb://mongodb:27017');

$collection = $db->selectDatabase('db_toremember');


