<?php 

namespace OCP5\Manager;

use OCP5\Model\User;
use OCP5\Service\Database;

class UserManager extends Database 
{
    public function getInfoAccount($email)
    {
        $sql = "SELECT * FROM membres WHERE email = '$email'";

        $result = $this->sql($sql);

        $row = $result->fetch();

        if(!$row)
        {
            $_SESSION['flash']['danger'] = 'Mauvais Utilisateur / Mot de passe';
        }
        else
        {
            return $this->buildUser($row);
        }
    }

    public function writeAccount($email, $pseudo, $pass, $numTel, $phraseProfil)
    {
        $sql = "INSERT INTO membres SET pseudo = '$pseudo', pass = '$pass', email = '$email', num_tel = '$numTel', phrase_profil = '$phraseProfil'";

        $this->sql($sql);
    }

    public function writeSettingAccount($email, $pseudo, $id)
    {
        $sql = "INSERT INTO membres SET pseudo = '$pseudo', email = '$email' WHERE id = '$id'";

        $this->sql($sql);
    }

    public function checkexistMail($email)
    {
        $sql = "SELECT email FROM membres WHERE email = '$email'";

        $result = $this->sql($sql);

        $row = $result->fetch();

        if($row)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function author($postId)
    {
        $sql = "SELECT pseudo FROM membres WHERE id = '$postId'";

        $result = $this->sql($sql);

        $row = $result->fetchAll();

        return $row;
    }

    public function buildUser($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setPass($row['pass']);
        $user->setEmail($row['email']);
        $user->setDate_inscription($row['date_inscription']);
        $user->setUserType($row['user_type']);
        $user->setNum_tel($row['num_tel']);
        $user->setPicture_profile($row['picture_profile']);
        $user->setPhrase_profil($row['phrase_profil']);
        $user->setLien_CV($row['lien_cv']);

        return $user;
    }
}

?>