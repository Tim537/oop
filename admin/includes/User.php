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
    public static function find_all_users() {
        return self::find_this_query("SELECT * FROM users");
    }

    // Get a user with a specified id
    public static function find_user_by_id($id) {
        $the_result_array = self::find_this_query("SELECT * FROM users WHERE id = $id LIMIT 1");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }

    // Run the queries and return the result
    public static function find_this_query($sql) {
        global $database;
        $result = $database->query($sql);
        $the_object_array = array();

        while ($row = mysqli_fetch_array($result)) {
            $the_object_array[] = self::instantiation($row);
        }

        return $the_object_array;
    }

    public static function verify_user($username, $password) {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = $password LIMIT 1";
        // Run the query
        $the_result_array = self::find_this_query($sql);
        // Either return the row or false;
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    // Puts result rows into an object
    public static function instantiation($the_record) {
        $the_object = new self;

        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }

    // Checks to see if the property exists in the class
    private function has_the_attribute($the_attribute) {
        $object_properties = get_object_vars($this);

        return array_key_exists($the_attribute, $object_properties);
    }
}