<?php

require_once 'conn.php';

$array = array(
  'telefone' => '011986502050'
);

$column = 'things';
$param = 'telefone';

$sql = 'SELECT  
    json_extract(things, "$.telefone")
    FROM remembender.remember';
$sth = $dbh->prepare($sql);
$sth->execute();
$result = $sth->fetchAll();

var_dump($result);

/*
$sql = 'INSERT INTO remember (things) VALUES(:thing)';
$sth = $dbh->prepare($sql);
$sth->bindParam(":thing",json_encode($array));
$sth->execute();*/