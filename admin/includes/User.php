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
    } // find_this_query

    public static function verify_user($username, $password) {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = $password LIMIT 1";
        // Run the query
        $the_result_array = self::find_this_query($sql);
        // Either return the row or false;
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    } // verify_user

    // Puts result rows into an object
    public static function instantiation($the_record) {
        $the_object = new self;

        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    } // instantiation

    // Checks to see if the property exists in the class
    private function has_the_attribute($the_attribute) {
        $object_properties = get_object_vars($this);

        return array_key_exists($the_attribute, $object_properties);
    } // has_the_attribute

    public function create() {
        global $database;

        $sql = "INSERT INTO users (username, password, first_name, last_name) ";
        $sql .= "VALUES ('";
        $sql .= $database->escape_string($this->username) . "', '";
        $sql .= $database->escape_string($this->password) . "', '";
        $sql .= $database->escape_string($this->first_name) . "', '";
        $sql .= $database->escape_string($this->last_name) . "')";

        if ($database->query($sql)) {
            $this->id = $database->get_insert_id();
            return true;
        } else {
            return false;
        }

    } // create

    public function update() {
        global $database;

        $sql = "UPDATE users SET ";
        $sql .= "username = '" . $database->escape_string($this->username) . "', ";
        $sql .= "password = '" . $database->escape_string($this->password) . "', ";
        $sql .= "first_name = '" . $database->escape_string($this->first_name) . "', ";
        $sql .= "last_name = '" . $database->escape_string($this->last_name) . "' ";
        $sql .= "WHERE id = " . $this->id;

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    } // update

    public function delete() {
        global $database;

        $sql = "DELETE FROM users WHERE id = $this->id LIMIT 1";
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    } // Delete

} // End of Class