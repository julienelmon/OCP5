<?php

namespace OCP5\Controller;

use OCP5\Service\TwigRenderer;
use OCP5\Manager\UserManager;
use OCP5\Manager\PostManager;
use OCP5\Manager\CommentManager;
use OCP5\Model\Comment;

class AdminController
{
    private $renderer;
    private $loginManager;
    private $postManager;
    private $commentManager;
    private $comment;

    public function __construct()
    {
        $this->renderer = new TwigRenderer();
        $this->loginManager = new UserManager();
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->comment = new Comment();

        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
    }

    public function editPost()
    {
        $dataUser = $_SESSION['auth'];
        $listPost = $this->postManager->getPost();
        $this->renderer->render('admin/editPostView', ['data_user' => $dataUser, 'listposts' => $listPost]);
        $_SESSION['flash'] = array();
    }

    public function editComment()
    {
        $dataUser = $_SESSION['auth'];
        $listComment = $this->commentManager->getAllComment();
        $this->renderer->render('admin/editCommentView', ['data_user' => $dataUser, 'listcomments' => $listComment]);
        $_SESSION['flash'] = array();
    }

    public function deletePost()
    {
        $idpostdelete = $_POST['postid'];
        $this->postManager->deletePost($idpostdelete);
        $_SESSION['flash']['success'] = 'Post supprimer avec succès';
        header('Location: /OCP5/admin/editpost');
    }

    public function setValidComment()
    {
        $commentid = $_POST['commentid'];
        $validCommentResult = $_POST['validcomment'];

        if($validCommentResult === 'valid')
        {
            $this->commentManager->updateComment($commentid);
            $_SESSION['flash']['success'] = 'Commentaire validez !';
            header('Location: /OCP5/admin/editcomment');
        }
        else
        {
            $this->commentManager->deleteComment($commentid);
            $_SESSION['flash']['success'] = 'Commentaire supprimer avec succès !';
            header('Location: /OCP5/admin/editcomment');
        }
    }

    public function editAccount()
    {
        $users = $this->loginManager->getAllAccount();
        $this->renderer->render('admin/editaccountView', ['users' => $users]);
        $_SESSION['flash'] = array();
    }

    public function deleteAccount()
    {
        $idaccount = $_POST['idaccount'];
        $this->loginManager->deleteAccount($idaccount);
        $_SESSION['flash']['success'] = 'Compte supprimer avec succès';
        header('Location: /OCP5/admin/editaccount/');
    }
}

?>