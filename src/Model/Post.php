<?php

namespace OCP5\Model;

class Post
{
    private $id;
    private $title;
    private $contenue;
    private $date_creation;
    private $dateDerModif;
    private $chapo;
    private $author;

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

    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
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
        return $this->date_creation;
    }

    public function getDateDerModif()
    {
        return $this->dateDerModif;
    }

    public function getChapo()
    {
        return $this->chapo;
    }
}

?>