<?php


namespace App\Domain\Link\Repository;

use PDO;

class LinkLongenerRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * LinkLongenerRepository constructor.
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $oldLink Old link
     * @param string $newLink New link
     * @return int The new ID
     */
    public function insertLink(string $oldLink, string $newLink): int
    {
        $row = [
            'old_link' => $oldLink,
            'new_link' => $newLink,
        ];

        $sql = "INSERT INTO links SET
                old_link=:old_link,
                new_link=:new_link";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
}
