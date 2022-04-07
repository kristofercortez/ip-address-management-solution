<?php

namespace App\Controller;

use App\Exception\InvalidFormErrorException;
use App\Response\IpAddressControllerResponse;
use App\Service\IpAddress\SaveIpAddressServiceInterface;
use App\Utility\GenerateResponse;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IpAddressController
 * @package App\Controller
 */
class IpAddressController extends CrudController
{
    protected LoggerInterface $logger;
    protected SaveIpAddressServiceInterface $saveIpAddressService;

    /**
     * @param LoggerInterface $logger
     * @param SaveIpAddressServiceInterface $saveIpAddressService
     */
    public function __construct(
        LoggerInterface $logger,
        SaveIpAddressServiceInterface $saveIpAddressService
    ) {
        $this->pageTitle = 'IP Address';
        $this->indexTwigFile = 'ip_address/index.html.twig';
        $this->formTwigFile = 'ip_address/form.html.twig';
        $this->logger = $logger;
        $this->saveIpAddressService = $saveIpAddressService;
    }

    public function getIpAddressTableData(int $startPage, int $limit): Response
    {
        try {
            $data = [];
            return GenerateResponse::json(
                true,
                $data,
                IpAddressControllerResponse::LIST_TABLE_DATA_FETCH_SUCCESS
            );
        } catch (Exception $exception) {
            return GenerateResponse::json(
                false,
                [],
                IpAddressControllerResponse::LIST_TABLE_DATA_FETCH_FAILED,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function addSubmit(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent());
            $this->validate($data, true);
//            var_dump($data);
//            die();
            // save
            $this->saveIpAddressService->execute($data);
            return GenerateResponse::json(
                true,
                ['data' => $data],
                IpAddressControllerResponse::SAVE_NEW_SUCCESS
            );
        } catch (InvalidFormErrorException $exception) {
            $this->logger->error($exception->getMessage());
            return GenerateResponse::json(false, [], $exception->getMessage());
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            die($exception->getMessage());
            return GenerateResponse::json(
                false,
                [],
                IpAddressControllerResponse::SAVE_NEW_FAILED,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function editSubmit(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent());
            $this->validate($data, true);
            var_dump($data);
            die();
            // save

            return GenerateResponse::json(
                true,
                $data,
                IpAddressControllerResponse::UPDATE_SUCCESS
            );
        } catch (InvalidFormErrorException $exception) {
            $this->logger->error($exception->getMessage());
            return GenerateResponse::json(false, [], $exception->getMessage());
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            return GenerateResponse::json(
                false,
                [],
                IpAddressControllerResponse::UPDATE_FAILED,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param array $data
     * @param bool $isNew
     * @throws InvalidFormErrorException
     */
    protected function validate($data = [], bool $isNew = false)
    {
        if (!isset($data->ipAddress)) {
            throw new InvalidFormErrorException('IP address is required!');
        }

        if (!isset($data->label)) {
            throw new InvalidFormErrorException('Label is required!');
        }
    }
}