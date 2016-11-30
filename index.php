<?php

require_once 'conn.php';

$collection = $collection->selectCollection('users');

if (isset($_GET['insert'])) {

    $array = array('username' => $_GET['user'],
        'email' => $_GET['email'],
        'name' => $_GET['name']);

    $insertOneResult = $collection->insertOne($array);

    printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());

    var_dump($insertOneResult->getInsertedId());

} else if (isset($_GET['select'])) {

    $array = array(
        'username' => $_GET['user']
    );

    $document = $collection->findOne($array);

    var_dump($document);

} else if (isset($_GET['update'])) {

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
