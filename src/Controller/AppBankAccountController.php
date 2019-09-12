<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\AnnotationsasRest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\AppBank;
use App\Service\AppBankAccountService;

/**
 * AppBankAccountController.
 * @Route("/api/user",name="api_user")
 */
class AppBankAccountController extends FOSRestController
{
    private $bankAccountService;

    public function __construct(AppBankAccountService $bankAccountService)
    {
        $this->bankAccountService = $bankAccountService;
    }

    /**
     * @Rest\Get("/{id}/bank_account")
     * @Rest\View()
     */
    public function getBankAccounts($id)
    {
        $bankAccount = $this->bankAccountService->getAllBankAccount($id);       
        return $this->handleView($this->view($bankAccount, Response::HTTP_OK));
    }

    /**
     * @Rest\Get("/{user_id}/bank_account/{bank_id}")
     * @Rest\View()
     */
    public function getBankId($user_id, $bank_id)
    {
        $bankAccount = $this->bankAccountService->getBankAccount($user_id, $bank_id);
        return $this->handleView($this->view($bankAccount, Response::HTTP_OK));
    }

    /**
     * @Rest\Post("/{user_id}/bank_account")
     * @Rest\View()
     */
    public function saveBankAccount(Request $request, $user_id)
    {
        $bankAccount = $this->bankAccountService->addBankAccount($request, $user_id);
        return $this->handleView($this->view($bankAccount, Response::HTTP_OK));
    }

    /**
     * @Rest\Post("/{user_id}/bank_account/{bank_id}")
     * @Rest\View()
     */
    public function putBankAccount(Request $request, $user_id, $bank_id)
    {
        $bankAccount = $this->bankAccountService->updateBankAccount($request, $user_id, $bank_id);
        return $this->handleView($this->view($bankAccount, Response::HTTP_OK));
    }

    /**
     * @Rest\Delete("/{user_id}/bank_account/{bank_id}")
     * @Rest\View()
     */
    public function deleteBankAccount($user_id, $bank_id)
    {
        $bankAccount = $this->bankAccountService->deleteBankAccount($user_id, $bank_id);
        return $this->handleView($this->view($bankAccount, Response::HTTP_OK));
    }
}
