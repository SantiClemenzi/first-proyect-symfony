<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Tasks;
use App\Form\TaskType;

class TaskController extends AbstractController
{
    // #[Route('/task', name: 'app_task')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // prueba de entidades y relaciones
        // $em = $doctrine->getManager();
        $task_repo = $doctrine->getRepository(Tasks::class);
        $tasks = $task_repo->findAll();

        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }

    public function detail(Tasks $task)
    {
        if (!$task) {
            return $this->redirectToRoute('tasks');
        }
        return $this->render('task/detail.html.twig', [
            'task' => $task,
        ]);
    }
    public function create(ManagerRegistry $doctrine, Request $request, \Symfony\Component\Security\Core\User\UserInterface $user)
    {
        $task = new Tasks;
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setCreatedAt(new \Datetime('now'));
            $task->setUser($user);

            // guardamos tarea en la db
            $em = $doctrine->getManager();
            $em->persist($task);
            $em->flush();

            // redireccionamos
            return $this->redirectToRoute('tasks_detail', ['id' => $task->getId()]);
        }

        return $this->render('task/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
