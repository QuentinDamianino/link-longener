<?php


namespace App\Action\Link;


use App\Domain\Link\Service\LinkLongener;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class LinkAction
 * @package App\Action\Link
 */
final class LinkAction
{
    /**
     * @var LinkLongener
     */
    private $linkLongener;

    /**
     * LinkAction constructor.
     * @param LinkLongener $linkLongener LinkLongener Service
     */
    public function __construct(LinkLongener $linkLongener)
    {
        $this->linkLongener = $linkLongener;
    }

    /**
     * @param ServerRequestInterface $request The Request
     * @param ResponseInterface $response The Response
     * @return ResponseInterface The Response
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $data = (array)$request->getParsedBody();
        $newLink = $this->linkLongener->linkLonger($data['link']);

        $response->getBody()->write((string)json_encode(['link' => $newLink]));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
