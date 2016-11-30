<?php

require_once 'conn.php';

$array = array(
    'telefone' => '011986502050'
);

use League\JsonGuard\Dereferencer,
    League\JsonGuard\Validator;

$collection = $collection->selectCollection('users');

if (isset($_GET['insert'])) {

    $array = array('username' => $_GET['user'],
        'email' => $_GET['email'],
        'name' => $_GET['name']);

    $deref = new Dereferencer();

    $schemaArray = array(
        'properties' => array(
            'username' => array(
                'type' => 'string',
                'maxLength' => 6
            ),
            'email' => array(
                '$ref' => '#/properties/username',
            ),
            'name' => array(
                '$ref' => '#/properties/username',
            ),
        ),
    );

    $schema = $deref->dereference($schemaArray);

    $validator = new Validator(json_decode(json_encode($array)), json_decode(json_encode($schema)));

    if ($validator->passes()) {
        $insertOneResult = $collection->insertOne($array);

        printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());

        var_dump($insertOneResult->getInsertedId());
    }

    if ($validator->fails()) {
        var_dump($validator->errors());
    }

} else if (isset($_GET['select'])) {

    $array = array(
        'username' => $_GET['user']
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

    $find = array(
        'username' => $_GET['user'],
    );

    $update = array(
        '$set' => array(
            'email' => $_GET['email']
        )
    );

    $update = $collection->updateOne(
        $find, $update
    );

    printf("Matched %d document(s)\n", $update->getMatchedCount());
    printf("Modified %d document(s)\n", $update->getModifiedCount());

} else if (isset($_GET['delete'])) {
    $array = array(
        'username' => $_GET['user']
    );

    $deleteResult = $collection->deleteOne($array);

    printf("Deleted %d document(s)\n", $deleteResult->getDeletedCount());
}


/*
$sql = 'INSERT INTO remember (things) VALUES(:thing)';
$sth = $dbh->prepare($sql);
$sth->bindParam(":thing",json_encode($array));
$sth->execute();*/