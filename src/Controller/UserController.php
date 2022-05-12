<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Usuers;
use App\Form\RegisterType;

class UserController extends AbstractController
{
    // #[Route('/user', name: 'app_user')]
    public function register(Request $request, UserPasswordHasherInterface $hasher,  ManagerRegistry $doctrine): Response
    {
        $user = new Usuers();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // creamos objeto
            $user->setRole('user');

            // seteamos hora
            $user->setCreatedAt(new \DateTime('now'));

            // cifrado de password
            $encoded =  $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($encoded);

            // guardamos usuario
            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('register');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
