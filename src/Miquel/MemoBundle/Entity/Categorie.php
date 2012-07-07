<?php

namespace Miquel\MemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Miquel\MemoBundle\Entity\Fiche;

/**
 * Miquel\MemoBundle\Entity\Categorie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Miquel\MemoBundle\Entity\CategorieRepository")
 */
class Categorie
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Miquel\MemoBundle\Entity\Fiche", mappedBy="categories")
     */
    private $fiches;
    
    
    public function __construct() 
    {
        $this->fiches = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }
    
    
    /**
     * Add Fiche
     *
     * @param Fiche $fiche
     */
    public function addFiche(Fiche $fiche)
    {
        $this->fiches[] = $fiche;
    }
    
    
    /**
     * Get fiches
     *
     * @return ArrayCollection
     */
    public function getFiches()
    {
        return $this->fiches;
    }
}