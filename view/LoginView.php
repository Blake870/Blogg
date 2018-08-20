<?php
namespace Andrew\Blog\Views;

class LoginView extends View {

    public function __construct($controller) {
        parent::__construct($controller);
    }

    public function process($data = null) {
        $this->generate("signin.php", $data);
    }

    protected function generate($template, $data = null) {
        parent::generate($template, $data);
    }

}