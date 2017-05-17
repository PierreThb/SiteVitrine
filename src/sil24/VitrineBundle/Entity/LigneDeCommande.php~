<?php

namespace sil24\VitrineBundle\Entity;

/**
 * LigneDeCommande
 */
class LigneDeCommande
{
    /**
     * @var integer
     */
    private $quantite;

    /**
     * @var string
     */
    private $prixArticle;

    /**
     * @var string
     */
    private $total;

    /**
     * @var \sil24\VitrineBundle\Entity\Commande
     */
    private $commande;

    /**
     * @var \sil24\VitrineBundle\Entity\Article
     */
    private $article;

    public function setAllParams($article, $quantite, $prixArticle, $commande){
        $this->setArticle($article);
        $this->setQuantite($quantite);
        $this->setPrixArticle($prixArticle);
        $this->setCommande($commande);

        $total = $quantite * $prixArticle;
        $this->setTotal($total);
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return LigneDeCommande
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set prixArticle
     *
     * @param string $prixArticle
     *
     * @return LigneDeCommande
     */
    public function setPrixArticle($prixArticle)
    {
        $this->prixArticle = $prixArticle;

        return $this;
    }

    /**
     * Get prixArticle
     *
     * @return string
     */
    public function getPrixArticle()
    {
        return $this->prixArticle;
    }

    /**
     * Set total
     *
     * @param string $total
     *
     * @return LigneDeCommande
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set commande
     *
     * @param \sil24\VitrineBundle\Entity\Commande $commande
     *
     * @return LigneDeCommande
     */
    public function setCommande(\sil24\VitrineBundle\Entity\Commande $commande)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \sil24\VitrineBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set article
     *
     * @param \sil24\VitrineBundle\Entity\Article $article
     *
     * @return LigneDeCommande
     */
    public function setArticle(\sil24\VitrineBundle\Entity\Article $article)
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
