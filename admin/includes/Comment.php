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

    // Returns comment object with the given properties set
    public static function create_comment($photo_id, $author, $body){
        if(!empty($photo_id) && !empty($author) && !empty($body)){
            $comment = new Comment();
            $comment->photo_id = (int)$photo_id;
            $comment->author = $author;
            $comment->body = $body;

            return $comment;
        }else{
            return false;
        }
    } // create_comment()

    // Find comments by photo_id
    public static function find_the_comments($photo_id){
        global $database;
        $photo_id = $database->escape_string($photo_id);
        $sql = "SELECT * FROM ". self::$db_table ." WHERE photo_id = $photo_id ORDER BY id DESC";
        return self::find_by_query($sql);
    }


} // End of Class