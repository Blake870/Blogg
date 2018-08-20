<?php
namespace Andrew\Blog\Controllers;

use Andrew\Blog\Views\PostsView;
use Andrew\Blog\Models\UsersModel;
use Andrew\Blog\Models\PostsModel;
class PostsController extends Controller {
    /** @var UsersModel */
    private $usersModel;
    private $postsModel;

    public function __construct() {
        parent::__construct(
            new PostsView($this)
        );

        $this->usersModel = new UsersModel();
        $this->postsModel = new PostsModel();
    }

    private function checkImage($targetFile, $name) {
        if ($_FILES[$name]["error"] != 0) {
            return false;
        }

        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        //Check if image file is an actual image or fake image
        if ($this->request->hasPost("submit")) {
            $check = getimagesize($_FILES[$name]["tmp_name"]);
            if($check === false) {
                return false;
            }
        }

        //Check file size
        if ($_FILES[$name]["size"] > 2000000) {
            return false;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            return false;
        }

        return true;
    }

    private function updatePostImage($targetFile, $name) {
        // Check if file already exists
        if (file_exists($targetFile)) {
            unlink($targetFile);
        }
        move_uploaded_file($_FILES[$name]["tmp_name"], $targetFile);
    }
    
    private function createPost($title, $text, $image, $authorId) {
        $postId = $this->postsModel->create($title, $text, $image, $authorId);
        return $postId;
    }
    
    private function updatePost($user, $postId) {
        $data = $this->postsModel->selectById($postId);
        if ($this->request->hasPost("update")) {
            $title = $this->request->post("title");
            $text = $this->request->post("text");
            $author_id = $user["id"];
            $fileName = "uploads/post$postId.jpg";
            $targetImageFile = dirname(__FILE__) . "/../" . $fileName;
            $imageInputName = "image";
            if ($this->checkImage($targetImageFile, $imageInputName)) {
                $this->updatePostImage($targetImageFile, $imageInputName);
                $this->postsModel->update($postId, $title, $text, $fileName, $author_id);
                $data["messageSuccess"] = "Post successfully updated!";
            } else {
                $this->postsModel->update($postId, $title, $text, $data["image"], $author_id);
                $data["messageSuccess"] = "Post updated without image!";
            }
        }
        $data["post"] = $this->postsModel->selectById($postId);
        return $data;
    }
    
    public function process($data = null) {
        if ($this->session->has("user_id")) {
            $user = $this->usersModel->selectById(intval($this->session->get("user_id")));
            $data["username"] = $user["username"];
            if ($user["type"] == "WRITER") {
                $data["userWriter"] = true;
                if ($this->request->hasGet("id")) {
                    if ($this->request->get("subAct") == "view") {
                        $postId = $this->request->get("id");
                        $data["post"] = $this->updatePost($user, $postId);
                        $post = $data["post"];
                        $data["author"] = $post["author"];
                        $data["act"] = "edit";
                    }  else if ($this->request->get("subAct") == "delete") {
                        $postId = intval($this->request->get("id"));
                        $this->postsModel->delete($postId);
                        $this->redirect();
                    }
                } else if ($this->request->get("subAct") == "create") {
                    $data["act"] = "create";
                    if ($this->request->hasPost("update")) {
                        $title = $this->request->post("title");
                        $text = $this->request->post("text");
                        $data["username"] = $user["username"];
                        $authorId = $user["id"];
                        $image = "uploads/no-thumbnail.jpg";
                        $postId = $this->createPost($title, $text, $image, $authorId);
                        $this->updatePost($user, $postId);
                        $this->redirect();
                    } else {
                        $data["author"] = $user["username"];
                        $data["post"]["image"] = "uploads/no-thumbnail.jpg";
                    }
                } else {
                    $this->redirect();
                }
            } else {
                $this->redirect();
            }
        }
        else {
            $this->redirect();
        }

        $this->view->process($data);
    }
}