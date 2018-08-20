<?php
namespace Andrew\Blog\Models;

class SessionModel extends Model {
    
    public function __construct() {}
    
    public function has($key) {
        return isset($_SESSION[$key]);
    }
    
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    public function get($key) {
        return $_SESSION[$key];
    }
    
}