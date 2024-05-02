<?php

class DBConnection
{
    public static function getConnection()
    {
        $path = '../Pokemon.db';
        $db = new SQLite3($path);
        return $db;
    }
}

?>