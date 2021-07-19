<?php

namespace OCP5\Model;

class Post
{
    private $id;
    private $title;
    private $contenue;
    private $dateSub;
    private $dateDerModif;
    private $chapo;
    private $author;
    private $totalLike;

    //SETTER

    public function setId($id)
    {
        $id = (int) $id;
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $title = (string) $title;
        $this->title = $title;
    }

    public function setContenue($contenue)
    {
        $contenue = (string) $contenue;
        $this->contenue = $contenue;
    }

    public function setAuthor($author)
    {
        $author = (string) $author;
        $this->author = $author;
    }

    public function setDateSub($dateSub)
    {
        $this->dateSub = $dateSub;
    }

    public function setDateDerModif($dateDerModif)
    {
        $this->dateDerModif = $dateDerModif;
    }

    public function setChapo($chapo)
    {
        $chapo = (string) $chapo;
        $this->chapo = $chapo;
    }

    public function setTotalLike($totalLike)
    {
        $totalLike = (int) $totalLike;
        $this->totalLike = $totalLike;
    }

    //GETTER

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContenue()
    {
        return $this->contenue;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getDateCreation()
    {
        return $this->dateSub;
    }

    public function getDateDerModif()
    {
        return $this->dateDerModif;
    }

    public function getChapo()
    {
        return $this->chapo;
    }

    public function getTotalLike()
    {
        return $this->totalLike;
    }
}

?>