<?php

class Regime
{
    private $id_r;
    private $id_u;
    private $titre;
    private $discription;
    private $kcl;

    public function __construct($id_u, $titre, $discription, $kcl)
    {
        $this->id_u = $id_u;
        $this->titre = $titre;
        $this->discription = $discription;
        $this->kcl = $kcl;
    }

    public function getIdR()
    {
        return $this->id_r;
    }

    public function getUserId()
    {
        return $this->id_u;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getDiscription()
    {
        return $this->discription;
    }

    public function getKcl()
    {
        return $this->kcl;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setDiscription($discription)
    {
        $this->discription = $discription;
    }

    public function setKcl($kcl)
    {
        $this->kcl = $kcl;
    }
}
?>
