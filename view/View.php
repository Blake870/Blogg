<?php
namespace Andrew\Blog\Views;

use Andrew\Blog\Models\Config;

class View {
    protected $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function process($data = null) {}

    protected function generate($template, $data = null) {
        $config = new Config();
        
        $templateBase = $config->templateBase;
        $resourcesBase = $config->resourcesBase;
        $siteBase = $config->siteBase;
        require_once $templateBase . $template;
    }

}