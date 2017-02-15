<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Todo;
use AppBundle\Form\TodoCreate;
use AppBundle\Form\TodoEdit;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class TodoController extends Controller
{
    /**
     * @Route("/", name="todo_list")
     */
    public function listAction()
    {
        $todos = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Todo')
            ->findAll();

        return $this->render('todo/index.html.twig', array(
            'todos' => $todos
        ));
    }

    /**
     * @Route("/todo/create", name="todo_create")
     */
    public function createAction(Request $request)
    {
        $todo = new Todo();

        $form = $this->createForm(TodoCreate::class, $todo);//since symfony 3 - before: new TodoCreate()

        $form->handleRequest($request);

        if(!$form->isSubmitted())
        {
            return $this->render('todo/create.html.twig', array(
                'form' => $form->createView()
            ));
        }



        if($form->isSubmitted() && $form->isValid()){
            // Get Data
            $name = $form['name']->getData();
            $category = $form['category']->getData();
            $description = $form['description']->getData();
            $priority = $form['priority']->getData();
            $due_date = $form['due_date']->getData();
            $now = new\DateTime('now');
            $todo->setName($name);
            $todo->setCategory($category);
            $todo->setDescription($description);
            $todo->setPriority($priority);
            $todo->setDueDate($due_date);
            $todo->setCreateDate($now);
            $em = $this->getDoctrine()->getManager();
            $em->persist($todo);
            $em->flush();
            $this->addFlash(
                'notice', 'Todo Added'
            );
        }
        return $this->redirectToRoute('todo_list');
    }

    /**
     * @Route("/todo/edit/{id}", name="todo_edit")
     */
    public function editAction($id, Request $request)
    {
        $todo = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Todo')
            ->find($id);

        $now = new\DateTime('now');


        $todo->setCreateDate($now);

        $form = $this->createForm(TodoEdit::class, $todo);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // Get Data
            $name = $form['name']->getData();
            $category = $form['category']->getData();
            $description = $form['description']->getData();
            $priority = $form['priority']->getData();
            $due_date = $form['due_date']->getData();


            $em = $this->getDoctrine()->getManager();
            $todo = $em->getRepository('AppBundle:Todo')->find($id);

            $todo->setName($name);
            $todo->setCategory($category);
            $todo->setDescription($description);
            $todo->setPriority($priority);
            $todo->setDueDate($due_date);
            $todo->setCreateDate($now);

            $em->flush();

            $this->addFlash(
                'notice', 'Todo Updated'
            );
            return $this->redirectToRoute('todo_list');
        }


        return $this->render('todo/edit.html.twig', array(
            'todo' => $todo,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/todo/details/{id}", name="todo_details")
     */
    public function detailsAction($id)
    {
        $todo = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Todo')
            ->find($id);

        return $this->render('todo/details.html.twig', array(
            'todo' => $todo
        ));
    }

    /**
     * @Route("/todo/delete/{id}", name="todo_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $todo = $em->getRepository('AppBundle:Todo')->find($id);

        $em->remove($todo);
        $em->flush();

        $this->addFlash(
            'notice',
            'Todo deleted'
        );

        return $this->redirectToRoute('todo_list');
    }
}
