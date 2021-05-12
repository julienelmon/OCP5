<?php

namespace OCP5\Controller;

use OCP5\Service\TwigRenderer;
use OCP5\Manager\UserManager;
use OCP5\Manager\PostManager;

class UserController
{
    private $renderer;
    private $loginManager;
    private $postManager;

    public function __construct() 
    {
        $this->renderer = new TwigRenderer();
        $this->loginManager =  new UserManager();
        $this->postManager = new PostManager();

        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
    }

    public function homeView()
    {
        $this->renderer->render('frontend/homeView');
        $_SESSION['flash'] = array();
    }

    public function loginView()
    {
        $this->renderer->render('frontend/loginView');
        $_SESSION['flash'] = array();
    }

    public function interfaceUser()
    {
        $dataUser = $_SESSION['auth'];
        $this->renderer->render('frontend/userView', ['data_user' => $dataUser]);
        $_SESSION['flash'] = array();
    }

    public function settingAccount()
    {
        $dataUser = $_SESSION['auth'];
        $this->renderer->render('frontend/settingAccount', ['data_user' => $dataUser]);
        $_SESSION['flash'] = array();
    }

    public function getlistPost()
    {
        $dataUser = $_SESSION['auth'];
        $listPost = $this->postManager->getPost();
        $this->renderer->render('frontend/listPostView', ['listposts' => $listPost, 'data_user' => $dataUser]);
        $_SESSION['flash'] = array();
    }

    public function addPost()
    {
        $dataUser = $_SESSION['auth'];
        $this->renderer->render('frontend/addpostView', ['data_user' => $dataUser ]);
        $_SESSION['flash'] = array();
    }

    public function connectUser()
    {
        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['flash']['danger'] = 'Votre adresse mail est invalide !';
            header('Location: /OCP5/login');
        }
        elseif(empty($_POST['password']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['password']))
        {
            $_SESSION['flash']['danger'] = 'Votre mot de passe est invalide';
            header('Location: /OCP5/login');
        }
        else
        {
            $email = strip_tags(htmlspecialchars($_POST['email']));
            $password = strip_tags(htmlspecialchars($_POST['password']));

            $user = $this->loginManager->getInfoAccount($email);

            if(!$user)
            {
                $_SESSION['flash']['danger'] = 'Email ou mot de passe invalide !';
                header('Location: /OCP5/login');
            }
            else
            {
                $isPasswordCorrect = password_verify($password, $user->getPass());

                if($isPasswordCorrect != 1)
                {
                    $_SESSION['flash']['danger'] = 'Email ou mot de passe invalide';
                    header('Location: /OCP5/login');
                }
                else
                {
                    $_SESSION['auth'] = $user;
                    if($_SESSION['auth']->getUserType() == 1)
                    {
                        header('Location: /OCP5/admin');
                    }
                    else
                    {
                        header('Location: /OCP5/user');
                    }
                }
            }
        }
    }

    public function disconnect()
    {
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }

        $_SESSION = array();
        session_destroy();

        header('Location: /OCP5/login');
    }

    public function subscribe()
    {
        $this->renderer->render('frontend/subscribeView');
        $_SESSION['flash'] = array();
    }

    public function passwordVerify($password, $passwordConfirm)
    {
        if($password === $passwordConfirm)
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function subs()
    {
        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['flash']['danger'] = 'Votre email est invalide !';
            header('Location: /OCP5/subscribe');
        }
        elseif(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo']))
        {
            $_SESSION['flash']['danger'] = 'Votre pseudo est invalide !';
            header('Location: /OCP5/subscribe');
        }
        $email = strip_tags(htmlspecialchars($_POST['email']));
        $pseudo = strip_tags(htmlspecialchars($_POST['pseudo']));
        $password = strip_tags(htmlspecialchars($_POST['password']));
        $passwordConfirm = strip_tags(htmlspecialchars($_POST['password_confirm']));
        $numTel = strip_tags(htmlspecialchars($_POST['num_tel']));
        $phraseProfil = strip_tags(htmlspecialchars($_POST['phrase_profil']));
        /*
        if(isset($_FILES['picture_profil']) AND !empty($_FILES['picture_profil']['name']))
        {
            $tailleMax = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            if($_FILES['picture_profil']['size'] <= $tailleMax)
            {
                $extensionUpload = strtolower(substr(strrchr($_FILES['picture_profil']['name'], '.'), 1));
                if(in_array($extensionUpload, $extensionsValides))
                {
                    $chemin = "public/img/".$_POST['picture_profil'].".".$extensionUpload;
                    $resultat = move_uploaded_file($_FILES['picture_profil']['tmp_name'], $chemin);
                    if($resultat)
                    {
                        */
                        $pass = $this->passwordVerify($password, $passwordConfirm);

                        if($pass == true)
                        {
                            $passwordCrypte = password_hash($password, PASSWORD_BCRYPT);
                            $this->loginManager->writeAccount($email, $pseudo, $passwordCrypte, $numTel, $phraseProfil);
                            $_SESSION['flash']['success'] = 'Votre compte à été crée avec succées !';
                            header('Location: /OCP5/login');
                        }
                        else
                        {
                            $_SESSION['flash']['danger'] = 'Vos mots de passe ne correspond pas !';
                            header('Location: /OCP5/subscribe');
                        }

                        /*
                    }
                    else
                    {
                        $_SESSION['flash']['danger'] = "Erreur d'importation !";
                        header('Location: /OCP5/subscribe');
                    }
                }
                else
                {
                    $_SESSION = 'Votre photo de profil a un format invalide !';
                    header('Location: /OCP5/subscribe');
                }
            }
            else
            {
                $_SESSION['flash']['danger'] = 'Votre photo de profil est trop volumineuse';
                header('Location: /OCP5/subscribe');
            }
        }
        */

    }
    /*
    public function settingSet()
    {
        if(!empty($_POST['email']))
        {
            $email = strip_tags(htmlspecialchars($_POST['email']));
            $verify = $this->loginManager->checkexistMail($email);

            if($verify == false)
            {
                $_SESSION['flash']['danger'] = 'Le mail que vous avez rentrer est déja utilisé';
                header('Location: /OCP5/settingaccount');
            }
            else
            {
                
            }
        } 
        elseif(!empty($_POST['pseudo']))
        {
            $pseudo = strip_tags(htmlspecialchars($_POST['pseudo']));
        }

        if($email || $pseudo)
        {
            $this->loginManager->writeSettingAccount($email, $pseudo);
            header('Location: /OCP5/');
        }
    }
*/
    public function addPostcreate()
    {
        if(!empty($_POST['title']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['title']))
        {
            if(!empty($_POST['contenue']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['contenue']))
            {
                if(!empty($_POST['chapo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['chapo']))
                {
                    $title = strip_tags(htmlspecialchars($_POST['title']));
                    $contenue = strip_tags(htmlspecialchars($_POST['contenue']));
                    $chapo = strip_tags(htmlspecialchars($_POST['chapo']));
                    $pseudo = $_SESSION['auth']->getPseudo();
                    if($title || $contenue || $chapo || $pseudo)
                    {
                        $this->postManager->writePost($title, $contenue, $chapo, $pseudo);
                        $_SESSION['flash']['sucess'] = 'Votre post à été publié !';
                        header('Location: /OCP5/listpost');
                    } 
                    else
                    {
                        $_SESSION['flash']['danger'] = 'Erreur : un problème est survenue';
                        header('Location: /OCP5/listpost/addpost');
                    }
                }
                else
                {
                    $_SESSION['flash']['danger'] = 'Votre chapô est invalide';
                }
            }
            else
            {
                $_SESSION['flash']['danger'] = 'Votre contenue est invalide';
            }
        }
        else
        {
            $_SESSION['flash']['danger'] = 'Votre titre est invalide';
        }
    }
}

?>