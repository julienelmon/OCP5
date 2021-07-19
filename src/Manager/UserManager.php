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

        if(!$row){
            $_SESSION['flash']['danger'] = 'Mauvais Utilisateur / Mot de passe';
        } else {
            return $this->buildUser($row);
        }
    }

    public function getInfoAccountPerName($pseudo)
    {
        $req = $this->sql(
            "SELECT * FROM membres WHERE pseudo = :pseudo",
            [
                'pseudo' => $pseudo,
            ]
        );

        $row = $req->fetch();

        if(!$row){
            $_SESSION['flash']['danger'] = 'Utilisateur introuvable';
        } else {
            return $row;
        }
    }

    public function writeAccount($email, $pseudo, $pass, $numTel, $phraseProfil, $pictureProfil, $linkCv, $linkGit, $linkLinkedIn, $linkTwitter)
    {
        $req = $this->sql(
            "INSERT INTO membres SET pseudo = :pseudo, pass = :pass, email = :email, num_tel = :numtel, phrase_profil = :phraseprofil, picture_profile = :pictureprofil , lien_cv = :liencv, git_url = :liengit, linkedin_url = :lienlinkedin, twitter_url = :lientwitter, user_type = '0'",
            [
                'pseudo' => $pseudo,
                'pass' => $pass,
                'email' => $email,
                'numtel' => $numTel,
                'phraseprofil' => $phraseProfil,
                'pictureprofil' => $pictureProfil,
                'liencv' => $linkCv,
                'liengit' => $linkGit,
                'lienlinkedin' => $linkLinkedIn,
                'lientwitter' => $linkTwitter,
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

        foreach($result as $row){
            $userId = $row['id'];
            $user[$userId] = $this->buildUser($row);
        }

        return $user;
    }

    public function deleteAccount($idAccount)
    {
        $req = $this->sql(
            "DELETE FROM membres WHERE id = :idaccount",
            [
                'idaccount' => $idAccount,
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

        if($row){
            return false;
        } else {
            return true;
        }
    }

    public function contactForm($pseudo, $email, $message)
    {
        $messages = "Nom : ".$pseudo." Mail : ".$email." Message : ".$message;
        $to = "mrgeveixofficiel@gmail.com";
        $subject = $pseudo;
        mail($to, $subject, $messages);
        /*
        $enteteamail = "From: OCP5 <julienelmon@gmail.com\r\n";
        $enteteamail = "Reply-To: julienelmon@gmail.com";
        $enteteamail = "X-Mailer: PHP/".phpversion()."\n";
        $enteteamail = "Content-Type: text/plain; charset=utf8\r\n";
        $objet = "Confirmation compte crée";
        $message_email = $pseudo ."vien de crée un compte ";

        mail($email, $objet, $message_email, $enteteamail);

        $enteteamail = "From:".$pseudo."<".$email.">\r\n";
        $enteteamail = "Reply-To:".$email."\n";
        $enteteamail = "X-Mailer: PHP/".phpversion()."\n";
        $enteteamail = "Content-Type: text/plain; charset=utf8\r\n";
        $objet = "Confirmation de création de votre compte";
        $message_email = $message;

        mail('julienelmon@gmail.com', $objet, $message_email, $enteteamail);
        */
    }

    public function buildUser($row)
    {
        $user = new User();
        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setPass($row['pass']);
        $user->setEmail($row['email']);
        $user->setDateSub($row['date_inscription']);
        $user->setUserType($row['user_type']);
        $user->setNumTel($row['num_tel']);
        $user->setPictureProfil($row['picture_profile']);
        $user->setPhraseProfil($row['phrase_profil']);
        $user->setLinkCV($row['lien_cv']);
        $user->setLinkGit($row['git_url']);
        $user->setLinkLinkedIn($row['linkedin_url']);
        $user->setLinkTwitter($row['twitter_url']);

        return $user;
    }
}

?>