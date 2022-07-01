<?php

declare(strict_types=1);

require_once 'config.php';
require_once 'database.php';
require_once 'pdo.php';

$pdo = new TestPDO($host, $user, $password, $dbname);
$testDB = new TestDatabase($dbname, $tables, $pdo);

$testDB->createDatabase();
$testDB->showTables();

phpinfo();