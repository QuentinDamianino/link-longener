<?php


namespace App\Domain\Link\Service;

use App\Domain\Link\Repository\LinkLongenerRepository;
use App\Exception\ValidationException;

/**
 * Class LinkLongener
 * @package App\Domain\Link\Service
 */
final class LinkLongener
{
    /**
     * @var LinkLongenerRepository
     */
    private $repository;

    /**
     * LinkLongener constructor.
     * @param LinkLongenerRepository $repository The repository
     */
    public function __construct(LinkLongenerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $oldLink Old link
     * @return string
     */
    public function linkLonger(string $oldLink): string
    {
        if (strpos($oldLink, 'https://') === false || strpos($oldLink, 'http://') === false) {
            $oldLink = 'http://' . $oldLink;
        }

        $this->validateInputLink($oldLink);

        $newLink = $_SERVER['HTTP_HOST'] . '/' . $this->generateRandomString();

        $this->repository->insertLink($oldLink, $newLink);

        return $newLink;
    }

    /**
     * @param string $link Old link
     */
    private function validateInputLink(string $link): void
    {
        $errors = [];

        if (empty($link)) {
            $errors['link'] = 'Input required';
        } elseif (filter_var($link, FILTER_VALIDATE_URL) === false) {
            $errors['link'] = 'Invalid url';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }

    /**
     * @return string
     */
    private function generateRandomString(): string
    {
        $range = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_";
        $randomString = "";

        for ($i = 0; $i < 230; $i++) {
            $randomString .= $range[rand(0, strlen($range) - 1)];
        }

        return $randomString;
    }
}
