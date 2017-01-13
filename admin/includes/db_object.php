<?php

class Db_object
{
// Get all from table
    public static function find_all() {
        return self::find_this_query("SELECT * FROM " . self::$db_table);
    } // find_all()

    // Get a user with a specified id
    public static function find_by_id($id) {
        $the_result_array = self::find_this_query("SELECT * FROM " . self::$db_table . " WHERE id = $id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    } // find_by_id()

    // Run the queries and return the result as array of objects
    public static function find_this_query($sql) {
        global $database;
        $result = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result)) {
            $the_object_array[] = self::instantiation($row);
        }
        return $the_object_array;
    } // find_this_query()

    // Puts result rows into an object
    public static function instantiation($the_record) {
        $the_object = new self;

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

} // End Class