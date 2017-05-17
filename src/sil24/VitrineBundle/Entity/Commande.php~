<?php

namespace sil24\VitrineBundle\Entity;

/**
 * Commande
 */
class Commande
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $dateCommande;

    /**
     * @var string
     */
    private $etat_txt;

    /**
     * @var integer
     */
    private $etat_cd;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $lignesDeCommande;

    /**
     * @var \sil24\VitrineBundle\Entity\Client
     */
    private $client;

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
     * Set dateCommande
     *
     * @param string $dateCommande
     *
     * @return Commande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return string
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set etatTxt
     *
     * @param string $etatTxt
     *
     * @return Commande
     */
    public function setEtatTxt($etatTxt)
    {
        $this->etat_txt = $etatTxt;

        return $this;
    }

    /**
     * Get etatTxt
     *
     * @return string
     */
    public function getEtatTxt()
    {
        return $this->etat_txt;
    }

    /**
     * Set etatCd
     *
     * @param integer $etatCd
     *
     * @return Commande
     */
    public function setEtatCd($etatCd)
    {
        $this->etat_cd = $etatCd;

        return $this;
    }

    /**
     * Get etatCd
     *
     * @return integer
     */
    public function getEtatCd()
    {
        return $this->etat_cd;
    }

    /**
     * Add lignesDeCommande
     *
     * @param \sil24\VitrineBundle\Entity\LigneDeCommande $lignesDeCommande
     *
     * @return Commande
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
     * Set client
     *
     * @param \sil24\VitrineBundle\Entity\Client $client
     *
     * @return Commande
     */
    public function setClient(\sil24\VitrineBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \sil24\VitrineBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    public function setAllParamsCommande($date, $commandStateCd, $client){
        $this->setDateCommande($date);
        $this->setEtatCd($commandStateCd);
        $this->setClient($client);

        if($commandStateCd == 0){
            $this->setEtatTxt("Enregistrée");
        }else{
            $this->setEtatTxt("Validée");
        }
    }
}
