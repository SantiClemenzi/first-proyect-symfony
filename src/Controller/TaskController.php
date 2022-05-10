<?php

namespace App\Controller;

use App\Entity\Tasks;
use App\Entity\Usuers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class TaskController extends AbstractController
{
    // #[Route('/task', name: 'app_task')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // prueba de entidades y relaciones
        // $em = $doctrine->getManager();
        $task_repo = $doctrine->getRepository(Usuers::class);
        $tasks = $task_repo->findAll();
        // foreach ($tasks as $task) {
        //     echo $task->getUser->getEmail . ' ' . $task->getTitle . '</br>';
        // }

        var_dump($tasks);
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }
}
