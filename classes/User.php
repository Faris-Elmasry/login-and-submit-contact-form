<?php

class User {
    protected $valid_username = "user123";
    protected $valid_password = "pass123";
 
    public function __construct($valid_username, $valid_password) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!empty($valid_username)) {
            $this->valid_username = $valid_username;
        }
        if (!empty($valid_password)) {
            $this->valid_password = $valid_password;
        }
    }

 

    public function authenticate($username, $password) {
        if ($username === $this->valid_username && $password === $this->valid_password) {
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;
            setcookie("username", $username,  time() + (86400 * 30), "/"); 
            setcookie("password", $password,  time() + (86400 * 30), "/"); 
            return true;
        }
        return false;
    }

    public function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public function logout() {
        session_unset();
        session_destroy();
        setcookie("username", "", time() - 3600, "/");
        setcookie("password", "", time() - 3600, "/");
    }

    public function getuser(){
        return [
            'session' => $_SESSION['username'] ?? 'Not set',
            'logged_in' => isset($_SESSION['logged_in']) ? 'Yes' : 'No',
          
            'cookie_username' => $_COOKIE['username'] ?? 'Not set',
            'cookie_password' => $_COOKIE['password'] ?? 'Not set'
        ];
    }
}