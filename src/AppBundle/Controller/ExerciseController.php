<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Exercise;
use AppBundle\Form\ExerciseType;

/**
 * Exercise controller.
 *
 * @Route("/exercise")
 */
class ExerciseController extends Controller
{
    /**
     * Lists all Exercise entities.
     *
     * @Route("/", name="exercise_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $exercises = $em->getRepository('AppBundle:Exercise')->findAll();

        return $this->render('exercise/index.html.twig', array(
            'exercises' => $exercises,
        ));
    }

    /**
     * Creates a new Exercise entity.
     *
     * @Route("/new", name="exercise_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $exercise = new Exercise();
        $form = $this->createForm('AppBundle\Form\Type\ExerciseType', $exercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($exercise);
            $em->flush();

            return $this->redirectToRoute('exercise_show', array('id' => $exercise->getId()));
        }

        return $this->render('exercise/new.html.twig', array(
            'exercise' => $exercise,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Exercise entity.
     *
     * @Route("/{id}", name="exercise_show")
     * @Method("GET")
     */
    public function showAction(Exercise $exercise)
    {
        $deleteForm = $this->createDeleteForm($exercise);

        return $this->render('exercise/show.html.twig', array(
            'exercise' => $exercise,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Exercise entity.
     *
     * @Route("/{id}/edit", name="exercise_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Exercise $exercise)
    {
        $deleteForm = $this->createDeleteForm($exercise);
        $editForm = $this->createForm('AppBundle\Form\Type\ExerciseType', $exercise);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($exercise);
            $em->flush();

            return $this->redirectToRoute('exercise_edit', array('id' => $exercise->getId()));
        }

        return $this->render('exercise/edit.html.twig', array(
            'exercise' => $exercise,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Exercise entity.
     *
     * @Route("/{id}", name="exercise_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Exercise $exercise)
    {
        $form = $this->createDeleteForm($exercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($exercise);
            $em->flush();
        }

        return $this->redirectToRoute('exercise_index');
    }

    /**
     * Creates a form to delete a Exercise entity.
     *
     * @param Exercise $exercise The Exercise entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Exercise $exercise)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('exercise_delete', array('id' => $exercise->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
