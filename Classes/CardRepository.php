<?php

// This class is focussed on dealing with queries for one type of data
// That allows for easier re-using and it's rather easy to find all your queries
// This technique is called the repository pattern
class CardRepository
{
    private DatabaseManager $databaseManager;
    private string $type;
    private string $description;

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    // This class needs a database connection to function
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function create(): void
    {
        $statementObj = $this->databaseManager->connection->prepare(("INSERT INTO cards (`type`, description) VALUES ('{$this->type}', '{$this->description}')"));
        $statementObj->execute();
    }

    // Get one
    public function find(): array
    {
        return [];
    }

    // Get all
    public function get(): array
    {
        // TODO: Create an SQL query
        // TODO: Use your database connection (see $databaseManager) and send your query to your database.
        // TODO: fetch your data at the end of that action.
        // TODO: replace dummy data by real one

        // We get the database connection first, so we can apply our queries with it
        $statementObj = $this->databaseManager->connection->prepare(('SELECT * FROM cards'));
        $statementObj->execute();

        $statementObj->setFetchMode(PDO::FETCH_ASSOC);
        return $statementObj->fetchAll();
    }

    public function update(): void
    {

    }

    public function delete(): void
    {

    }

}