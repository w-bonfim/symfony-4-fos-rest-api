<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\AnnotationsasRest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\AppUser;
use App\Service\AppUserService;

/**
 * Usercontroller.
 * @Route("/api",name="api_")
 */

class UserController extends FOSRestController
{
    private $userService;

    public function __construct(AppUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Rest\Get("/user")
     * @Rest\View()
     */
    public function getUsers(Request $request)
    {
        $users = $this->userService->getAllUser();
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $users,
            $request->get('page', 1),
            5
        );
        return $this->handleView($this->view($pagination, Response::HTTP_OK));
    }
    
    /**
     * @Rest\Get("/user/{id}")
     * @Rest\View()
     */
    public function getUserId($id)
    {
        $user = $this->userService->getOneUser($id);
        return $this->handleView($this->view($user, Response::HTTP_OK));
    }

    /**
     * @Rest\Post("/user")
     * @Rest\View()
     */
    public function postUser(Request $request)
    {    
        $user = $this->userService->addUser($request);
        return $this->handleView($this->view($user, Response::HTTP_CREATED));
    }

    /**
     * @Rest\Put("/user")
     * @Rest\View()
     */
    public function putUser(Request $request)
    {
        $user = $this->userService->updateUser($request->get('id'), $request);
        return $this->handleView($this->view($user, Response::HTTP_OK));
    }

    /**
     * @Rest\Delete("/user/{id}")
     * @Rest\View()
     */
    public function deleteUser($id)
    {
        $user = $this->userService->deleteUser($id);
        return $this->handleView($this->view($user, Response::HTTP_OK));
    }
}
