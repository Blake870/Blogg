<?php
namespace Andrew\Blog\Controllers;

use Andrew\Blog\Models\UsersModel;
use Andrew\Blog\Views\RegisterView;

class RegisterController extends Controller {
    /** @var UsersModel */
    private $usersModel;

    public function __construct() {
        parent::__construct(
            new RegisterView($this)
        );
        $this->usersModel = new UsersModel();
    }
    
    public function isValid($value, $pattern) {
        return preg_match($pattern, $value);
    }
    
    public function process($data = null) {
        if ($this->session->has("user_id")) {
            $this->redirect();
            return;
        }
        if ($this->request->hasPost("username")
                && $this->request->hasPost("email")
                && $this->request->hasPost("password")) {
            $username = $this->request->post("username");
            $email = $this->request->post("email");
            $password = $this->request->post("password");
            $usernamePattern = "#[a-z][a-z\d]{0,15}#i";
            $emailPattern = "#^[a-z\d]+@[a-z\d]+\.[a-z]{2,}$#i";
            $passwordPattern = "#(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]+)#";
            
            if (!$this->isValid($username, $usernamePattern)) {
                $data["message"] = "Incorrect username!";
                $this->view->process($data);
                return;
            }
            if (!$this->isValid($email, $emailPattern)) {
                $data["message"] = "Incorrect email!";
                $this->view->process($data);
                return;
            }
            if (!$this->isValid($password, $passwordPattern)) {
                $data["message"] = "Incorrect password!";
                $this->view->process($data);
                return;
            }
            try {
                $userId = $this->usersModel->create($username, $email, $password, "USER");
            } catch (\PDOException $exception) {
                $data["message"] = "This email already exists or there an error!";
                $this->view->process($data);
                return;
            }
            
            $this->session->set("user_id", $userId);
            $this->redirect();
            return;
        }

        $this->view->process($data);
    }

}