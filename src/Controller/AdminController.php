<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[Route('/admin')]
#[IsGranted("ROLE_ADMIN", message:"Vous devez etre connecter en tant qu'administrateur pour consulter cette page.")]
class AdminController extends AbstractController
{
    #[Route('/users', name: 'user_list')]
    public function userList(UserRepository $userRepo)
    {
        return $this->render('user/list.html.twig', 
        ['users' => $userRepo->findAll() ]);
    }
  
    #[Route('/users/{id}/edit', name: 'user_edit')]
    public function editAction(User $user, 
    Request $request, 
    UserPasswordHasherInterface $userPasswordHasher,)
    {
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            
            $this->addFlash('success', "L'utilisateur a bien été modifié");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig', 
        ['form' => $form->createView(), 
        'user' => $user]);
    }
}
