<?php

// Comment Class

class Comment extends Db_object
{
    protected static $db_table = "comments";
    protected static $db_table_fields = array('photo_id', 'author', 'body');
    public $id;
    public $photo_id;
    public $author;
    public $body;




} // End of Class