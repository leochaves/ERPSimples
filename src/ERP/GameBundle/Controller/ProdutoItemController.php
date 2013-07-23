<?php

namespace ERP\GameBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ERP\GameBundle\Entity\ProdutoItem;
use ERP\GameBundle\Form\ProdutoItemType;

/**
 * ProdutoItem controller.
 *
 * @Route("/produtoitem")
 */
class ProdutoItemController extends Controller {

    /**
     * Lists all ProdutoItem entities.
     *
     * @Route("/", name="produtoitem")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $dql = "SELECT e FROM ERPGameBundle:ProdutoItem e";
        $query = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $entities = $paginator->paginate(
                $query, $this->get('request')->query->get('e', 1)/* page number */, 10/* limit per page */
        );

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new ProdutoItem entity.
     *
     * @Route("/", name="produtoitem_create")
     * @Method("POST")
     * @Template("ERPGameBundle:ProdutoItem:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new ProdutoItem();
        $form = $this->createForm(new ProdutoItemType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // Copy quantidade value to set a initial Saldo
            $entity->setSaldo($entity->getQuantidade());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('produtoitem_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new ProdutoItem entity.
     *
     * @Route("/new", name="produtoitem_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new ProdutoItem();
        $form = $this->createForm(new ProdutoItemType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a ProdutoItem entity.
     *
     * @Route("/{id}", name="produtoitem_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ERPGameBundle:ProdutoItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProdutoItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ProdutoItem entity.
     *
     * @Route("/{id}/edit", name="produtoitem_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ERPGameBundle:ProdutoItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProdutoItem entity.');
        }

        $editForm = $this->createForm(new ProdutoItemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ProdutoItem entity.
     *
     * @Route("/{id}", name="produtoitem_update")
     * @Method("PUT")
     * @Template("ERPGameBundle:ProdutoItem:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ERPGameBundle:ProdutoItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProdutoItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ProdutoItemType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('produtoitem_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ProdutoItem entity.
     *
     * @Route("/{id}", name="produtoitem_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ERPGameBundle:ProdutoItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProdutoItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('produtoitem'));
    }

    /**
     * Creates a form to delete a ProdutoItem entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
