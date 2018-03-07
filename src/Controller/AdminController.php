<?php

namespace App\Controller;

use App\Entity\Tag;
use Symfony\Component\HttpFoundation\Request;
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

        $tagRepo = $this->getDoctrine()->getRepository("App:Tag");
        $tagList = $tagRepo->findAll();
        $tagCount = count($tagList);
        return $this->render('admin/admin-index.html.twig', [

            "userCount"=>$userCount,
            "photoCount"=>$photoCount,
            "tagCount"=>$tagCount

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

    /**
     * @Route("/admin-tag",name="admin-tag")
     */
    public function adminTagAction(Request $request){

        $tagRepo = $this->getDoctrine()->getRepository("App:Tag");
        $tagList = $tagRepo->findAll();

        $tag = new Tag();
        $form = $this->createForm("App\Form\TagType", $tag);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute("admin-tag");
        }


        return $this->render('admin/admin-tag.html.twig', [

            "tagForm"=>$form->createView(),
            "tagList"=>$tagList
        ]);

    }
}
