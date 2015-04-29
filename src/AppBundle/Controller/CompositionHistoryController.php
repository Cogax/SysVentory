<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\CompositionHistory;
use AppBundle\Form\CompositionHistoryType;

/**
 * CompositionHistory controller.
 *
 */
class CompositionHistoryController extends Controller
{

    /**
     * Lists all CompositionHistory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:CompositionHistory')->findAll();

        return $this->render('AppBundle:CompositionHistory:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new CompositionHistory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new CompositionHistory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('compositionhistory_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:CompositionHistory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a CompositionHistory entity.
     *
     * @param CompositionHistory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CompositionHistory $entity)
    {
        $form = $this->createForm(new CompositionHistoryType(), $entity, array(
            'action' => $this->generateUrl('compositionhistory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CompositionHistory entity.
     *
     */
    public function newAction()
    {
        $entity = new CompositionHistory();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:CompositionHistory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CompositionHistory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CompositionHistory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompositionHistory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:CompositionHistory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CompositionHistory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CompositionHistory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompositionHistory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:CompositionHistory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a CompositionHistory entity.
    *
    * @param CompositionHistory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CompositionHistory $entity)
    {
        $form = $this->createForm(new CompositionHistoryType(), $entity, array(
            'action' => $this->generateUrl('compositionhistory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CompositionHistory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CompositionHistory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompositionHistory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('compositionhistory_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:CompositionHistory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a CompositionHistory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:CompositionHistory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CompositionHistory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('compositionhistory'));
    }

    /**
     * Creates a form to delete a CompositionHistory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('compositionhistory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
