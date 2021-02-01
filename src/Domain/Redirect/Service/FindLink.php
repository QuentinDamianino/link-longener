<?php


namespace App\Domain\Redirect\Service;


use App\Domain\Redirect\Repository\FindLinkRepository;

/**
 * Class FindLink
 * @package App\Domain\Redirect\Service
 */
class FindLink
{
    /**
     * @var FindLinkRepository
     */
    private $repository;

    /**
     * FindLink constructor.
     * @param FindLinkRepository $repository Repository
     */
    public function __construct(FindLinkRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $link Link
     * @return mixed|null
     */
    public function findLink(string $link)
    {
        $link = $_SERVER["HTTP_HOST"] . '/' . $link;

        $result = $this->repository->getLink($link);

        return $result['old_link'] ?? null;
    }
}
