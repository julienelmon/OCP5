<?php

namespace OCP5\Manager;

use OCP5\Model\Comment;
use OCP5\Service\Database;

class CommentManager extends Database 
{
    public function getCommentsPost($id)
    {
        $sql = "SELECT * FROM comment WHERE postid = '$id'";

        $result = $this->sql($sql);

        $comment = [];

        foreach($result as $row)
        {
            $commentId = $row['id'];
            $comment[$commentId] = $this->buildComment($row);
        }

        return $comment;
    }

    public function writeCommentsPost($comment, $pseudo, $postId)
    {
        $sql = "INSERT INTO comment SET postid = '$postId',author = '$pseudo', comment = '$comment', valid = '0'";

        $this->sql($sql);
    }

    public function buildComment($row)
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setIdPost($row['postid']);
        $comment->setAuthor($row['author']);
        $comment->setComment($row['comment']);
        $comment->setCommentCreate($row['comment_create']);
        $comment->setValid($row['valid']);

        return $comment;
    }
}

?>