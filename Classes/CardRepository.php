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
        try {
            $statementObj = $this->databaseManager->connection->prepare(("INSERT INTO cards (`type`, description) VALUES (:type, :description)"));
            $statementObj->bindValue(':type', $this->type);
            $statementObj->bindValue(':description', $this->description);
            $statementObj->execute();
        } catch(PDOException $e) {
            echo "Insert failed: " . $e->getMessage();
        }
    }

    // Get one
    public function find(int $id): array
    {
        $statementObj = $this->databaseManager->connection->prepare(("SELECT * FROM cards WHERE ID =:id"));
        $statementObj->bindValue(':id', $id, PDO::PARAM_INT);
        $statementObj->execute();

        $statementObj->setFetchMode(PDO::FETCH_ASSOC);
        return $statementObj->fetch();
    }

    // Get all
    public function get(): array
    {
        // TODO: Create an SQL query
        // TODO: Use your database connection (see $databaseManager) and send your query to your database.
        // TODO: fetch your data at the end of that action.
        // TODO: replace dummy data by real one

        // We get the database connection first, so we can apply our queries with it
        $statementObj = $this->databaseManager->connection->prepare(('SELECT * FROM cards WHERE deleted = 0'));
        $statementObj->execute();

        $statementObj->setFetchMode(PDO::FETCH_ASSOC);
        return $statementObj->fetchAll();
    }

    public function update(int $id): void
    {
        try {
            $statementObj = $this->databaseManager->connection->prepare(("UPDATE cards SET `type`=:type, description=:description WHERE ID=:id;"));
            $statementObj->bindValue(':id', $id, PDO::PARAM_INT);
            $statementObj->bindValue(':type', $this->type, PDO::PARAM_STR);
            $statementObj->bindValue(':description', $this->description, PDO::PARAM_STR);
            $statementObj->execute();
        } catch(PDOException $e) {
            echo "Update failed: " . $e->getMessage();
        }
    }

    public function delete(int $id): void
    {
        try {
            $statementObj = $this->databaseManager->connection->prepare(("DELETE FROM cards WHERE ID=:id;"));
            $statementObj->bindValue(':id', $id, PDO::PARAM_INT);
            $statementObj->execute();
        } catch(PDOException $e) {
            echo "Delete failed: " . $e->getMessage();
        }
    }

    public function softDelete(int $id): void
    {
        try {
            $statementObj = $this->databaseManager->connection->prepare(("UPDATE cards SET Deleted=1 WHERE ID=:id;"));
            $statementObj->bindValue(':id', $id, PDO::PARAM_INT);
            $statementObj->execute();
        } catch(PDOException $e) {
            echo "Delete failed: " . $e->getMessage();
        }
    }
}