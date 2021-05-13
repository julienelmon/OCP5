<?php

namespace OCP5\Manager;

use OCP5\Model\Post;
use OCP5\Service\Database;

class PostManager extends Database
{
    public function getPost()
    {
        $sql = "SELECT * FROM post";

        $result = $this->sql($sql);

        $post = [];

        foreach($result as $row)
        {
            $postId = $row['id'];
            $post[$postId] = $this->buildPost($row);
        }

        return $post;
    }

    public function writePost($title, $contenue, $chapo, $pseudo)
    {
        $sql = "INSERT INTO post SET title = '$title', contenue = '$contenue', author = '$pseudo', chapo = '$chapo'"; 

        $this->sql($sql);
    }

    public function getOnePost($postid)
    {
        $sql = "SELECT * FROM post WHERE id = '$postid'";

        $result = $this->sql($sql);

        $row = $result->fetch();

        if($row)
        {
            return $this->buildPost($row);
        }
    }

    public function buildPost($row)
    {
        $post = new Post();
        $post->setId($row['id']);
        $post->setTitle($row['title']);
        $post->setContenue($row['contenue']);
        $post->setAuthor($row['author']);
        $post->setDateCreation($row['date_creation']);
        $post->setDateDerModif($row['date_der_modif']);
        $post->setChapo($row['chapo']);

        return $post;
    }
}

?>