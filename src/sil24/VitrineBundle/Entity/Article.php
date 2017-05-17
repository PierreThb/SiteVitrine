<?php

namespace sil24\VitrineBundle\Entity;

/**
 * Article
 */
class Article
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prix;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $stock;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $lignesDeCommande;

    /**
     * @var \sil24\VitrineBundle\Entity\Categorie
     */
    private $categorie;

    /**
     * @var \sil24\VitrineBundle\Entity\Picture
     */
    private $picture;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lignesDeCommande = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
     * @return Article
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
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
     * Set prix
     *
     * @param string $prix
     *
     * @return Article
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return Article
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Add lignesDeCommande
     *
     * @param \sil24\VitrineBundle\Entity\LigneDeCommande $lignesDeCommande
     *
     * @return Article
     */
    public function addLignesDeCommande(\sil24\VitrineBundle\Entity\LigneDeCommande $lignesDeCommande)
    {
        $this->lignesDeCommande[] = $lignesDeCommande;

        return $this;
    }

    /**
     * Remove lignesDeCommande
     *
     * @param \sil24\VitrineBundle\Entity\LigneDeCommande $lignesDeCommande
     */
    public function removeLignesDeCommande(\sil24\VitrineBundle\Entity\LigneDeCommande $lignesDeCommande)
    {
        $this->lignesDeCommande->removeElement($lignesDeCommande);
    }

    /**
     * Get lignesDeCommande
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLignesDeCommande()
    {
        return $this->lignesDeCommande;
    }

    /**
     * Set categorie
     *
     * @param \sil24\VitrineBundle\Entity\Categorie $categorie
     *
     * @return Article
     */
    public function setCategorie(\sil24\VitrineBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \sil24\VitrineBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set picture
     *
     * @param \sil24\VitrineBundle\Entity\Picture $picture
     *
     * @return Article
     */
    public function setPicture(\sil24\VitrineBundle\Entity\Picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \sil24\VitrineBundle\Entity\Picture
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
