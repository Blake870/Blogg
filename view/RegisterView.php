<?php
namespace Andrew\Blog\Views;

class RegisterView extends View {

    public function __construct($controller) {
        parent::__construct($controller);
    }

    public function process($data = null) {
        $this->generate("signup.php", $data);
    }

    protected function generate($template, $data = null) {
        parent::generate($template, $data);
    }

}