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

    public function buildUser($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setPass($row['pass']);
        $user->setEmail($row['email']);
        $user->setDate_inscription($row['date_inscription']);
        $user->setUserType($row['user_type']);

        return $user;
    }
}

?>