<?php

namespace ERP\GameBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ERP\GameBundle\Entity\Console;
use ERP\GameBundle\Form\ConsoleType;

/**
 * Console controller.
 *
 * @Route("/console")
 */
class ConsoleController extends Controller
{
    /**
     * Lists all Console entities.
     *
     * @Route("/", name="console")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dql   = "SELECT e FROM ERPGameBundle:Console e";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $entities = $paginator->paginate(
            $query,
            $this->get('request')->query->get('e', 1)/*page number*/,
            10/*limit per page*/
        );
     
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Console entity.
     *
     * @Route("/", name="console_create")
     * @Method("POST")
     * @Template("ERPGameBundle:Console:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Console();
        $form = $this->createForm(new ConsoleType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('console_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Console entity.
     *
     * @Route("/new", name="console_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Console();
        $form   = $this->createForm(new ConsoleType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Console entity.
     *
     * @Route("/{id}", name="console_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ERPGameBundle:Console')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Console entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Console entity.
     *
     * @Route("/{id}/edit", name="console_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ERPGameBundle:Console')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Console entity.');
        }

        $editForm = $this->createForm(new ConsoleType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Console entity.
     *
     * @Route("/{id}", name="console_update")
     * @Method("PUT")
     * @Template("ERPGameBundle:Console:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ERPGameBundle:Console')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Console entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ConsoleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('console_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Console entity.
     *
     * @Route("/{id}", name="console_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ERPGameBundle:Console')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Console entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('console'));
    }

    /**
     * Creates a form to delete a Console entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
