<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $machineCompositions = $this->get("app.composition_controller")->getActualMachineCompositions();
        return $this->render('AppBundle:Default:index.html.twig', array(
            'compositionHistoryStatistics' => $this->getCompositionHistoryStatisticsData(),
            'compositionSoftwareStatistics' => $this->getSoftwareData($machineCompositions),
            'compositionOperatingSystemStatistics' => $this->getOperatingSystemData($machineCompositions),
        ));
    }

    private function getCompositionHistoryStatisticsData() {
        $conn = $this->container->get('database_connection');
        $query =  "SELECT count(*) as quantity, DATE(time) as dateday from compositionhistory GROUP BY dateday;";
        $stmt = $conn->query($query);
        return $stmt->fetchAll();
    }

    private function getSoftwareData($machineCompositions) {
        $softwares = array();
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

    private function getOperatingSystemData($machineCompositions) {
        $oss = array();
        foreach($machineCompositions as $composition) {
            $os = $composition->getOperatingSystem();
            $key = $os->getName().' ('.$os->getVersion().', '.$os->getArchitecture().')';
            if(!array_key_exists($key, $oss)) {
                $oss[$key] = array(
                  'label' => $key,
                  'quantity' => 1
                );
            } else {
                $oss[$key]['quantity']++;
            }
        }
        return $oss;
    }


}
