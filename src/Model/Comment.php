<?php

namespace OCP5\Model;

class Comment 
{
    private $id;
    private $idPost;
    private $author;
    private $comment;
    private $commentCreate;
    private $valid;

    //SETTER

    public function setId($id)
    {
        $id = (int) $id;
        $this->id = $id;
    }

    public function setIdPost($idPost)
    {
        $idPost = (int) $idPost;
        $this->idpost = $idPost;
    }

    public function setAuthor($author)
    {
        $author = (string) $author;
        $this->author = $author;
    }

    public function setComment($comment)
    {
        $comment = (string) $comment;
        $this->comment = $comment;
    }

    public function setCommentCreate($commentCreate)
    {
        $this->commentCreate = $commentCreate;
    }

    public function setValid($valid)
    {
        $this->valid = $valid;
    }

    //GETTER

    public function getId()
    {
        return $this->id;
    }

    public function getIdPost()
    {
        return $this->idPost;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getCommentCreate()
    {
        return $this->commentCreate;
    }

    public function getValid()
    {
        return $this->valid;
    }
    
}

?>