<?php

namespace OCP5\Manager;

use OCP5\Model\Comment;
use OCP5\Service\Database;

class CommentManager extends Database 
{
    public function getCommentsPost($id)
    {
        $req = $this->sql(
            "SELECT * FROM comment WHERE postid = :id",
            [
                'id' => $id,
            ]
        );

        $comment = [];

        foreach($req as $row)
        {
            $commentId = $row['id'];
            $comment[$commentId] = $this->buildComment($row);
        }

        return $comment;
    }

    public function getAllComment()
    {   

        $sql = "SELECT * FROM comment WHERE valid = '0'";
    
        $result = $this->sql($sql);
    
        $comment = [];
    
        foreach($result as $row)
        {
            $commentId = $row['id'];
            $comment[$commentId]['array'] = $this->buildComment($row);
    
            $myIdPost = $comment[$commentId]['array']->getIdPost();
    
            $sql2 = $this->sql(
                "SELECT title FROM post WHERE id = :idpost",
                [
                    'idpost' => $myIdPost,
                ]
            );
    
            $result = $sql2->fetch();
            $comment[$commentId]['title'] = $result['title'];
    
        }
    
            return $comment;
    }

    public function writeCommentsPost($comment, $pseudo, $postId)
    {
        $req = $this->sql(
            "INSERT INTO comment SET postid = :postid, author = :pseudo, comment = :comment, valid = '0'",
        [
            'postid' => $postId,
            'pseudo' => $pseudo,
            'comment' => $comment,
        ]
    );
    }

    public function updateComment($commentid)
    {
        $req = $this->sql(
            "UPDATE comment SET valid = '1' WHERE id = :commentid",
            [
                'commentid' => $commentid,
            ]
        );
    }

    public function deleteComment($commentid)
    {
        $req = $this->sql(
            "DELETE FROM comment WHERE id = :commentid",
            [
                'commentid' => $commentid,
            ]
        );
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