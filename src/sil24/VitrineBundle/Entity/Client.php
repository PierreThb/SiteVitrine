<?php

namespace sil24\VitrineBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\EqualTo;

/**
 * Client
 */
class Client implements UserInterface, \Serializable
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $commandes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commandes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getUsername() {
        return $this->email; // l'email est utilisé comme login
    }

    public function getSalt() {
        return null; // inutile avec l’encryptage choisi
    }

    public function getRoles() {
        if ($this->isAdministrateur()) // Si le client est administrateur
            return array('ROLE_ADMIN'); // on lui accorde le rôle ADMIN
        else
            return array('ROLE_USER'); // sinon le rôle USER
    }

    public function eraseCredentials(){// rien à faire ici
    }

    public function serialize() { // pour pouvoir sérialiser le Client en session
        return serialize(array($this->id));
    }

    public function unserialize($serialized) {
        list ($this->id) = unserialize($serialized);
    }

    public function isAdministrateur(){
        return ($this->name=='admin');
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
     * Set name
     *
     * @param string $name
     *
     * @return Client
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Client
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add commande
     *
     * @param \sil24\VitrineBundle\Entity\Commande $commande
     *
     * @return Client
     */
    public function addCommande(\sil24\VitrineBundle\Entity\Commande $commande)
    {
        $this->commandes[] = $commande;

        return $this;
    }

    /**
     * Remove commande
     *
     * @param \sil24\VitrineBundle\Entity\Commande $commande
     */
    public function removeCommande(\sil24\VitrineBundle\Entity\Commande $commande)
    {
        $this->commandes->removeElement($commande);
    }

    /**
     * Get commandes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommandes()
    {
        return $this->commandes;
    }
}
