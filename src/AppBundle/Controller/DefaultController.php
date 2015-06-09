<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig', array(
            'compositionHistoryStatistics' => $this->getCompositionHistoryStatisticsData(),
            'compositionSoftwareStatistics' => $this->getOperatingSystemData(),
        ));
    }

    private function getCompositionHistoryStatisticsData() {
        $conn = $this->container->get('database_connection');
        $query =  "SELECT count(*) as quantity, DATE(time) as dateday from compositionhistory GROUP BY dateday;";
        $stmt = $conn->query($query);
        return $stmt->fetchAll();
    }

    private function getOperatingSystemData() {
        $softwares = array();
        $machineCompositions = $this->get("app.composition_controller")->getActualMachineCompositions();
        foreach($machineCompositions as $composition) {
            foreach($composition->getSoftwares() as $software) {
                $key = $software->getName().' ('.$software->getVersion().')';
                if(!array_key_exists($key, $softwares)) {
                    $softwares[$key] = array(
                        'label' => $key,
                        'quantity' => 1
                    );
                } else {
                    $softwares[$key]['quantity']++;
                }
            }
        }
        return $softwares;
    }

}
