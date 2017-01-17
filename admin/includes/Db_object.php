<?php

// Parent class with abstracted methods

class Db_object
{
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified for the form",
        UPLOAD_ERR_PARTIAL => "The file was only partially uploaded",
        UPLOAD_ERR_NO_FILE => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write to disk",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload"
    );

    // protected static $db_table = "";
// Get all from table
    public static function find_all() {
        return static::find_by_query("SELECT * FROM " . static::$db_table);
    } // find_all()

    // Get a user with a specified id
    public static function find_by_id($id) {
        $the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    } // find_by_id()

    // Run the queries and return the result as array of objects
    public static function find_by_query($sql) {
        global $database;
        $result = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result)) {
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
    } // find_by_query()

    // Puts result rows into an object
    public static function instantiation($the_record) {
        // Gets the current sub class and instantiates it
        $calling_class = get_called_class();
        $the_object = new $calling_class;

        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    } // instantiation()

    // Checks to see if the property exists in the class
    private function has_the_attribute($the_attribute) {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    } // has_the_attribute()

    // Returns all object properties
    protected function properties() {
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
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
        $sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ") ";
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

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id = " . $this->id;

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    } // update()

    // Deletes a user
    public function delete() {
        global $database;

        $sql = "DELETE FROM " . static::$db_table . " WHERE id = $this->id LIMIT 1";
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    } // delete()

    public static function count_all(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table;
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);
        return array_shift($row);
    }

} // End Class