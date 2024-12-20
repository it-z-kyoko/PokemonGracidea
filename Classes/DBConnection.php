<?php

class DBConnection
{
    public static function getConnection()
    {
        $path = 'C:\xampp\htdocs\PokemonGracidea\Pokemon.db';
        //ToDo: dynamic path @it-z-kyoko https://github.com/it-z-kyoko/PokemonGracidea/blob/main/Classes/DBConnection.php#L8
        $db = new SQLite3($path);
        return $db;
    }
}

?>