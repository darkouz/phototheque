<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class HomeController extends Controller
{
    /**
     *
     * @return Response
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render("home/index.html.twig");

    }

    /**
     * @param Request $request
     * @Route("/user-register", name="user_register")
     */
    public function userRegisterAction(Request $request)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $token = new UsernamePasswordToken($user, null, "main", $user->getRoles());

            $this->get("security.authentication_utils")->setToken($token);

            return $this->redirectToRoute("homepage");

        }

        return $this->render("home/register-form.html.twig",
            [
                "registerForm" => $form->createView()
            ]);

    }


}