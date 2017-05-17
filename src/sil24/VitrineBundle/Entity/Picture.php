<?php

namespace sil24\VitrineBundle\Entity;

/**
 * Picture
 */
class Picture
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
     * @var \sil24\VitrineBundle\Entity\Article
     */
    private $article;


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
     * @return Picture
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
     * Set article
     *
     * @param \sil24\VitrineBundle\Entity\Article $article
     *
     * @return Picture
     */
    public function setArticle(\sil24\VitrineBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \sil24\VitrineBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }
}

