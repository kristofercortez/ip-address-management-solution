<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IpAddressController extends AbstractController
{
    public function index(): Response
    {
        $parameters = [];
        return $this->render('ip_address/index.html.twig', $parameters);
    }
}