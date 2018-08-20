<?php
namespace Andrew\Blog\Models;

class UsersModel extends DatabaseModel {
    private $selectAllStatement;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Selects all users from database
     *
     * @return array all users
     */
    public function selectAll() {
        $statement = $this->prepare("SELECT * FROM users");
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Select user by id from database
     *
     * @return object user
     */
    public function selectById($id) {
        $statement = $this->prepare("SELECT * FROM users WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();

        return $statement->fetch();
    }

    public function selectByEmailAndPassword($email, $password) {
        $statement = $this->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Create new user
     *
     * @return int user id
     */
    public function create($username, $email, $password, $type) {
        $statement = $this->prepare("INSERT INTO users (username, password, email, type) 
    VALUES (:username, :password, :email, :type)");
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':type', $type);
        $statement->execute();

        return $this->connection->lastInsertId();
    }

    /**
     * Delete user by id     *
     */
    public function delete($id) {
        $statement = $this->prepare("DELETE FROM users WHERE id = :id LIMIT 1");
        $statement->bindParam(':id', $id);
        $statement->execute();
    }

    /**
     * Update user by id
     */
    public function update($id, $username, $password, $email, $type) {
        $statement = $this->prepare("UPDATE users SET
                                            username = :username, 
                                            password = :password, 
                                            email = :email, 
                                            type = :type 
                                            WHERE id = :id");
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':type', $type);
        $statement->bindParam(':id', $id);
        $statement->execute();
    }
}