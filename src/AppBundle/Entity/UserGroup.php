<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Entity\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UserGroupRepository")
 * @ORM\Table(name="user_group")
 */
class UserGroup extends BaseGroup {
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
