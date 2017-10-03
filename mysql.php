<?php

require_once 'conn.php';

use League\JsonGuard\Dereferencer,
    League\JsonGuard\Validator;

if (isset($_GET['select'])) {

    $array = json_encode([32]);

    $sql = 'SELECT things->"$.tags"
            FROM remember as e
            where JSON_CONTAINS(things->"$.tags", :value) = 1';

    $sth = $dbh->prepare($sql);
    $sth->bindParam(":value", $array);
    $sth->execute();
    $result = $sth->fetchAll();

    var_dump($result);
}

if (isset($_GET['insert'])) {

    $array = array('tags' => array(
        '1280x800',
        32,
        'teste'
    ));

    $deref = new Dereferencer();

    $schemaArray = array(
        'properties' => array(
            'tags' => array(
                'type' => 'Object'
            ),
        ),
    );

    $schema = $deref->dereference($schemaArray);

    $validator = new Validator(json_decode(json_encode($array)), json_decode(json_encode($schema)));

    if ($validator->passes()) {
        $sql = 'INSERT INTO remember (things) VALUES(:thing)';
        $sth = $dbh->prepare($sql);
        $sth->bindParam(":thing", json_encode($array));
        $sth->execute();

        $sql = 'SELECT * FROM remembender.remember';

        $sth = $dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll();

        var_dump($result);
    }

    if ($validator->fails()) {
        var_dump($validator->errors());
    }

}