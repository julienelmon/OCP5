<?php 

namespace OCP5\Manager;

use OCP5\Model\User;
use OCP5\Service\Database;

class UserManager extends Database 
{
    public function getInfoAccount($email)
    {
        $req = $this->sql(
            "SELECT * FROM membres WHERE email = :email",
            [
                'email' => $email,
            ]
        );

        $row = $req->fetch();

        if(!$row)
        {
            $_SESSION['flash']['danger'] = 'Mauvais Utilisateur / Mot de passe';
        }
        else
        {
            return $this->buildUser($row);
        }
    }

    public function writeAccount($email, $pseudo, $pass, $numTel, $phraseProfil, $pictureProfil)
    {
        $req = $this->sql(
            "INSERT INTO membres SET pseudo = :pseudo, pass = :pass, email = :email, num_tel = :numtel, phrase_profil = :phraseprofil, picture_profile = :pictureprofil ,user_type = '0'",
            [
                'pseudo' => $pseudo,
                'pass' => $pass,
                'email' => $email,
                'numtel' => $numTel,
                'phraseprofil' => $phraseProfil,
                'pictureprofil' => $pictureProfil,
            ]
        );
    }

    public function writeSettingAccount($email, $pseudo, $id)
    {
        $req = $this->sql(
            "INSERT INTO membres SET pseudo = :pseudo, email = :email WHERE id = :id",
            [
                'email' => $email,
                'pseudo' => $pseudo,
                'id' => $id,
            ]
        );
    }

    public function getAllAccount()
    {
        $sql = "SELECT * FROM membres";

        $result = $this->sql($sql);

        $user = [];

        foreach($result as $row)
        {
            $userId = $row['id'];
            $user[$userId] = $this->buildUser($row);
        }

        return $user;
    }

    public function deleteAccount($idaccount)
    {
        $req = $this->sql(
            "DELETE FROM membres WHERE id = :idaccount",
            [
                'idaccount' => $idaccount,
            ]
        );
    }

    public function checkexistMail($email)
    {
        $req = $this->sql(
            "SELECT email FROM membres WHERE email = :email'",
            [
                'email' => $email,
            ]
        );

        $row = $req->fetch();

        if($row)
        {
            return false;
        }
        else
        {
            return true;
        }
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