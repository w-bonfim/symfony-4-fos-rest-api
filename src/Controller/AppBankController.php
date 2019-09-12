<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\AnnotationsasRest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\AppBank;
use App\Service\AppBankService;

/**
 * AppBankController.
 * @Route("/api",name="api_")
 */
class AppBankController extends FOSRestController
{
    private $bankService;

    public function __construct(AppBankService $bankService)
    {
        $this->bankService = $bankService;
    }

    /**
     * @Rest\Get("/bank")
     * @Rest\View()
     */
    public function getBanks(Request $request)
    {
        $banks = $this->bankService->getAllBank();
       
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $banks,
            $request->get('page', 1),
            5
        );
        return $this->handleView($this->view($pagination, Response::HTTP_OK));
    }

    /**
     * @Rest\Get("/bank/{id}")
     * @Rest\View()
     */
    public function getBankId($id)
    {
        $bank = $this->bankService->getBank($id);
        return $this->handleView($this->view($bank, Response::HTTP_OK));
    }
}
