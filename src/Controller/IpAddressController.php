<?php

namespace App\Controller;

use App\Exception\InvalidFormErrorException;
use App\Exception\IpAddressNotFoundException;
use App\Response\IpAddressControllerResponse;
use App\Service\IpAddress\CheckIfIpAddressExistServiceInterface;
use App\Service\IpAddress\GetIpAddressFormDataService;
use App\Service\IpAddress\GetIpAddressFormDataServiceInterface;
use App\Service\IpAddress\GetIpAddressTableDataServiceInterface;
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
    protected GetIpAddressTableDataServiceInterface $getIpAddressTableDataService;
    protected GetIpAddressFormDataServiceInterface $getIpAddressFormDataService;
    protected CheckIfIpAddressExistServiceInterface $checkIfIpAddressExistService;

    /**
     * @param LoggerInterface $logger
     * @param SaveIpAddressServiceInterface $saveIpAddressService
     * @param GetIpAddressTableDataServiceInterface $getIpAddressTableDataService
     * @param GetIpAddressFormDataServiceInterface $getIpAddressFormDataService
     * @param CheckIfIpAddressExistServiceInterface $checkIfIpAddressExistService
     */
    public function __construct(
        LoggerInterface $logger,
        SaveIpAddressServiceInterface $saveIpAddressService,
        GetIpAddressTableDataServiceInterface $getIpAddressTableDataService,
        GetIpAddressFormDataServiceInterface $getIpAddressFormDataService,
        CheckIfIpAddressExistServiceInterface $checkIfIpAddressExistService
    ) {
        $this->pageTitle = 'IP Address';
        $this->indexTwigFile = 'ip_address/index.html.twig';
        $this->formTwigFile = 'ip_address/form.html.twig';
        $this->logger = $logger;
        $this->saveIpAddressService = $saveIpAddressService;
        $this->getIpAddressTableDataService = $getIpAddressTableDataService;
        $this->getIpAddressFormDataService = $getIpAddressFormDataService;
        $this->checkIfIpAddressExistService = $checkIfIpAddressExistService;
    }

    /**
     * @param int $startPage
     * @param int $limit
     * @return Response
     */
    public function getIpAddressTableData(int $startPage, int $limit): Response
    {
        try {
            $data = $this->getIpAddressTableDataService->execute($startPage, $limit);
            return GenerateResponse::json(
                true,
                $data,
                IpAddressControllerResponse::LIST_TABLE_DATA_FETCH_SUCCESS
            );
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            return GenerateResponse::json(
                false,
                ['data' => []],
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
            // Save
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
            return GenerateResponse::json(
                false,
                ['data' => []],
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
            // Save
            $this->saveIpAddressService->execute($data);
            return GenerateResponse::json(
                true,
                ['data' => $data],
                IpAddressControllerResponse::UPDATE_SUCCESS
            );
        } catch (InvalidFormErrorException $exception) {
            $this->logger->error($exception->getMessage());
            return GenerateResponse::json(false, [], $exception->getMessage());
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            return GenerateResponse::json(
                false,
                ['data' => []],
                IpAddressControllerResponse::UPDATE_FAILED,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * @param $id
     * @return Response
     */
    public function getFormData($id): Response
    {
        try {
            $data = $this->getIpAddressFormDataService->execute($id);
            return GenerateResponse::json(
                true,
                $data,
                IpAddressControllerResponse::FORM_DATA_FETCH_SUCCESS
            );
        } catch (IpAddressNotFoundException | Exception $exception) {
            $this->logger->error($exception->getMessage());
            return GenerateResponse::json(
                false,
                ['data' => []],
                IpAddressControllerResponse::FORM_DATA_FETCH_FAILED,
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
            throw new InvalidFormErrorException('IP address is required');
        }

        if ($this->checkIfIpAddressExistService->execute($data->id, $data->ipAddress)) {
            throw new InvalidFormErrorException('IP address already exists');
        }

        if (!isset($data->label)) {
            throw new InvalidFormErrorException('Label is required');
        }
    }
}