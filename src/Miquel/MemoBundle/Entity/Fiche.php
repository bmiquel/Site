<?php

namespace Miquel\MemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use Miquel\MemoBundle\Entity\Categorie;

/**
 * Miquel\MemoBundle\Entity\Fiche
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Miquel\MemoBundle\Entity\FicheRepository")
 */
class Fiche
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
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string $auteur
     *
     * @ORM\Column(name="auteur", type="string", length=50)
     */
    private $auteur;

    /**
     * @var date $dateCreation
     *
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

    /**
     * @var text $contenu
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;
	
	/**
     * @ORM\ManyToMany(targetEntity="Miquel\MemoBundle\Entity\Categorie", inversedBy="fiches")
     */
    private $categories;
	
	
	
	
	public function __construct ()
	{
		$this->dateCreation = new \Datetime();
		$this->categories = new ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set dateCreation
     *
     * @param date $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * Get dateCreation
     *
     * @return date 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set contenu
     *
     * @param text $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * Get contenu
     *
     * @return text 
     */
    public function getContenu()
    {
        return $this->contenu;
    }
	
	/**
     * Add categorie
     *
     * @param Categorie $categorie
     */
    public function addCategorie(Categorie $categorie)
    {
        $categorie->addFiche($this);
        
        $this->categories[] = $categorie;
    }

    /**
     * Get categories
     *
     * @return ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }
}