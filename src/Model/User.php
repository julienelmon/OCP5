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
        return $this->date_creation;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function getUserTypeString(): string
    {
        return self::USERTYPE[$this->date_create];
    }

    public function displayInfo(){
        echo $this->id;
        echo $this->pseudo;
        echo $this->pass;
        echo $this->email;
        echo $this->date_inscription;
    }


}

?>