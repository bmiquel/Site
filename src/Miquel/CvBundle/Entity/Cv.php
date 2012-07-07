<?php

namespace Miquel\CvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Miquel\CvBundle\Entity\Cv
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Miquel\CvBundle\Entity\CvRepository")
 */
class Cv
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
     * @var date $dateModification
     *
     * @ORM\Column(name="dateModification", type="date")
     */
    private $dateModification;

    /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=100)
     */
    private $titre;

    /**
     * @var date $dateNaissance
     *
     * @ORM\Column(name="dateNaissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var string $poste
     *
     * @ORM\Column(name="poste", type="string", length=100)
     */
    private $poste;
	
	/**
     * @var boolean $defaut
     *
     * @ORM\Column(name="defaut", type="boolean")
     */
    private $defaut;
	
	
	
	public function __construct()
    {
        $this->dateCreation = new \Datetime(); 
		$this->dateModification = new \Datetime(); 
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
     * Set dateModification
     *
     * @param date $dateModification
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;
    }

    /**
     * Get dateModification
     *
     * @return date 
     */
    public function getDateModification()
    {
        return $this->dateModification;
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
     * Set dateNaissance
     *
     * @param date $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * Get dateNaissance
     *
     * @return date 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set poste
     *
     * @param string $poste
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;
    }

    /**
     * Get poste
     *
     * @return string 
     */
    public function getPoste()
    {
        return $this->poste;
    }
}