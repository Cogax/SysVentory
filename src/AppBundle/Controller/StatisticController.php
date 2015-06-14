<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatisticController extends Controller
{

    public function scanAction() {
        $conn = $this->container->get('database_connection');

        // weekly
        $query =  "SELECT count(*) as quantity, DAY(time) AS dateday, WEEK(time) as dateweek, YEAR(time) AS dateyear from compositionhistory GROUP BY dateyear, dateweek;";
        $stmt = $conn->query($query);
        $dataWeekly =  $stmt->fetchAll();

        // monthly
        $query =  "SELECT count(*) as quantity, MONTH(time) as datemonth, YEAR(time) AS dateyear from compositionhistory GROUP BY dateyear, datemonth;";
        $stmt = $conn->query($query);
        $dataMonthly =  $stmt->fetchAll();

        // yearly
        $query =  "SELECT count(*) as quantity, YEAR(time) AS dateyear from compositionhistory GROUP BY dateyear;";
        $stmt = $conn->query($query);
        $dataYearly =  $stmt->fetchAll();

        return $this->render('AppBundle:Statistic:scan.html.twig', array(
            'datasetWeekly' => $dataWeekly,
            'datasetMonthly' => $dataMonthly,
            'datasetYearly' => $dataYearly,
        ));
    }

    public function changesAction() {
        $em = $this->getDoctrine()->getManager();

        $historyVersions = array();
        $dataWeekly = array();
        $dataMonthly = array();
        $dataYearly = array();
        $historyCompositions = $em->getRepository('AppBundle:Composition')->findAll();
        foreach($historyCompositions as $historyComposition) {
            $compositionHistory = $em->getRepository('AppBundle:CompositionHistory')->findOneByComposition($historyComposition, array('time' => 'DESC'));

            // weekly
            $weeklyKey = $compositionHistory->getTime()->format("W/y");
            if(!array_key_exists($weeklyKey, $dataWeekly)) {
                $dataWeekly[$weeklyKey] = array(
                  'dateday' => $compositionHistory->getTime()->format("d"),
                  'dateweek' => $compositionHistory->getTime()->format("W"),
                  'dateyear' => $compositionHistory->getTime()->format("y"),
                  'quantity' => 1
                );
            } else {
                $dataWeekly[$weeklyKey]['quantity']++;
            }

            // monthly
            $monthlyKey = $compositionHistory->getTime()->format("m/y");
            if(!array_key_exists($monthlyKey, $dataMonthly)) {
                $dataMonthly[$monthlyKey] = array(
                  'datemonth' => $compositionHistory->getTime()->format("m"),
                  'dateyear' => $compositionHistory->getTime()->format("y"),
                  'quantity' => 1
                );
            } else {
                $dataMonthly[$monthlyKey]['quantity']++;
            }

            // yearly
            $yearlyKey = $compositionHistory->getTime()->format("y");
            if(!array_key_exists($yearlyKey, $dataYearly)) {
                $dataYearly[$yearlyKey] = array(
                  'dateyear' => $compositionHistory->getTime()->format("y"),
                  'quantity' => 1
                );
            } else {
                $dataYearly[$yearlyKey]['quantity']++;
            }
        }

        return $this->render('AppBundle:Statistic:changes.html.twig', array(
            'datasetWeekly' => $dataWeekly,
            'datasetMonthly' => $dataMonthly,
            'datasetYearly' => $dataYearly,
        ));
    }

    public function osAction() {
        $machineCompositions = $this->get("app.composition_controller")->getActualMachineCompositions();
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

        return $this->render('AppBundle:Statistic:os.html.twig', array(
            'dataset' => $oss
        ));
    }

    public function softwareAction() {
        $machineCompositions = $this->get("app.composition_controller")->getActualMachineCompositions();
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

        return $this->render('AppBundle:Statistic:software.html.twig', array(
            'dataset' => $softwares
        ));
    }
}
