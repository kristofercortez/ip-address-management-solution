<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;

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
}