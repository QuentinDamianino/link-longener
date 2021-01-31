<?php


namespace App\Domain\Redirect\Repository;


use PDO;

/**
 * Class FindLinkRepository
 * @package App\Domain\Redirect\Repository
 */
class FindLinkRepository
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * FindLinkRepository constructor.
     * @param PDO $connection Connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $link Link
     * @return mixed
     */
    public function getLink(string $link)
    {
        $sql = "SELECT * FROM links WHERE new_link = :new_link LIMIT 1";
        $statement = $this->connection->prepare($sql);
        $statement->execute(['new_link' => $link]);

        return $statement->fetch();
    }
}
