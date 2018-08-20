<?php
namespace Andrew\Blog\Controllers;

use Andrew\Blog\Models\UsersModel;
use Andrew\Blog\Views\LoginView;

class LoginController extends Controller {
    /** @var UsersModel */
    private $usersModel;

    public function __construct() {
        parent::__construct(
            new LoginView($this)
        );
        $this->usersModel = new UsersModel();
    }

    public function process($data = null) {
        if ($this->session->has("user_id")) {
            $this->redirect();
            return;
        }
        if ($this->request->hasPost("email") && $this->request->hasPost("password")) {
            $email = $this->request->post("email");
            $password = $this->request->post("password");
            $result = $this->usersModel->selectByEmailAndPassword($email, $password);

            if (count($result) == 1) {
                $id = $result[0]["id"];
                $this->session->set("user_id", $id);
                $this->redirect();
                return;
            } else {
                $data["message"] = "Incorrect email or password!";
            }
        }

        $this->view->process($data);
    }

}