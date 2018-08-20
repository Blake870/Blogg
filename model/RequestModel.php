<?php
namespace Andrew\Blog\Models;

class RequestModel extends Model {
    
    public function __construct() {}
    
    public function hasGet($key) {
        return isset($_GET[$key]);
    }
    
    public function hasPost($key) {
        return isset($_POST[$key]);
    }
    
    public function get($key) {
        return $_GET[$key];
    }
    
    public function post($key) {
        return $_POST[$key];
    }
    
}