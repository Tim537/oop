<?php

// User Class

class User extends Db_object
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    // Verify username and password
    public static function verify_user($username, $password) {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '$username' AND password = $password LIMIT 1";
        // Run the query
        $the_result_array = self::find_this_query($sql);
        // Either return the row or false;
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    } // verify_user()

    // Returns all object properties
    protected function properties() {
        $properties = array();
        foreach (self::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    } // properties()

    // Returns the properties escaped for sql
    protected function clean_properties() {
        global $database;
        $clean_properties = array();
        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    } // clean_properties()

    // Calls create if it doesn't exist and update if it does exist
    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    } // save()

    // Creates a new user
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
    } // create()

    // Updates an existing user
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
    } // update()

    // Deletes a user
    public function delete() {
        global $database;

        $sql = "DELETE FROM " . self::$db_table . " WHERE id = $this->id LIMIT 1";
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    } // delete()

} // End of Class