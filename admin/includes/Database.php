<?php
require_once('new_config.php');

class Database
{
    public $connection;

    public function __construct() {
        $this->open_db_connection();
    }

    // Open the database connection
    public function open_db_connection() {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->connection->connect_error) {
            die('Database Connection Failed!' . $this->connection->connect_error);
        }
    }

    // Query Method
    public function query($sql) {
        $result = $this->connection->query($sql);
        // Confirm the result
        $this->confirm_query($result);

        return $result;
    }

    // Confirm query success
    private function confirm_query($result) {
        if (!$result) {
            die('Query Failed' . $this->connection->error);
        }
    }

    // Escape strings before query
    public function escape_string($string) {
        return $this->connection->real_escape_string($string);
    }

    // Get insert id
    public function get_insert_id() {
        return $this->connection->insert_id;
    }
}

$database = new Database();










