<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AppBankAccountRepository;
use App\Entity\AppBankAccount;
use App\Repository\AppUserRepository;
use App\Entity\AppUser;
use App\Repository\AppBankRepository;
use App\Entity\AppBank;


class AppBankAccountService extends AbstractController{

    private $bankAccountRepository;
    private $userRepository;
    private $bankRepository;

    public function __construct(
        AppBankAccountRepository $bankAccountRepository,
        AppUserRepository $userRepository,
        AppBankRepository $bankRepository)
    {
        $this->bankAccountRepository = $bankAccountRepository;
        $this->userRepository = $userRepository;
        $this->bankRepository = $bankRepository;
    }

    public function getAllBankAccount($id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return array('status'=>false,'msg'=>'Usuário não encontrado.');
        }
        
        return $this->bankAccountRepository->findBy(['appUser' => $id]);
    }

    public function getBankAccount($user_id, $bank_account_id)
    {
        $user = $this->userRepository->findById($user_id);

        if (!$user) {
            return array('status'=>false,'msg'=>'Usuário não encontrado.');
        }

        $bankAccount = $this->bankAccountRepository->find($bank_account_id);
        
        if (!$bankAccount) {
            return array('status'=>false,'msg'=>'Conta bancária não encontrada.');
        }

        return $bankAccount;
    }

    public function addBankAccount($request, $id)
    {
        
        $user = $this->userRepository->find($id);
        if (!$user) {
            return array('status'=>false,'msg'=>'Usuário não encontrado.');
        }
       
        $app_user_id = $request->get('app_user_id');
        $accountName = $request->get('accountName');
        $app_bank_id = $request->get('app_bank_id');
        $agency      = $request->get('agency');
        $agencyDigit = $request->get('agencyDigit');
        $accountNumber = $request->get('accountNumber');
        $accountDigit = $request->get('accountDigit');
        $accountType = $request->get('accountType');
        

        if (!isset($accountName)) {
            return array(
                'status'=>false,
                'msg'=>'O nome da conta bancária é obrigatório.');
        }

        if (!isset($app_bank_id)) {
            return array(
                'status'=>false,
                'msg'=>'Por favor, selecione uma conta bancária.');
        }

        
        $bankAccount = new AppBankAccount();
                
        if (!isset($app_user_id)) {
            $bankAccount->setAppUser($user);
        }
       
        if ($accountName) {
            $bankAccount->setAccountName($accountName);
        }

        if ($app_bank_id) {
            $banks = $this->bankRepository->findBankIn($app_bank_id);
            foreach ($banks as $bank) {
                $bankAccount->addAppBank($bank);
            }
        }

        if ($agency) {
            $bankAccount->setAgency($agency);
        }

        if ($agencyDigit) {
            $bankAccount->setAgencyDigit($agencyDigit);
        }

        if ($accountNumber) {
            $bankAccount->setAccountNumber($accountNumber);
        }
        
        if ($accountDigit) {
            $bankAccount->setAccountDigit($accountDigit);
        }

        if ($accountType) {
            $bankAccount->setAccountType($accountType);
        }
               
        $em = $this->getDoctrine()->getManager();
        $em->persist($bankAccount);
        $em->flush();

       return array('status'=> true,'msg'=>'Conta bancária cadastrada com sucesso!');
    }

    public function updateBankAccount($request, $user_id, $bank_id)
    {
        $user = $this->userRepository->find($user_id);

        if (!$user) {
            return array('status'=>false,'msg'=>'Usuário não encontrado.');
        }

        $bankAccount = $this->bankAccountRepository->find($bank_id);
        
        if (!$bankAccount) {
            return array('status'=>false,'msg'=>'Conta bancaria não encontrada.');
        }
        
        $app_user_id = $request->get('app_user_id');
        $accountName = $request->get('accountName');
        $app_bank_id = $request->get('app_bank_id');
        $agency      = $request->get('agency');
        $agencyDigit = $request->get('agencyDigit');
        $accountNumber = $request->get('accountNumber');
        $accountDigit = $request->get('accountDigit');
        $accountType = $request->get('accountType');
        

        if (!isset($accountName)) {
            return array(
                'status'=>false,
                'msg'=>'O nome da conta bancária é obrigatório.');
        }

        if (!isset($app_bank_id)) {
            return array(
                'status'=>false,
                'msg'=>'Por favor, selecione uma conta bancária.');
        }
                
        if (!isset($app_user_id)) {
            $bankAccount->setAppUser($user);
        }
       
        if ($accountName) {
            $bankAccount->setAccountName($accountName);
        }

        if ($app_bank_id) {
            $banks = $this->bankRepository->findBankIn($app_bank_id);
            foreach ($banks as $bank) {
                $bankAccount->addAppBank($bank);
            }
        }

        if ($agency) {
            $bankAccount->setAgency($agency);
        }

        if ($agencyDigit) {
            $bankAccount->setAgencyDigit($agencyDigit);
        }

        if ($accountNumber) {
            $bankAccount->setAccountNumber($accountNumber);
        }
        
        if ($accountDigit) {
            $bankAccount->setAccountDigit($accountDigit);
        }

        if ($accountType) {
            $bankAccount->setAccountType($accountType);
        }
               
        $em = $this->getDoctrine()->getManager();
        $em->persist($bankAccount);
        $em->flush();

        return array('status'=> true,'msg'=>'Conta bancaria alterada com sucesso!');;
    }

    public function deleteBankAccount($user_id, $bank_id)
    {
        $user = $this->userRepository->find($user_id);

        if (!$user) {
            return array('status'=>false,'msg'=>'Usuário não encontrado.');
        }

        $bankAccount = $this->bankAccountRepository->findOneBy(['id' => $bank_id]);

        if (count($bankAccount) < 1 ) {
            return array('status'=>false,'msg'=>'Conta bancária não encontrada.');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($bankAccount);
        $em->flush();
        
        return array('status'=> true,'msg'=>'Conta bancária excluída com sucesso!');
    }
}