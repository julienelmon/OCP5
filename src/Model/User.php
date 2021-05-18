<?php

namespace OCP5\Model;

class User
{

    const USERTYPE = [
        1 => 'Membre',
        2 => 'Admin'
    ];

    private $id;
    private $pseudo;
    private $pass;
    private $email;
    private $date_inscription;
    private $userType;
    private $numTel;
    private $pictureProfile;
    private $phraseProfil;
    private $lienCV;

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

    public function setDate_inscription($date_inscription)
    {
        $this->date_inscription = $date_inscription;
    }

    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    public function setNum_tel($numTel)
    {
        $numTel = (string) $numTel;
        $this->numTel = $numTel;
    }

    public function setPicture_profile($pictureProfile)
    {
        $pictureProfile = (string) $pictureProfile;
        $this->pictureProfile = $pictureProfile;
    }

    public function setPhrase_profil($phraseProfil)
    {
        $phraseProfil = (string) $phraseProfil;
        $this->phraseProfil = $phraseProfil;
    }

    public function setLien_CV($lienCV)
    {
        $lienCV = (string) $lienCV;
        $this->lienCV = $lienCV;
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

    public function getDate_inscription()
    {
        return $this->date_inscription;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function getUserTypeString(): string
    {
        return self::USERTYPE[$this->date_create];
    }

    public function getNum_tel()
    {
        return $this->numTel;
    }

    public function getPicture_profile()
    {
        return $this->pictureProfile;
    }

    public function getPhrase_profil()
    {
        return $this->phraseProfil;
    }

    public function getLien_CV()
    {
        return $this->lienCV;
    }



}

?>