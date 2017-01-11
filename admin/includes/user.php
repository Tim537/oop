<?php

// User Class

class User
{
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    // Get all the users
    public static function find_all_users(){
        return self::find_this_query("SELECT * FROM users");
    }

    // Get a user with a specified id
    public static function find_user_by_id($id){
        $result = self::find_this_query("SELECT * FROM users WHERE id = $id LIMIT 1");
        $found_user = mysqli_fetch_array($result);
        return $found_user;
    }

    // Run the queries and return the result
    public static function find_this_query($sql){
        global $database;
        $result = $database->query($sql);
        return $result;
    }

    public static function instantiation($user_result){
        $the_object = new self;

        $the_object->id = $user_result['id'];
        $the_object->username = $user_result['username'];
        $the_object->password = $user_result['password'];
        $the_object->first_name = $user_result['first_name'];
        $the_object->last_name = $user_result['last_name'];

        return $the_object;
    }
}