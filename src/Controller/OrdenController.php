<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\Orden;
use App\Entity\Estadotrabajo;
use App\Entity\Comprobante;
use App\Entity\Items;

/**
 * Description of OrdenController
 *
 * @author maricle
 */
class OrdenController extends EasyAdminController {

    /**
     * @Route(path = "/admin/orden/cambiarestado", name = "orden_cambiarestado")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function ordenCambiarestadoAction(Request $request) {
        // controllers extending the base AdminController get access to the
        // following variables:
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Orden::class);
        $estadosrep = $this->getDoctrine()->getRepository(Estadotrabajo::class);

        $id = $request->query->get('id');
        $orden = $repository->find($id);
        $next_estado = $estadosrep->findNextEstado($orden->getEstadotrabajo());
        $orden->setEstadotrabajo($next_estado);
        $em->flush();
        // change the properties of the given entity and save the changes
        // dump($request); die;
//        $id = $request->query->get('id');
//        $entity = $request->query->get('entity');
//        $orden=  $em->getRepository(Orden::class)->find($id);
//        $orden->setEstadotrabajo($em->getRepository(Estadotrabajo::class)->find(2));
//        $this->em->flush();
        // redirect to the 'list' view of the given entity ...
        return $this->redirectToRoute('easyadmin', array(
                    'action' => 'list',
                    'entity' => 'Ordenes',
        ));

        // ... or redirect to the 'edit' view of the given entity item
//        return $this->redirectToRoute('easyadmin', array(
//            'action' => 'edit',
//            'id' => $id,
//            'entity' => $this->request->query->get('entity'),
//        ));
    }

    /**
     * @Route(path = "/admin/orden/cambiarestadoAnterior", name = "orden_cambiarestado_ant")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function ordenCambiarestadoAnteriorAction(Request $request) {
        // controllers extending the base AdminController get access to the
        // following variables:
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Orden::class);
        $estadosrep = $this->getDoctrine()->getRepository(Estadotrabajo::class);

        $id = $request->query->get('id');
        $orden = $repository->find($id);
        $next_estado = $estadosrep->findPrevEstado($orden->getEstadotrabajo());
        $orden->setEstadotrabajo($next_estado);
        $em->flush();

        // redirect to the 'list' view of the given entity ...
        return $this->redirectToRoute('easyadmin', array(
                    'action' => 'list',
                    'entity' => 'Ordenes',
        ));
    }

   
    /**
     * @Route(path = "/admin/orden/facturarorden", name = "facturarorden")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function facturarOrdenBatchAction(array $ids) {
        $class = $this->entity['class'];
        $em = $this->getDoctrine()->getManagerForClass($class);

        $factura = new Comprobante();
        //$factura->setPersona($orden->getPersona());
        $factura->setFecha(getdate());
        $factura->setTipo(false);
        $factura->setCompra(false);
        $factura->setPuntodeventa(1);
        $total = 0;
        //$factura->set
        $cliente = null;
        foreach ($ids as $id) {
            if (!$cliente) {
                $factura->setPersona($orden->getPersona());
            } else {
                return $this->redirectToRoute('easyadmin', array(
                            'action' => 'list',
                            'entity' => 'Ordenes',
                ));
            }
            $item = new Items();

            $repository = $this->getDoctrine()->getRepository(Orden::class);
            $orden = $repository->find($id);
            $item->setOrden($orden);
            $item->setDescripcion($orden->getNombre());
            $item->setPrecio($orden->getPrecio());
            $total += $orden->getPrecio();
            $item->setComprobante($factura);
        }
        
        $this->em->flush();
        $message= 'La factura se creo';
        $this->addFlash('success', $message);

        // don't return anything or redirect to any URL because it will be ignored
        // when a batch action finishes, user is redirected to the original page
    }

}
