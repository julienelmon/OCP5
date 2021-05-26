<?php

namespace OCP5\Model;

class User
{

    const TYPE_USER = 0;
    const TYPE_ADMIN = 1;

    private $id;
    private $pseudo;
    private $pass;
    private $email;
    private $dateSub;
    private $userType;
    private $numTel;
    private $pictureProfil;
    private $phraseProfil;
    private $linkCV;
    private $linkGit;
    private $linkLinkedIn;
    private $linkTwitter;

    //SETTER

    public function setId($id)
    {
        $id = (int) $id;
        $this->id = $id;
    }

    public function setPseudo($pseudo)
    {
        $pseudo = (string) $pseudo;
        $this->pseudo = $pseudo;
    }

    public function setPass($pass)
    {
        $pass = (string) $pass;
        $this->pass = $pass;
    }

    public function setEmail($email)
    {
        $email = (string) $email;
        $this->email = $email;
    }

    public function setDateSub($dateSub)
    {
        $this->dateSub = $dateSub;
    }

    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    public function setNumTel($numTel)
    {
        $numTel = (string) $numTel;
        $this->numTel = $numTel;
    }

    public function setPictureProfil($pictureProfil)
    {
        $pictureProfil = (string) $pictureProfil;
        $this->pictureProfil = $pictureProfil;
    }

    public function setPhraseProfil($phraseProfil)
    {
        $phraseProfil = (string) $phraseProfil;
        $this->phraseProfil = $phraseProfil;
    }

    public function setLinkCV($linkCV)
    {
        $linkCV = (string) $linkCV;
        $this->linkCV = $linkCV;
    }

    public function setLinkGit($linkGit)
    {
        $linkGit = (string) $linkGit;
        $this->linkGit = $linkGit;
    }

    public function setLinkLinkedIn($linkLinkedIn)
    {
        $linkLinkedIn = (string) $linkLinkedIn;
        $this->linkLinkedIn = $linkLinkedIn;
    }

    public function setLinkTwitter($linkTwitter)
    {
        $linkTwitter = (string) $linkTwitter;
        $this->linkTwitter = $linkTwitter;
    }

    //GETTER

    public function getId()
    {
        return $this->id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDateSub()
    {
        return $this->dateSub;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function getNumTel()
    {
        return $this->numTel;
    }

    public function getPictureProfil()
    {
        return $this->pictureProfil;
    }

    public function getPhraseProfil()
    {
        return $this->phraseProfil;
    }

    public function getLinkCV()
    {
        return $this->linkCV;
    }

    public function getLinkGit()
    {
        return $this->linkGit;
    }

    public function getLinkLinkedIn()
    {
        return $this->linkLinkedIn;
    }

    public function getLinkTwitter()
    {
        return $this->linkTwitter;
    }

    // Vérifie le type de l'utilisateur

    public function isAdmin()
    {
        return $this->getUserType() == self::TYPE_ADMIN;
    }

}

?>