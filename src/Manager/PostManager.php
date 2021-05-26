<?php

namespace OCP5\Manager;

use OCP5\Model\Post;
use OCP5\Service\Database;

class PostManager extends Database
{
    public function getPost()
    {
        $sql = "SELECT * FROM post ORDER BY id DESC";

        $result = $this->sql($sql);

        $post = [];

        foreach($result as $row) {
            $postId = $row['id'];
            $post[$postId] = $this->buildPost($row);
        }

        return $post;
    }

    public function getPostLimit()
    {
        $sql = "SELECT * FROM post ORDER BY id DESC LIMIT 5";

        $result = $this->sql($sql);

        $post = [];

        foreach($result as $row) {
            $postId = $row['id'];
            $post[$postId] = $this->buildPost($row);
        }

        return $post;
    }

    public function getListPostUser($pseudo)
    {
        $sql = $this->sql(
            "SELECT * FROM post WHERE author = :pseudo",
            [
                'pseudo' => $pseudo,
            ]
        );

        foreach($sql as $row) {
            $postId = $row['id'];
            $post[$postId] = $this->buildPost($row);
        }
        return $post;
    }

    public function writePost($title, $contenue, $chapo, $dateSub, $pseudo)
    {
        $req = $this->sql(
            "INSERT INTO post SET title = :title, contenue = :contenue, author = :author, date_creation = :dateCreation, chapo = :chapo",
            [
                'title' => $title,
                'contenue' => $contenue,
                'author' => $pseudo,
                'dateCreation' => $dateSub,
                'chapo' => $chapo,
            ]
        );
    }

    public function getOnePost($postId)
    {
        $req = $this->sql(
            "SELECT * FROM post WHERE id = :postid",
            [
                'postid' => $postId,
            ]
        );

        $row = $req->fetch();

        if($row)
        {
            return $this->buildPost($row);
        }
    }

    public function updatePost($titleUpdate, $contenueUpdate, $chapoUpdate, $dateUpdate, $postId)
    {
        $req = $this->sql(
            "UPDATE post SET title = :title, contenue = :contenue, date_der_modif = :dateUpdate, chapo = :chapo WHERE id = :postid",
            [
                'title' => $titleUpdate,
                'contenue' => $contenueUpdate,
                'chapo' => $chapoUpdate,
                'dateUpdate' => $dateUpdate,
                'postid' => $postId
            ]
        );
    }

    public function deletePost($postId)
    {
        $req = $this->sql(
            "DELETE FROM post WHERE id = :postid",
            [
                'postid' => $postId,
            ]
        );
    }

    public function buildPost($row)
    {
        $post = new Post();
        $post->setId($row['id']);
        $post->setTitle($row['title']);
        $post->setContenue($row['contenue']);
        $post->setAuthor($row['author']);
        $post->setDateSub($row['date_creation']);
        $post->setDateDerModif($row['date_der_modif']);
        $post->setChapo($row['chapo']);

        return $post;
    }

}

?>