<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request, UserPasswordHasherInterface $hasher ): Response
    {
        $registered = false;
        // Init a User model
        $user = new User();
        // Creation of the Register form
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();
            // Hash password and save it in db
            $hashedPassword = $hasher->hashPassword($user,$user->getPassword());
            $user->setPassword($hashedPassword);
            $this->em->persist($user);
            $this->em->flush();
            $registered = true;
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'registered' => $registered,
            'submitted' => $form->isSubmitted()
        ]);
    }
}
