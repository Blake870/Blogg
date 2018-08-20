<?php

class NamespaceAutoloader {
    protected $namespacesMap = array();
    
    public function addNamespace($namespace, $rootDir) {
        if (is_dir($rootDir)) {
            $this->namespacesMap[$namespace] = $rootDir;
            return true;
        }
        return false;
    }
    
    public function register() {
        spl_autoload_register(array($this, 'autoload'));
    }
    
    protected function autoload($class) {
        $pathParts = explode('\\', $class);
        
        if (is_array($pathParts)) {
            $className = $pathParts[count($pathParts) - 1];
            $namespace = implode('\\', array_slice($pathParts, 0, count($pathParts) - 1));
            
            if (!empty($this->namespacesMap[$namespace])) {
                $filePath = $this->namespacesMap[$namespace] . '/' . $className. '.php';
                require_once $filePath;
                return true;
            }
        }
        
        return false;
    }
    
}