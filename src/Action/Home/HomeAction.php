<?php

namespace App\Action\Home;

use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

/**
 * Action.
 */
final class HomeAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     */
    public function __construct(Responder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * @param ServerRequestInterface $request Request
     * @param ResponseInterface $response Response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->responder->withTemplate($response, 'home/home.php');
    }
}
