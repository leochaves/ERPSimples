<?php

namespace ERP\GameBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ERP\GameBundle\Entity\Fornecedor;
use ERP\GameBundle\Form\FornecedorType;

/**
 * Fornecedor controller.
 *
 * @Route("/fornecedor")
 */
class FornecedorController extends Controller
{
    /**
     * Lists all Fornecedor entities.
     *
     * @Route("/", name="fornecedor")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dql   = "SELECT e FROM ERPGameBundle:Fornecedor e";
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
     * Creates a new Fornecedor entity.
     *
     * @Route("/", name="fornecedor_create")
     * @Method("POST")
     * @Template("ERPGameBundle:Fornecedor:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Fornecedor();
        $form = $this->createForm(new FornecedorType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fornecedor_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Fornecedor entity.
     *
     * @Route("/new", name="fornecedor_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Fornecedor();
        $form   = $this->createForm(new FornecedorType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Fornecedor entity.
     *
     * @Route("/{id}", name="fornecedor_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ERPGameBundle:Fornecedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fornecedor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Fornecedor entity.
     *
     * @Route("/{id}/edit", name="fornecedor_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ERPGameBundle:Fornecedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fornecedor entity.');
        }

        $editForm = $this->createForm(new FornecedorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Fornecedor entity.
     *
     * @Route("/{id}", name="fornecedor_update")
     * @Method("PUT")
     * @Template("ERPGameBundle:Fornecedor:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ERPGameBundle:Fornecedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fornecedor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new FornecedorType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fornecedor_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Fornecedor entity.
     *
     * @Route("/{id}", name="fornecedor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ERPGameBundle:Fornecedor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fornecedor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fornecedor'));
    }

    /**
     * Creates a form to delete a Fornecedor entity by id.
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
