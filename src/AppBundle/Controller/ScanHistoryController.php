<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ScanHistory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\BaseEntity;
use AppBundle\Form\BaseEntityType;

/**
 * ScanHistory controller.
 *
 */
class ScanHistoryController extends Controller
{

    /**
     * Lists all ScanHistory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:ScanHistory')->findAll();

        return $this->render('AppBundle:ScanHistory:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ScanHistory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ScanHistory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('baseentity_show', array('id' => $entity->getId())));
        }

        return $this->render('AppBundle:ScanHistory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ScanHistory entity.
     *
     * @param ScanHistory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ScanHistory $entity)
    {
        $form = $this->createForm(new ScanHistoryType(), $entity, array(
            'action' => $this->generateUrl('baseentity_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ScanHistory entity.
     *
     */
    public function newAction()
    {
        $entity = new ScanHistory();
        $form   = $this->createCreateForm($entity);

        return $this->render('AppBundle:ScanHistory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ScanHistory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ScanHistory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScanHistory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:ScanHistory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ScanHistory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ScanHistory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScanHistory entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:ScanHistory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ScanHistory entity.
    *
    * @param ScanHistory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ScanHistory $entity)
    {
        $form = $this->createForm(new ScanHistoryType(), $entity, array(
            'action' => $this->generateUrl('baseentity_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ScanHistory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ScanHistory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScanHistory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('baseentity_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:ScanHistory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ScanHistory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:ScanHistory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ScanHistory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('baseentity'));
    }

    /**
     * Creates a form to delete a ScanHistory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('baseentity_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
