<?php
namespace Andrew\Blog\Models;

class PostsModel extends DatabaseModel {
    public function __construct() {
        parent::__construct();
    }

    /**
     * Selects all posts from database
     *
     * @return array all posts
     */
    public function selectAll() {
        $statement = $this->prepare("SELECT 
                        p.id as id,
                        p.date as date,
                        p.image as image,
                        p.text as text,
                        p.title as title,
                        u.username as author
                        FROM posts AS p
                        INNER JOIN users u ON p.author_id = u.id
                        ORDER BY p.date DESC");
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Select post by id from database
     *
     * @return post by id
     */
    public function selectById($id) {
        $statement = $this->prepare("SELECT
                        p.id as id,
                        p.date as date,
                        p.text as text,
                        p.title as title,
                        p.image as image,
                        u.username as author
                         FROM posts p
                         INNER JOIN users u ON p.author_id = u.id
                         WHERE p.id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->fetch();
    }

    /**
     * Create new post
     *
     * @return created post id
     */
    public function create($title, $text, $image, $author_id) {
        $statement = $this->prepare("INSERT INTO posts (title, text, image, date, author_id) 
        VALUES (:title, :text, :image, now(), :author_id)");
        $statement->bindParam(":title", $title);
        $statement->bindParam(":text", $text);
        $statement->bindParam(":image", $image);
        $statement->bindParam(":author_id", $author_id);
        $statement->execute();

        return $this->connection->lastInsertId();
    }

    /**
     * Delete user by id
     */
    public function delete($id) {
        $statement = $this->prepare("DELETE FROM posts WHERE id = :id LIMIT 1");
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    /*
     * Update post by id
     */
    public function update($id, $title, $text, $image, $author_id) {
        $statement = $this->prepare("UPDATE posts    SET 
                                            title = :title,
                                            text = :text,
                                            image = :image,
                                            author_id = :author_id
                                            WHERE id = :id");
        $statement->bindParam(":title", $title);
        $statement->bindParam(":text", $text);
        $statement->bindParam(":image", $image);
        $statement->bindParam(":author_id", $author_id);
        $statement->bindParam(":id", $id);
        $statement->execute();
    }
}