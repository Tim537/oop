<?php

class Session
{

    private $signed_in = false;
    public $user_id;
    public $message;

    // Start the session
    function __construct() {
        session_start();
        $this->check_the_login();
        $this->check_message();
    }

    // Returns true or false
    public function is_signed_in() {
        return $this->signed_in;
    }

    // Login the user
    public function login($user) {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }

    // Logout the user
    public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in;
    }

    // Set the properties if user is logged in.
    private function check_the_login() {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

    // Display message to user
    public function message($msg = ""){
        if(!empty($msg)){
            $_SESSION['message'] = $msg;
        }else{
            return $this->message;
        }
    }

    public function check_message(){
        if(isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }else{
            $this->message = "";
        }
    }
}

$session = new Session();