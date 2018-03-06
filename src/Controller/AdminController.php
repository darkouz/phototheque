<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function adminIndexAction()
    {

        $userRepo = $this->getDoctrine()->getRepository("App:User");
        $userList = $userRepo->findAll();
        $userCount = count($userList);

        $photoRepo = $this->getDoctrine()->getRepository("App:Photo");
        $photoList = $photoRepo->findAll();
        $photoCount = count($photoList);
        return $this->render('admin/admin-index.html.twig', [

            "userCount"=>$userCount,
            "photoCount"=>$photoCount

        ]);
    }

    /**
     * @Route("/admin-users",name="admin-users")
     */
    public function adminUsersAction(){

        $userRepo = $this->getDoctrine()->getRepository("App:User");
        $userList = $userRepo->findAll();
        return $this->render('admin/admin-users.html.twig', [
            "userList"=>$userList,
        ]);

    }

    /**
     * @Route("/admin-photos",name="admin-photos")
     */
    public function adminPhotosAction(){

        $userRepo = $this->getDoctrine()->getRepository("App:Photo");
        $photoList = $userRepo->findAll();
        return $this->render('admin/admin-photo.html.twig', [

        ]);

    }


}
