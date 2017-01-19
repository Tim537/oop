<?php

class Session
{

    private $signed_in = false;
    public $user_id;
    public $message;
    public $count;

    // Start the session
    function __construct() {
        session_start();
        $this->visitor_count();
        $this->check_the_login();
        $this->check_message();
    } // __construct()

    // Counts page views in session
    public function visitor_count() {
        if (isset($_SESSION['count'])) {
            return $this->count = $_SESSION['count']++;
        } else {
            return $this->count = $_SESSION['count'] = 1;
        }
    } // visitor_count()

    // Check for Login Returns true or false
    public function is_signed_in() {
        return $this->signed_in;
    } // is_signed_in()

    // Login the user
    public function login($user) {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    } // login()

    // Logout the user
    public function logout() {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in;
    } // logout()

    // Set the properties if user is logged in.
    private function check_the_login() {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    } // check_the_login()

    // Display message to user
    public function message($msg = "") {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    } // message()

    private function check_message() {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    } // check_message()
}

$session = new Session();
// $message = $session->message();