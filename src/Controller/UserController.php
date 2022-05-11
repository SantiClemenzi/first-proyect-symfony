<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\Entity\Usuers;
use App\Form\RegisterType;

class UserController extends AbstractController
{
    // #[Route('/user', name: 'app_user')]
    public function register(Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $user = new Usuers();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $user->setRole('user');
            $date_now = (new \DateTime())->format('d-m-y H:i:s');
            $user->setCreatedAt($date_now);

            // $encoded = $encoder->encodePassword($user, $user->getPassword());
            $encoded =  $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($encoded);

            echo $user->getPassword().'</br>';
            echo $user->getCreatedAt().'</br>';
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
