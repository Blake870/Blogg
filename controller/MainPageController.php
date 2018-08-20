<?php
namespace Andrew\Blog\Controllers;

use Andrew\Blog\Models\PostsModel;
use Andrew\Blog\Models\UsersModel;
use Andrew\Blog\Views\MainView;

class MainPageController extends Controller {
    /** @var UsersModel */
    private $usersModel;

    /** @var PostsModel */
    private $postsModel;

    public function __construct() {
        parent::__construct(
            new MainView($this)
        );
        $this->usersModel = new UsersModel();
        $this->postsModel = new PostsModel();
    }

    public function process($data = null) {
        if ($this->session->has("user_id")) {
            $user = $this->usersModel->selectById(intval($this->session->get("user_id")));
            $data["userWriter"] = false;
            if ($user) {
                $data["username"] = $user["username"];
                if ($user["type"] == "WRITER") $data["userWriter"] = true;
            }
        }
        $data["posts"] = $this->postsModel->selectAll();
        $this->view->process($data);
    }

}