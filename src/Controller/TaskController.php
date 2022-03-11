<?php

namespace App\Controller;


use DateTime;
use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
    #[Route('/tasks', name: 'task_list')]
    public function listAction(TaskRepository $taskrepo)
    {
        return $this->render('task/list.html.twig', 
        ['tasks' => $taskrepo->findAll()]);
    }

 
    #[Route('/tasks/create', name: 'task_create')]
    public function createAction(Request $request, 
    EntityManagerInterface $em)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
            $task->setCreatedAt(new \DateTimeImmutable());  
            $task->setUser($this->getUser());

            $em->persist($task);
            $em->flush();

            $this->addFlash('success', 'La tâche a été bien été ajoutée.');

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/create.html.twig', ['form' => $form->createView()]);
    }

 
    #[Route('/tasks/{id}/edit', name: 'task_edit')]
    #[IsGranted("TASK_EDIT", subject:"task", message:"Vous ne pouvez modifier que vos taches")]
    public function editAction(Task $task, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $em->persist($task);
            $em->flush();

            $this->addFlash('success', 'La tâche a bien été modifiée.');

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
            'task' => $task,
        ]);
    }

    #[Route('/tasks/{id}/toggle', name: 'task_toggle')]
    #[IsGranted("TASK_TOGGLE", subject:"task", message:"Vous ne pouvez gerer que vos propre taches")]
    public function toggleTaskAction(Task $task, EntityManagerInterface $em)
    {
        $task->toggle(!$task->isDone());
        $em->flush();

        $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme faite.', $task->getTitle()));

        return $this->redirectToRoute('task_list');

        
    }
  
    #[Route('/tasks/{id}/delete', name: 'task_delete')]
    #[IsGranted("TASK_DELETE", subject:"task", message:"Vous devez etre connecter en tant qu'administrateur pour consulter cette page.")]
    public function deleteTaskAction(Task $task, EntityManagerInterface $em, Request $request)
    {
        $em->remove($task);
        $em->flush();

        $this->addFlash('success', 'La tâche a bien été supprimée.');

        return $this->redirectToRoute('task_list');

    }
}
