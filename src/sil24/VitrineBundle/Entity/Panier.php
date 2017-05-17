<?php

namespace sil24\VitrineBundle\Entity;

class Panier {
private $contenu;
//Tableau - contenu[i] = quantite d'article d’id=i dans le panier)

    public function __construct() {
    // initialise le contenu
        $this->contenu = array();
    }

    public function getContenu() {
    // getter
        return $this->contenu;
    }

    public function ajoutArticle($articleId, $qte) {
    // ajoute l'article $articleId au contenu, en quantité $qte
    // (vérifier si l'article n'y est pas déjà)
        if(!isset($this->contenu[$articleId])) {
            $this->contenu[$articleId] = $qte;
        } else {
            $this->contenu[$articleId] += $qte;
        }
    }

    public function supprimeArticle($articleId) {
    // supprimer l'article $articleId du contenu
        unset($this->contenu[$articleId]);
    }

    public function viderPanier() {
    // vide le contenu
        $this->contenu=[];
    }
}