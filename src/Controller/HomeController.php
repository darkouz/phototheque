<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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

        if ($this->getUser() != null) {
            return $this->render("home/index.html.twig");
        } else {
            return $this->redirectToRoute("login");
        }

    }

    /**
     * @param Request $request
     * @Route("/user-register", name="user_register")
     */
    public function userRegisterAction(Request $request, TokenStorageInterface $tokenStorage)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $token = new UsernamePasswordToken($user, null, "main", $user->getRoles());

            $this->get("security.token_storage")->setToken($token);

            return $this->redirectToRoute("homepage");
        }

        return $this->render("home/register-form.html.twig",
            [
                "registerForm" => $form->createView()
            ]);

    }

    /**
     * @return mixed
     * @Route("/login", name="login")
     */
    public function userLoginAction()
    {

        $securityUtils = $this->get("security.authentication_utils");

        return $this->render("home/login-form.html.twig",
            [
                "error" => $securityUtils->getLastAuthenticationError(),
                "userName" => $securityUtils->getLastUsername()
            ]);
    }


}