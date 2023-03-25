<?php

// Require the correct variable type to be used (no auto-converting)
declare (strict_types = 1);

// Show errors so we get helpful information
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Load you classes
require_once 'config.php';
require_once 'classes/DatabaseManager.php';

require_once 'Controller/CardController.php';
require_once 'Controller/HomepageController.php';

if (isset($_POST['cancel'])) { 
    header('Location: .');
    exit;
}

$databaseManager = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);
$databaseManager->connect();

// Get the current action to execute
// If nothing is specified, it will remain empty (home should be loaded)
$action = $_GET['action'] ?? null;

// Load the relevant action
// This system will help you to only execute the code you want, instead of all of it (or complex if statements)
switch ($action) {
    case 'create':
        (new CardController($databaseManager))->create($_POST['type'], $_POST['description']);
        break;
    case 'update':
        (new CardController($databaseManager))->update((int)$_GET['id']);
        break;
    case 'delete':
        (new CardController($databaseManager))->delete((int)$_GET['id']);
        break;
    case 'showForm':
        (new HomepageController($databaseManager))->showForm();
        break;
    case 'filter':
        (new HomepageController($databaseManager))->overview($_GET['filter']);
        break;
    default:
        (new HomepageController($databaseManager))->overview();
        break;
}