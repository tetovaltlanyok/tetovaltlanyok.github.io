<?php
require_once(__DIR__.'/vendor/autoload.php');

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(__DIR__ ."/gallery/protected/doctrine_models");
$isDevMode = true;

$dbParams = array(
    'dbname' => 'facebookgallery',
    'user' => 'facebookgallery',
    'password' => 'facebookgallery',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

return ConsoleRunner::createHelperSet($entityManager);
