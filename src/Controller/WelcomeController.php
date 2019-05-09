<?php

namespace App\Controller;

use App\Entity\MessageStatus;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function OpenApi\scan;


/**
 * Class WelcomeController
 * @package App\Controller
 *
 * @OA\Info(
 *     title="MSA Mail Service",
 *     description="",
 *     version="0.0.0"
 * )
 */
class WelcomeController extends AbstractController
{
    use DatabaseTrait;

    /**
     * @Route("/", name="welcome.status")
     */
    public function index()
    {
        $statusWaiting = $this->fetchStatus(MessageStatus::STATUS_WAITING);
        $statusSending = $this->fetchStatus(MessageStatus::STATUS_SENDING);
        $statusFailed = $this->fetchStatus(MessageStatus::STATUS_FAILED);
        $statusSuccess = $this->fetchStatus(MessageStatus::STATUS_SUCCESS);

        return $this->render('welcome/index.html.twig', [
            'messages' => [
                'waiting' => $statusWaiting->getMessages()->toArray(),
                'sending' => $statusSending->getMessages()->toArray(),
                'failed' => $statusFailed->getMessages()->toArray(),
                'success' => $statusSuccess->getMessages()->toArray(),
            ]
        ]);
    }

    /**
     * @Route("/api/documentation.json", name="welcome.api.json")
     *
     * @OA\Get(
     *     path="/api/documentation.json",
     *     @OA\Response(response="200", description="")
     * )
     */
    public function fetchOpenApiJson()
    {
        return new Response($this->createOpenApiJson());
    }

    /**
     * @return string
     */
    private function createOpenApiJson()
    {
        $openApi = scan(__DIR__);
        return $openApi->toJson();
    }

    /**
     * @Route("/api/documentation", name="welcome.api")
     */
    public function apiDocumentation()
    {
        return $this->render('welcome/api.html.twig', [
            'openApiJson' => $this->createOpenApiJson()
        ]);
    }
}
