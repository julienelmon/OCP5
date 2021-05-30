<?php

namespace OCP5\Controller;

use OCP5\Service\TwigRenderer;
use OCP5\Manager\UserManager;
use OCP5\Manager\PostManager;
use OCP5\Manager\CommentManager;

class UserController
{
    private $renderer;
    private $loginManager;
    private $postManager;
    private $commentManager;

    public function __construct() 
    {
        $this->renderer = new TwigRenderer();
        $this->loginManager =  new UserManager();
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();

        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
    }

    public function homeView()
    {
        $listPost = $this->postManager->getPostLimit();
        if(isset($_SESSION['auth'])){
            $dataUser = $_SESSION['auth'];
            $this->renderer->render('frontend/homeView', ['data_user' => $dataUser, 'data_posts' => $listPost]);
            $_SESSION['flash'] = array();
        } else {
            $this->renderer->render('frontend/homeView', ['data_posts' => $listPost]);
            $_SESSION['flash'] = array();
        }
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

    public function interfaceAdmin()
    {
        $dataUser = $_SESSION['auth'];
        $this->renderer->render('admin/adminView', ['data_user' => $dataUser]);
        $_SESSION['flash'] = array();
    }

    public function listPostUser()
    {
        $dataUser = $_SESSION['auth'];
        $pseudo = $_SESSION['auth']->getPseudo();
        $listPostUser = $this->postManager->getListPostUser($pseudo);
        $this->renderer->render('frontend/listpostuserView', ['data_user' => $dataUser, 'data_post_users' => $listPostUser] );
        $_SESSION['flash'] = array();
    }

    public function editPost()
    {
        $dataUser = $_SESSION['auth'];
        $postModif = $this->postManager->getOnePost($_POST['commentid']);
        $this->renderer->render('frontend/editpostuserView', ['data_user' => $dataUser, 'postmodif' => $postModif]);
    }

    public function contactForm()
    {
        $this->renderer->render('frontend/contactformView');
        $_SESSION['flash'] = array();
    }

    public function updatePost()
    {
        if(!empty($_POST['title']) || !empty($_POST['contenue']) || !empty($_POST['chapo'])){
            $titleUpdate = strip_tags(htmlspecialchars($_POST['title']));
            $contenueUpdate = strip_tags($_POST['contenue']);
            $chapoUpdate = strip_tags(htmlspecialchars($_POST['chapo']));
            $dateUpdate = date("y/m/d");
            $postId = $_POST['postid'];

            $this->postManager->updatePost($titleUpdate, $contenueUpdate, $chapoUpdate, $dateUpdate, $postId);
            $_SESSION['flash']['success'] = 'Post modifier avec succès';
            header('Location: /OCP5/listpostuser');
        }
    }


    public function connectUser()
    {
        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $_SESSION['flash']['danger'] = 'Votre adresse mail est invalide !';
            header('Location: /OCP5/login');
        } elseif(empty($_POST['password']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['password'])){
            $_SESSION['flash']['danger'] = 'Votre mot de passe est invalide';
            header('Location: /OCP5/login');
        } else {
            $email = strip_tags(htmlspecialchars($_POST['email']));
            $password = strip_tags(htmlspecialchars($_POST['password']));

            $user = $this->loginManager->getInfoAccount($email);

            if(!$user){
                $_SESSION['flash']['danger'] = 'Email ou mot de passe invalide !';
                header('Location: /OCP5/login');
            } else {
                $isPasswordCorrect = password_verify($password, $user->getPass());

                if($isPasswordCorrect != 1){
                    $_SESSION['flash']['danger'] = 'Email ou mot de passe invalide';
                    header('Location: /OCP5/login');
                } else {
                    $_SESSION['auth'] = $user;
                    if($_SESSION['auth']->getUserType() == 1){
                        header('Location: /OCP5/admin');
                    } else {
                        header('Location: /OCP5/user');
                    }
                }
            }
        }
    }

    public function disconnect()
    {
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
        if($password === $passwordConfirm){
            return true;
        } else {
            return false;
        }
    }

    public function subs()
    {
        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash']['danger'] = 'Votre email est invalide !';
            header('Location: /OCP5/subscribe');
        } elseif(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['pseudo'])) {
            $_SESSION['flash']['danger'] = 'Votre pseudo est invalide !';
            header('Location: /OCP5/subscribe');
        }
        $email = strip_tags(htmlspecialchars($_POST['email']));
        $pseudo = strip_tags(htmlspecialchars($_POST['pseudo']));
        $password = strip_tags(htmlspecialchars($_POST['password']));
        $passwordConfirm = strip_tags(htmlspecialchars($_POST['password_confirm']));
        $numTel = strip_tags(htmlspecialchars($_POST['num_tel']));
        $phraseProfil = strip_tags(htmlspecialchars($_POST['phrase_profil']));
        $linkGit = strip_tags(htmlspecialchars($_POST['git_url']));
        $linkLinkedIn = strip_tags(htmlspecialchars($_POST['linkedin_url']));
        $linkTwitter = strip_tags(htmlspecialchars($_POST['twitter_url']));

        
        if(isset($_FILES['picture_profil']) AND !empty($_FILES['picture_profil']['name'] AND isset($_FILES['cv_profil']) AND !empty($_FILES['cv_profil']['name']))){

            $tailleMax = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'png');

            $cheminCv = "public/cv/".$_FILES['cv_profil']['name'];

            if($_FILES['picture_profil']['size'] <= $tailleMax){

                $extensionUpload = strtolower(substr(strrchr($_FILES['picture_profil']['name'], '.'), 1));
                if(in_array($extensionUpload, $extensionsValides)){

                    $path = "public/img/".$_FILES['picture_profil']['name'];
                    $result = move_uploaded_file($_FILES['picture_profil']['tmp_name'], $path);
                    $resultCv = move_uploaded_file($_FILES['cv_profil']['tmp_name'], $cheminCv);

                    if($result && $resultCv){
                        
                        $pass = $this->passwordVerify($password, $passwordConfirm);

                        if($pass == true){

                            $passwordCrypte = password_hash($password, PASSWORD_BCRYPT);
                            $this->loginManager->writeAccount($email, $pseudo, $passwordCrypte, $numTel, $phraseProfil, $path, $cheminCv ,$linkGit, $linkLinkedIn, $linkTwitter);
                            $_SESSION['flash']['success'] = 'Votre compte à été crée avec succées !';
                            header('Location: /OCP5/login');
                        } else {

                            $_SESSION['flash']['danger'] = 'Vos mots de passe ne correspond pas !';
                            header('Location: /OCP5/subscribe');
                        }
                    } else {
                        $_SESSION['flash']['danger'] = "Erreur d'importation !";
                        header('Location: /OCP5/subscribe');
                    }
                } else {
                    $_SESSION = 'Votre photo de profil a un format invalide !';
                    header('Location: /OCP5/subscribe');
                }
            } else {
                $_SESSION['flash']['danger'] = 'Votre photo de profil est trop volumineuse';
                header('Location: /OCP5/subscribe');
            }
        }
        

    }

    public function addPostCreate()
    {
        if(!empty($_POST['title']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['title'])){
            if(!empty($_POST['contenue']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['contenue'])){
                if(!empty($_POST['chapo']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['chapo'])){
                    $title = strip_tags(htmlspecialchars($_POST['title']));
                    $contenue = strip_tags($_POST['contenue'], '<p><i><b><u>');
                    $chapo = strip_tags(htmlspecialchars($_POST['chapo']));
                    $pseudo = $_SESSION['auth']->getPseudo();
                    $dateCreate = date('d/m/y H:i');
                    if($title || $contenue || $chapo || $pseudo){
                        $this->postManager->writePost($title, $contenue, $chapo, $dateCreate, $pseudo);
                        $_SESSION['flash']['success'] = 'Votre post à été publié !';
                        header('Location: /OCP5/listpost');
                    } else {
                        $_SESSION['flash']['danger'] = 'Erreur : un problème est survenue';
                        header('Location: /OCP5/listpost/addpost');
                    }
                } else {
                    $_SESSION['flash']['danger'] = 'Votre chapô est invalide';
                }
            } else {
                $_SESSION['flash']['danger'] = 'Votre contenue est invalide';
            }
        } else {
            $_SESSION['flash']['danger'] = 'Votre titre est invalide';
        }
    }

    public function viewPost($id)
    {
        $post = $this->postManager->getOnePost($id);
        $comment = $this->commentManager->getCommentsPost($id);

        $dataUser = $_SESSION['auth'];
        $this->renderer->render('frontend/viewPost', ['data_post' => $post, 'data_user' => $dataUser, 'data_comments' => $comment]);
        $_SESSION['flash'] = array();
    }

    public function addComment($postId)
    {
        if(!empty($_POST['comment']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['title'])) {

            $comment = strip_tags($_POST['comment'], '<p><i><b><u>');
            $pseudo = $_SESSION['auth']->getPseudo();
            $this->commentManager-> writeCommentsPost($comment, $pseudo, $postId);
            $_SESSION['flash']['success'] = 'Votre commentaire est envoyé ! Un administarteur va bientôt examiner votre commentaire !';
            header("Location: /OCP5/article-$postId");
        }
        
    }

    public function emailControl()
    {

        if(empty($_POST['name']) && empty($_POST['lastname']) && empty($_POST['contenue'])){
            $_SESSION['flash']['danger'] = 'Vous avez mal remplie les champs !';
        } else {
            $firstname = strip_tags(htmlspecialchars($_POST['name']));
            $email = strip_tags(htmlspecialchars($_POST['email']));
            $message = strip_tags($_POST['message']);
            $pseudo = $firstname;
            $this->loginManager->contactForm($pseudo, $email, $message);
            $_SESSION['flash']['success'] = 'Votre formulaire a bien été envoyer';
            header('Location: /OCP5/');
        }
    }
}

?>