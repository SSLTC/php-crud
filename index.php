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
require_once 'classes/CardRepository.php';

if (isset($_POST['cancel'])) { 
    header('Location: .');
    exit;
}

$databaseManager = new DatabaseManager($config['host'], $config['user'], $config['password'], $config['dbname']);
$databaseManager->connect();

$cardRepository = new CardRepository($databaseManager);
//$cards = $cardRepository->get();

// Get the current action to execute
// If nothing is specified, it will remain empty (home should be loaded)
$action = $_GET['action'] ?? null;

// Load the relevant action
// This system will help you to only execute the code you want, instead of all of it (or complex if statements)
switch ($action) {
    case 'create':
        create();
        break;
    case 'update':
        update();
        break;
    case 'delete':
        delete();
        break;
    case 'showForm':
        showForm();
        break;
    case 'filte':
        filter();
        break;
    default:
        overview();
        break;
}

function filter()
{

}

function overview()
{
    // Load your view
    // Tip: you can load this dynamically and based on a variable, if you want to load another view
    $showFormAddCard = false;
    $cards = $GLOBALS['cardRepository']->get();
    require 'overview.php';
}

function create()
{
    // TODO: provide the create logic
    global $cardRepository;
    $cardRepository->setType($_POST['type']);
    $cardRepository->setDescription($_POST['description']);
    $cardRepository->create();
    header('Location: .');
}

function update()
{
    // TODO: provide the update logic
    global $cardRepository;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_FILES["fileToUpload"]["name"])) {
            require './uploads/upload.php';

            if (!empty($errors)) {
                require 'edit.php';
                exit;
            }
        }

        $cardRepository->setType($_POST['type']);
        $cardRepository->setDescription($_POST['description']);
        $cardRepository->update((int)$_GET['id']);
        header('Location: .');
    } else {
        $card = $cardRepository->find((int)$_GET['id']);
        require 'edit.php';
    }
}

function delete()
{
    global $cardRepository;
    $cardRepository->delete((int)$_GET['id']);
    header('Location:.');
}

function showForm()
{
    $showFormAddCard = true;
    require 'overview.php';
}