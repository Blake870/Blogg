<?php

namespace Andrew\Blog\Models;

/**
 * Main config
 * @package Andrew\Blog\Models
 */
class Config extends Model {
    private $props = array(
        // Database host
        "dbHost" => "localhost",
        
        // Database login
        "dbUser" => "root",
        
        // Database password
        "dbPassword" => "",
        
        // Database name
        "dbName" => "blog",
        
        // Site base path
        "siteBase" => "/",
        
        // Path for resources (js/, css/, ...)
        "resourcesBase" => "/",
        
        // Path for templates (php pages)
        "templateBase" => "view/"
    );
    
    public function __get($name) {
        if (isset($this->props[$name])) {
            return $this->props[$name];
        } else {
            return null;
        }
    }
}