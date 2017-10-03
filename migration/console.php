<?php

use Symfony\Component\Console;
use Doctrine\DBAL\Migrations\MigrationsVersion;
use Doctrine\DBAL\Migrations\Tools\Console\Command as MigrationsCommand;

require_once __DIR__ . '/../vendor/autoload.php';

$cli = new Console\Application('Doctrine Migrations', MigrationsVersion::VERSION());
$cli->setCatchExceptions(true);

$helperSet = new Console\Helper\HelperSet();
$helperSet->set(new Console\Helper\DialogHelper(), 'dialog');
$cli->setHelperSet($helperSet);

$commands = array();
$commands[] = new MigrationsCommand\ExecuteCommand();
$commands[] = new MigrationsCommand\GenerateCommand();
$commands[] = new MigrationsCommand\LatestCommand();
$commands[] = new MigrationsCommand\MigrateCommand();
$commands[] = new MigrationsCommand\StatusCommand();
$commands[] = new MigrationsCommand\DiffCommand();
$commands[] = new MigrationsCommand\VersionCommand();

foreach ($commands as $command) {
    $command->setName(str_replace('migrations:', '', $command->getName()));
}
$cli->addCommands($commands);

$cli->run();