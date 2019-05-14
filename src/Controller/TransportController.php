<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TransportController
 * @package App\Controller
 */
class TransportController extends AbstractController
{
    /**
     * @Route("/transport", name="transport")
     */
    public function index()
    {
        return $this->render('transport/index.html.twig', [
            'controller_name' => 'TransportController',
        ]);
    }
}
