<?php
namespace Andrew\Blog\Views;

class View {
    protected $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function process($data = null) {}

    protected function generate($template, $data = null) {
        $templateBase = 'view/';
        $resourcesBase = "/";
        $siteBase = "/";
        require_once $templateBase . $template;
    }

}