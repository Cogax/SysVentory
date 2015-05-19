<?php

namespace AppBundle\EventListener;


use AppBundle\Entity\Composition;
use AppBundle\Entity\Cpu;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

class UniqueComponent {

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if($entity instanceof Composition) {
            $entityManager = $args->getEntityManager();

            /**
             * @todo A custom repository (maybe defaultrepo) would be better to
             * check dynamicly (maybe by annotations) if the entity already
             * exists in db. I would prefer to call it something like
             * findByProperties or findByDefinedProperties
             */
            $this->prePersistCompositionHandleCpus($entity, $entityManager);
            $this->prePersistCompositionHandleMachine($entity, $entityManager);
            $this->prePersistCompositionHandleNetworkInterfaces($entity, $entityManager);
            $this->prePersistCompositionHandleOperatingSystem($entity, $entityManager);
            $this->prePersistCompositionHandlePrinters($entity, $entityManager);
            $this->prePersistCompositionHandleSoftwares($entity, $entityManager);
        }
    }



    private function prePersistCompositionHandleCpus(Composition $entity, EntityManager $entityManager) {
        $cpus = $entity->getCpus();
        /** @var \AppBundle\Entity\Cpu $cpu */
        foreach($cpus as $key => $cpu) {
            $results = $entityManager->getRepository("AppBundle:Cpu")->findBy(array(
              'name' => $cpu->getName(),
              'family' => $cpu->getFamily(),
              'clock' => $cpu->getClock(),
              'cores' => $cpu->getCores()
            ), array('id' => 'ASC'));

            if(count($results) > 0) {
                //die('found!');
                $cpus[$key] = $results[0];
            }
        }
    }

    private function prePersistCompositionHandleMachine(Composition $entity, EntityManager $entityManager) {
        // Handle Machine
        $machine = $entity->getMachine();
        $results = $entityManager->getRepository("AppBundle:Machine")->findBy(array(
          'manufracturer' => $machine->getManufracturer(),
          'model' => $machine->getModel(),
          'memory' => $machine->getMemory(),
          'computerName' => $machine->getComputerName(),
          'serialNumber' => $machine->getSerialNumber(),
          'uuid' => $machine->getUuid(),
        ), array('id' => 'ASC'));

        if(count($results) > 0) {
            $machine = $results[0];
        }
    }

    private function prePersistCompositionHandleNetworkInterfaces(Composition $entity, EntityManager $entityManager) {
        // Handle NetworkInterface
        $nics = $entity->getNetworkInterfaces();
        /** @var \AppBundle\Entity\NetworkInterface $nic */
        foreach($nics as $key => $nic) {
            $results = $entityManager->getRepository("AppBundle:NetworkInterface")->findBy(array(
              'description' => $nic->getDescription(),
              'ipv4' => $nic->getIpv4(),
              'ipv4Subnet' => $nic->getIpv4Subnet(),
              'ipv4DefaultGateway' => $nic->getIpv4DefaultGateway(),
              'ipv6' => $nic->getIpv6(),
              'ipv6Subnet' => $nic->getIpv6Subnet(),
              'ipv6DefaultGateway' => $nic->getIpv6DefaultGateway(),
              'dhcp' => $nic->getDhcp(),
              'mac' => $nic->getMac(),
            ), array('id' => 'ASC'));

            if(count($results) > 0) {
                $nics[$key] = $results[0];
            }
        }
    }

    private function prePersistCompositionHandleOperatingSystem(Composition $entity, EntityManager $entityManager) {
        // Handle OperatingSystem
        $os = $entity->getOperatingSystem();
        $results = $entityManager->getRepository("AppBundle:OperatingSystem")->findBy(array(
          'name' => $os->getName(),
          'version' => $os->getVersion(),
          'servicePack' => $os->getServicePack(),
          'architecture' => $os->getArchitecture(),
        ), array('id' => 'ASC'));

        if(count($results) > 0) {
            $os = $results[0];
        }
    }

    private function prePersistCompositionHandlePrinters(Composition $entity, EntityManager $entityManager) {
        // Handle Printers
        $printers = $entity->getPrinters();
        /** @var \AppBundle\Entity\Printer $printer */
        foreach($printers as $key => $printer) {
            $results = $entityManager->getRepository("AppBundle:Printer")->findBy(array(
              'name' => $printer->getName(),
              'driver' => $printer->getDriver(),
              'version' => $printer->getVersion(),
            ), array('id' => 'ASC'));

            if(count($results) > 0) {
                $printers[$key] = $results[0];
            }
        }
    }

    private function prePersistCompositionHandleSoftwares(Composition $entity, EntityManager $entityManager) {
        // Handle Softwares
        $softwares = $entity->getSoftwares();
        /** @var \AppBundle\Entity\Software $software */
        foreach($softwares as $key => $software) {
            $results = $entityManager->getRepository("AppBundle:Software")->findBy(array(
              'name' => $software->getName(),
              'version' => $software->getVersion(),
            ), array('id' => 'ASC'));

            if(count($results) > 0) {
                $softwares[$key] = $results[0];
            }
        }
    }


}