<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is the Person class.
 *
 * @ApiResource
 * @ORM\Entity
 */
class Person
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The name
     *
     * @ORM\Column
     * @Assert\NotBlank
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $name = '';

    /**
     * @var \DateInterface The date of birth
     *
     * @ORM\Column(type="date_immutable")
     */
    public $dateBirth;

     /**
      * @var \DateInterface The date of death
      *
      * @ORM\Column(type="date_immutable")
      */
    public $dateDeath;

    /**
     * @var Works[] Created works
     * 
     * @ORM\OneToMany(targetEntity="Work", mappedBy="creator")
     */
    public $works;

    /**
     * @var Roles The role of a person.
     *
     * @ORM\OneToMany(targetEntity="ExpressionRolePerson", mappedBy="person")
     */
    public $roles;

    public function __construct() {
        $this->works = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
