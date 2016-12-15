<?php

require_once 'conn.php';
require_once 'vendor/autoload.php';

use League\JsonGuard\Dereferencer,
    League\JsonGuard\Validator;

if (isset($_GET['select'])) {

    $param = '$.telefone';

    $sql = 'SELECT
        json_unquote(json_extract(things, "' . $param . '")),
        things->>"' . $param . '"
        FROM remembender.remember';

    $sth = $dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll();

    var_dump($result);
}

if (isset($_GET['insert'])) {

    $array = array('username' => 'airton',
        'telefone' => 11986502050,
        'name' => 'Airton Zanon');

    $deref = new Dereferencer();

    $schemaArray = array(
        'properties' => array(
            'username' => array(
                'type' => 'string',
                'maxLength' => 6
            ),
            'telefone' => array(
                'type' => 'integer',
                'maxLength' => 11
            ),
            'name' => array(
                '$ref' => '#/properties/username',
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