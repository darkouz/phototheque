<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction()
    {

        $userRepo = $this->getDoctrine()->getRepository("App:User");
        $userList = $userRepo->findAll();
        return $this->render('admin/index.html.twig', [
            "userList"=>$userList,
        ]);
    }

    /**
     * @Route("/admin-add-photo", name="add_photo")
     */
    public function addPhotoAction(){




    }
}
