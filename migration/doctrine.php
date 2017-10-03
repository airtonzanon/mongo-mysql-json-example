<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Platforms\MySqlPlatform;

$connection = DriverManager::getConnection([
    'dbname'        => 'remembender',
    'user'          => 'remembender',
    'password'      => 'remembender',
    'host'          => 'mysql',
    'driver'        => 'pdo_mysql',
    'charset'       => 'utf8',
    'driverOptions' => [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ]
], $config = new Configuration);

$databasePlatform = $connection->getDatabasePlatform();
$schemaManager    = $connection->getSchemaManager();
$queryBuilder     = $connection->createQueryBuilder();

echo 'Testing Doctrine'.PHP_EOL;

echo 'Table Info'.PHP_EOL;
$details = $schemaManager->listTableDetails('user');
print_r($details);
echo PHP_EOL.'==========================='.PHP_EOL;

echo 'Insert Data'.PHP_EOL;
$results = $connection->insert('user', [
    'login'   => 'ivanrosolen',
    'name'    => 'Ivan',
    'pwd'     => 'lerolero',
    'created' => date('Y-m-d H:i:s'),
]);
print_r($results);
echo PHP_EOL.'==========================='.PHP_EOL;

echo 'List Data SQL'.PHP_EOL;
$records = $connection->fetchAll('SELECT * FROM user');
foreach ($records as $record) {
    print_r($record);
}
echo PHP_EOL.'==========================='.PHP_EOL;

echo 'List Data Fluid'.PHP_EOL;
$results = $queryBuilder->select('*')
                         ->from('user', 'u')
                         ->orderBy('u.created', 'DESC')
                         ->execute()
                         ->fetchAll();
foreach ($results as $result) {
    print_r($result);
}
echo PHP_EOL.'==========================='.PHP_EOL;


echo 'Create Table "test"'.PHP_EOL;
$schema = new Schema;

$table  = $schema->createTable('test');

$table->addColumn('id', 'integer', array('unsigned' => true));
$table->addColumn('title', 'string', array('length' => 128));
$table->addColumn('content', 'text');

$table->setPrimaryKey(array('id'));

echo 'Create Table Command'.PHP_EOL;
$queries = $schema->toSql($databasePlatform);
print_r($queries);
echo PHP_EOL.'==========================='.PHP_EOL;

echo 'Drop Table Command'.PHP_EOL;
$drops   = $schema->toDropSql($databasePlatform);
print_r($drops);
echo PHP_EOL.'==========================='.PHP_EOL;