<?php


namespace App\Action\Redirect;


use App\Domain\Redirect\Service\FindLink;
use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

/**
 * Class RedirectAction
 * @package App\Action\Redirect
 */
final class RedirectAction
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var FindLink
     */
    private $findLink;

    /**
     * RedirectAction constructor.
     * @param Responder $responder Responder
     * @param FindLink $findLink FindLink service
     */
    public function __construct(Responder $responder, FindLink $findLink)
    {
        $this->responder = $responder;
        $this->findLink = $findLink;
    }

    /**
     * @param ServerRequestInterface $request Request
     * @param ResponseInterface $response Response
     * @param array $args Arguments
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $oldLink = $this->findLink->findLink($args['slug']);

        if ($oldLink) {
            return $this->responder->withRedirect($response, $oldLink, []);
        } else {
            return $this->responder->withRedirectFor($response, 'home')->withStatus(302);
        }
    }
}
