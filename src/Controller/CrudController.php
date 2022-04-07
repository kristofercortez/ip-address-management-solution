<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CrudController
 * @package App\Controller
 */
abstract class CrudController extends AbstractController
{
    protected string $pageTitle;
    protected string $indexTwigFile;
    protected string $formTwigFile;

    /**
     * @return Response
     */
    public function index() : Response
    {
        try {
            $parameters = $this->getPageParameters();
            return $this->render($this->indexTwigFile, $parameters);
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            $this->addFlash('error', $exception->getMessage());
            return $this->redirectToRoute('ip_address_index');
        }
    }

    /**
     * @return array
     */
    protected function getPageParameters() : array
    {
        return [
            'page_title' => $this->pageTitle
        ];
    }

    /**
     * @return Response
     */
    public function add(): Response
    {
        try {
            $parameters = $this->getPageParameters();
            return $this->render($this->formTwigFile, $parameters);
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            $this->addFlash('error', $exception->getMessage());
            return $this->redirectToRoute('ip_address_index');
        }
    }

    /**
     * @param $id
     * @return Response
     */
    public function edit($id): Response
    {
        try {
            $parameters = $this->getPageParameters();
            $parameters['object_id'] = $id;
            return $this->render($this->formTwigFile, $parameters);
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            $this->addFlash('error', $exception->getMessage());
            return $this->redirectToRoute('ip_address_index');
        }
    }
}