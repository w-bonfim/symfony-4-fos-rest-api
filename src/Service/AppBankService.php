<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AppBankRepository;
use App\Entity\AppBank;


class AppBankService extends AbstractController{

    private $bankRepository;

    public function __construct(AppBankRepository $bankRepository)
    {
        $this->bankRepository = $bankRepository;
    }

    public function getAllbank()
    {
        return $this->bankRepository->findAll();
    }

    public function getBank($id)
    {
        $bank = $this->bankRepository->findById($id);
        if (!$bank) {
            return array('status'=>false,'msg'=>'Banco não encontrado.');
        }
        return $bank;
    }

}