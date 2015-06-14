<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Network;
use AppBundle\Form\NetworkType;

/**
 * Network controller.
 *
 */
class NetworkController extends Controller
{
    /**
     * Lists all Network entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Network')->findAll();

        return $this->render('AppBundle:Network:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Network entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Network')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Network entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Network:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Network entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Network')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Network entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AppBundle:Network:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Network entity.
    *
    * @param Network $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Network $entity)
    {
        $form = $this->createForm(new NetworkType(), $entity, array(
            'action' => $this->generateUrl('network_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Network entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Network')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Network entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('network_edit', array('id' => $id)));
        }

        return $this->render('AppBundle:Network:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Network entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Network')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Network entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('network'));
    }

    /**
     * Creates a form to delete a Network entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('network_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
