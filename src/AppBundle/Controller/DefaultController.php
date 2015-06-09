<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig', array(
            'compositionHistoryStatistics' => $this->getCompositionHistoryStatisticsData(),
        ));
    }

    private function getCompositionHistoryStatisticsData() {
        $conn = $this->container->get('database_connection');
        $query =  "SELECT count(*) as quantity, DATE(time) as dateday from compositionhistory GROUP BY dateday;";
        $stmt = $conn->query($query);
        return $stmt->fetchAll();
    }

}
