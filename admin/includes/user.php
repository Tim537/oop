<?php

// User Class

class User
{

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
}