<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AppUserRepository;
use App\Entity\AppUser;


class AppUserService extends AbstractController{

    private $userRepository;

    public function __construct(AppUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUser()
    {
        return $this->userRepository->findBy([], ['name' => 'desc']);
    }

    public function getOneUser($id)
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            return array('status'=>false,'msg'=>'Usuário não encontrado.');
        }
        return $user;
    }

    public function addUser($request)
    {
        $name = $request->get('name');
        $cpf  = $request->get('cpf');
        $email = $request->get('email');

        if (!isset($name)) {
            return array(
                'status'=> false,
                'msg'=>'Por favor, o campo NOME é obrigatório');
        }

        if (!isset($cpf)) {
            return array(
                'status'=> false,
                'msg'=>'Por favor, o campo CPF é obrigatório');
        }

        if (!isset($email)) {
            return array(
                'status'=> false,
                'msg'=>'Por favor, o campo E-mail é obrigatório');
        }
      
        $user = new AppUser();
        $user->setName($name);
        $user->setCpf($cpf);
        $user->setEmail($email);
       
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return array('status'=> true,'msg'=>'Usuário cadastrado com sucesso!');;
    }

    public function updateUser($id, $request)
    {
        $name = $request->get('name');
        $cpf  = $request->get('cpf');
        $email = $request->get('email');

        $user = $this->userRepository->find($id);
        if (!$user) {
            return array('status'=>false,'msg'=>'Usuário não encontrado.');
        }
        
        if (!isset($name)) {
            return array(
                'status'=> false,
                'msg'=>'Por favor, o campo NOME é obrigatório');
        }

        if (!isset($cpf)) {
            return array(
                'status'=> false,
                'msg'=>'Por favor, o campo CPF é obrigatório');
        }

        if (!isset($email)) {
            return array(
                'status'=> false,
                'msg'=>'Por favor, o campo E-mail é obrigatório');
        }
       
        $user->setName($name);
        $user->setCpf($cpf);
        $user->setEmail($email);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return array('status'=> true,'msg'=>'Usuário alterado com sucesso!');;
    }

    public function deleteUser($id)
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            return array('status'=>false,'msg'=>'Usuário não encontrado.');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        
        return array('status'=> true,'msg'=>'Usuário excluído com sucesso!');
    }


}