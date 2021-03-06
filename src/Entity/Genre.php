<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * This is the Genre class. A literary genre is a particular type or style of literature that a scholar can recognise according to its peculiarities and features
 *
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     },
 *      itemOperations={
 *         "get",
 *         "put"={"access_control"="is_granted('ROLE_ADMIN')"},
 *         "delete"={"access_control"="is_granted('ROLE_ADMIN')"}
 *     },
 *     attributes={"order"={"genre": "ASC"}}
 * )
 * @ORM\Entity
 * @UniqueEntity("genre")
 */
class Genre
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
     * @var string, The genre
     *
     * @ORM\Column
     * @Assert\NotNull
     * @ApiProperty(iri="http://schema.org/name")
     */
    public $genre;

    /**
     * @var Works the list of the works for this genre
     * @ORM\ManyToMany(targetEntity="Work", mappedBy="genres")
     * -ontology-name is_genre_of
     * -ontology-range &biflow;Work
     * -ontology-comment This genre is used for that work
     */
    public $works;

    public function __construct() {
        $this->works = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
