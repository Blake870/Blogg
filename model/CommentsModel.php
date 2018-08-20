<?php
namespace Andrew\Blog\Models;

class CommentsModel extends DatabaseModel {
    public function __construct() {
        parent::__construct();
    }

    /**
     * Selects all comments by post id
     *
     * @return array of comments
     */
    public function selectByPostId($postId) {
        $statement = $this->prepare("SELECT 
                        c.id as id,
                        c.text as text,
                        c.date as date,
                        u.username as username,
                        u.type as usertype
                        FROM comments AS c
                        INNER JOIN users u ON c.user_id = u.id
                        WHERE c.post_id = :post_id
                        ORDER BY c.date DESC");
        $statement->bindParam(":post_id", $postId);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Add new comment
     */
    public function create($postId, $authorId, $text) {
        $statement = $this->prepare("INSERT INTO comments (post_id, user_id, text, date) 
        VALUES (:postId, :authorId, :text, now())");
        $statement->bindParam(":postId", $postId);
        $statement->bindParam(":authorId", $authorId);
        $statement->bindParam(":text", $text);
        $statement->execute();

        return $this->connection->lastInsertId();
    }

    /**
     * Delete comment by id
     */
    public function delete($id) {
        $statement = $this->prepare("DELETE FROM comments WHERE id = :id LIMIT 1");
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    /*
     * Update post by id
     */
    public function update($id, $text) {
        $statement = $this->prepare("UPDATE comments    SET 
                                            text = :text
                                            WHERE id = :id");

        $statement->bindParam(":text", $text);
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

}