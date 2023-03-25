<?php declare(strict_types=1);

class HomepageController
{
    private DatabaseManager $databaseManager;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function overview($filter = null): void
    {
        $showFormAddCard = false;
        $cards = (new CardController($this->databaseManager))->get($filter);
        require 'View/overview.php';
    }

    public function showForm()
    {
        $showFormAddCard = true;
        require 'View/overview.php';
    }
}