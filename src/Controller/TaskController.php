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
    public function create(Request $request)
    {
        $task = new Tasks;
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            var_dump($form);
        }

        return $this->render('task/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
