<?php

namespace OCP5\Controller;

use OCP5\Service\TwigRenderer;
use OCP5\Manager\UserManager;

class UserController
{
    private $renderer;
    private $loginManager;

    public function __construct() 
    {
        $this->renderer = new TwigRenderer();
        $this->loginManager =  new UserManager();

        if (session_status() == PHP_SESSION_NONE)
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

    public function connectUser()
    {
        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['flash']['danger'] = 'Votre email est invalide !';
            header('Location: /OCP5/login');
        }
        elseif(empty($_POST['password']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['password']))
        {
            $_SESSION['flash']['danger'] = 'Votre password est invalide';
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
}

?>