<?php

// User Class

class User
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
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

    // Returns all object properties
    protected function properties() {
        $properties = array();
        foreach (self::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    } // properties

    protected function clean_properties(){
        global $database;

        $clean_properties = array();
        foreach($this->properties() as $key => $value){
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    } // clean_properties

    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    } // save

    public function create() {
        global $database;

        $properties = $this->clean_properties();
        $sql = "INSERT INTO " . self::$db_table . "(" . implode(",", array_keys($properties)) . ") ";
        $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";
        if ($database->query($sql)) {
            $this->id = $database->get_insert_id();
            return true;
        } else {
            return false;
        }
    } // create


    public function update() {
        global $database;

        $properties = $this->clean_properties();
        $properties_pairs = array();
        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . self::$db_table . " SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id = " . $this->id;

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    } // update

    public function delete() {
        global $database;

        $sql = "DELETE FROM " . self::$db_table . " WHERE id = $this->id LIMIT 1";
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    } // Delete

} // End of Class