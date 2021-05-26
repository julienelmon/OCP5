<?php

namespace OCP5\Controller;

use OCP5\Service\TwigRenderer;
use OCP5\Manager\UserManager;
use OCP5\Manager\PostManager;
use OCP5\Manager\CommentManager;

class AdminController
{
    private $renderer;
    private $loginManager;
    private $postManager;
    private $commentManager;

    public function __construct()
    {
        $this->renderer = new TwigRenderer();
        $this->loginManager = new UserManager();
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();

        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
    }

    public function editPost()
    {
        $dataUser = $_SESSION['auth'];
        if($dataUser->isAdmin()){
            $listPost = $this->postManager->getPost();
            $_SESSION['flash'] = array();
            return $this->renderer->render('admin/editPostView', ['data_user' => $dataUser, 'listposts' => $listPost]);
        }

        return $this->renderer->render('admin/errorView', ['data_user' => $dataUser]);
    }

    public function editComment()
    {   
        $dataUser = $_SESSION['auth'];
        if($dataUser->isAdmin()){
            $listComment = $this->commentManager->getAllComment();
            $_SESSION['flash'] = array();
            return $this->renderer->render('admin/editCommentView', ['data_user' => $dataUser, 'listcomments' => $listComment]);
        }

        return $this->renderer->render('admin/errorView', ['data_user' => $dataUser]);
    }

    public function deletePost()
    {
        if(isset($_POST['postid'])){
            $idPostDelete = $_POST['postid'];
            $this->postManager->deletePost($idPostDelete);
            $_SESSION['flash']['success'] = 'Post supprimer avec succès';
            header('Location: /OCP5/admin/editpost');
        } else {
            $_SESSION['flash']['success'] = 'Id introuvable';
            header('Location: /OCP5/admin/editpost');
        }
    }
    
    public function viewAdminPost($id)
    {
        if(isset($id)){
            $post = $this->postManager->getOnePost($id);
            $dataUser = $_SESSION['auth'];
            $this->renderer->render('admin/viewpostadminView', ['data_user' => $dataUser, 'post' => $post]);
        } else {
            $_SESSION['flash']['success'] = 'Post introuvable !';
            header('Location: /OCP5/admin/editpost');
        }
    }

    public function setValidComment()
    {
        if(isset($_POST['commentid']) || isset($_POST['validcomment'])){
            $commentId = $_POST['commentid'];
            $validCommentResult = $_POST['validcomment'];

            if($validCommentResult === 'valid'){
                $this->commentManager->updateComment($commentId);
                $_SESSION['flash']['success'] = 'Commentaire validez !';
                header('Location: /OCP5/admin/editcomment');
            } else {
                $this->commentManager->deleteComment($commentId);
                $_SESSION['flash']['success'] = 'Commentaire supprimer avec succès !';
                header('Location: /OCP5/admin/editcomment');
            }
        } else {
            $_SESSION['flash']['success'] = 'Erreur !';
            header('Location: /OCP5/admin/editcomment');
        }
    }

    public function editAccount()
    {
        $dataUser = $_SESSION['auth'];
        if($dataUser->isAdmin()){
            $user = $this->loginManager->getAllAccount();
            $_SESSION['flash'] = array();
            return $this->renderer->render('admin/editaccountView', ['data_user' => $dataUser,'users' => $user]);
        }

        return $this->renderer->render('admin/errorView', ['data_user' => $dataUser]);
    }

    public function deleteAccount()
    {   
        if(isset($_POST['idaccount'])){
            $idAccount = $_POST['idaccount'];
            $this->loginManager->deleteAccount($idAccount);
            $_SESSION['flash']['success'] = 'Compte supprimer avec succès';
            header('Location: /OCP5/admin/editaccount/');
        } else {
            $_SESSION['flash']['success'] = 'Id compte introuvable';
            header('Location: /OCP5/admin/editaccount/');
        }

    }
}

?>