<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Repository\UsersRepository;
use ContainerCOYLuV2\getDoctrine_UlidGeneratorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Blog;
use App\Form\BlogItemType;
use App\Form\UserPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{

    #[Route('/user/edit/{id}', name: 'edit_user')]
    public function edit($id, UserPasswordHasherInterface $userPasswordHasher, UsersRepository $usersRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $user =  $usersRepository->find($id);
        // dd($user);
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($userPasswordHasher->isPasswordValid($user, $form->get('Password')->getData())) {

                $user->setLastname($form->get('lastname')->getData());
                $user->setFirstname($form->get('firstname')->getData());
                $user->setEmail($form->get('email')->getData());
                
                // $user->setPassword(
                //     $userPasswordHasher->hashPassword(
                //         $user,
                //         $form->get('Password')->getData()
                //     )
                // );

                $entityManager->flush();
                $this->addFlash(
                    'message',
                    'user  has been modified '
                );
                return $this->redirectToRoute('app_login');
            } else {
                $this->addFlash(
                    'message',
                    'user has not been modified '
                );
                // return $this->redirectToRoute('edit_user');
            }
        }

        return $this->render('user/edit.html.twig', [

            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    #[Route('/user/delete/{id}', name: 'delete_user')]
    public function delete($id, UsersRepository $usersRepository, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $user =  $usersRepository->find($id);
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->redirectToRoute('app_user');
    }   
    #[Route('/user/edit_Password/{id}', name: 'edit_password')]
    public function editPassword($id, UserPasswordHasherInterface $userPasswordHasher, UsersRepository $usersRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user =  $usersRepository->find($id);

        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($userPasswordHasher->isPasswordValid($user, $form->get('Password')->getData())) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('NewPassword')->getData()
                    )
                );
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash(
                    'message',
                    'password has been modified '
                );
                return $this->redirectToRoute('app_user');
            }
            else{
                $this->addFlash(
                    'message',
                    'password has not been modified '
                );
            }
        }
        return $this->render('user/edit_password.html.twig', [
            'form' => $form->createView()

        ]);
    }

    #[Route('/users', name: 'app_user')]
    public function index(UsersRepository $usersRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/index.html.twig', [
            'users' => $usersRepository->findAll()
           
        ]);
       
     
    }
}
