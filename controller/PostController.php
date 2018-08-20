<?php
namespace Andrew\Blog\Controllers;

use Andrew\Blog\Models\CommentsModel;
use Andrew\Blog\Models\PostsModel;
use Andrew\Blog\Models\UsersModel;
use Andrew\Blog\Views\PostView;

class PostController extends Controller {
    /** @var UsersModel */
    private $usersModel;

    /** @var PostsModel */
    private $postsModel;

    /** @var CommentsModel */
    private $commentsModel;

    public function __construct() {
        parent::__construct(
            new PostView($this)
        );
        $this->usersModel = new UsersModel();
        $this->postsModel = new PostsModel();
        $this->commentsModel = new CommentsModel();
    }

    /**
     * @param null $data
     */
    public function process($data = null) {
        $data["userWriter"] = false;
        if ($this->session->has("user_id")) {
            $user = $this->usersModel->selectById(intval($this->session->get("user_id")));
            if ($user) {
                $data["username"] = $user["username"];
                if ($user["type"] == "WRITER") $data["userWriter"] = true;
            }
        } else {
            $user = false;
        }

        if (isset($_POST["commentDelete"])) {
            $commentId = intval($this->request->post("commentId"));
            if ($user) {
                if ($user["type"] == "WRITER") {
                    $this->commentsModel->delete($commentId);
                    $data["messageSuccess"] = "Comment was successfully deleted!";
                } else {
                    $data["messageBad"] = "You have no permission to delete a comment";
                }
            } else {
                $data["messageBad"] = "You have no permission to delete a comment";
            }
        } else if ($this->request->hasPost("commentAdd")) {
            if ($user && $user["type"] != "GUEST") {
                $commentId = intval($this->request->post("commentId"));
                $postId = intval($this->request->post("postId"));
                $authorId = $user["id"];
                $text = $this->request->post("text");
                $this->commentsModel->create($postId, $authorId, $text);
                $data["scrollToCommentId"] = $commentId;
                $data["messageSuccess"] = "Comment was successfully added!";
            } else {
                $data["messageBad"] = "You have no permission to add a comment";
            }
        }
        else if (isset($_POST["commentUpdate"])) {
            if ($user && $user["type"] == "WRITER") {
                $commentId = intval($this->request->post("commentId"));
                $text = $this->request->post("text");
                $this->commentsModel->update($commentId, $text);
                $data["messageSuccess"] = "Comment was successfully updated!";
                $data["scrollToCommentId"] = $commentId;
            } else {
                $data["messageBad"] = "You have no permission to update a comment";
            }
        }
        $postId = intval($this->request->get("id"));
        $data["post"] = $this->postsModel->selectById($postId);
        $post = $data["post"];
        $authorId = $post["author_id"];
        //$data["postAuthor"] = $this->usersModel->selectById($authorId);
        $data["comments"] = $this->commentsModel->selectByPostId($postId);
        $data["countComments"] = count($data["comments"]);
        $this->view->process($data);
    }

}