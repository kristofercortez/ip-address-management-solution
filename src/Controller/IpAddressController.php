<?php

namespace App\Controller;

use App\Response\LevelControllerResponse;
use App\Utility\GenerateResponse;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IpAddressController
 * @package App\Controller
 */
class IpAddressController extends CrudController
{
    protected LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger,
    ) {
        $this->pageTitle = 'IP Address';
        $this->indexTwigFile = 'ip_address/index.html.twig';
        $this->formTwigFile = 'ip_address/form.html.twig';
        $this->logger = $logger;
    }

    public function getIpAddressTableData(int $startPage, int $limit): Response
    {
        try {
            $data = [];
            return GenerateResponse::json(
                true,
                $data,
                'success fetch'
            );
        } catch (Exception $exception) {
            return GenerateResponse::json(
                false,
                [],
                'failed fetch',
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}