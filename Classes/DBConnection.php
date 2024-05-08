<?php

class DBConnection
{
    public static function getConnection()
    {
        $path = 'C:\xampp\htdocs\PokemonGracidea\Pokemon.db';
        $db = new SQLite3($path);
        return $db;
    }
}

?>