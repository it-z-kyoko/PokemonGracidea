<?php
include('DBConnection.php');
function ReadShowdownInput($string)
{
    try {
        // Verbindung zur SQLite-Datenbank herstellen
        $db = DBConnection::getConnection();

               // Vorbereitung des INSERT-Statements
               $stmt = $db->prepare('INSERT INTO pokemon_data (Name, Item, Level, Nature, TeraType, Ability, HPEV, ATKEV, DEFEV, SPATKEV, SPDEFEV, SPEEDEV, HPIV, ATKIV, DEFIV, SPATKIV, SPDEFIV, SPEEDIV, Move1, Move2, Move3, Move4) VALUES (:name, :item, :level, :nature, :teratype, :ability, :hpev, :atkev, :defev, :spatkev, :spdefev, :speedev, :hpiv, :atkiv, :defiv, :spatkiv, :spdefiv, :speediv, :move1, :move2, :move3, :move4)');

               // Definiere Muster für die Extraktion der Daten
               $namepattern = '/([^\n]+)@/i';
               $itempattern = '/@([^\n]+)/i';
               $pattern_level = '/Level:\s*(\d+)/i';
               $pattern_nature = '/(\w+) Nature/';
               $pattern_ability = '/Ability: ([^\n]+)/';
               $pattern_teratype = '/Tera Type: (\w+)/';
               $pattern_evs = '/EVs:\s*((?:\d+\s*\w+\s*\/\s*)*(?:\d+\s*\w+))/';
               $pattern_ivs = '/IVs:\s*((?:\d+\s*\w+\s*\/\s*)*(?:\d+\s*\w+))/';
       
               // Suche nach dem Muster und Extraktion der Daten
               preg_match($namepattern, $string, $matches);
               $text_after_at = trim($matches[1]);
               preg_match($itempattern, $string, $matches);
               $item = trim($matches[1]);
               preg_match($pattern_level, $string, $matches);
               $level = (int)$matches[1];
               preg_match($pattern_nature, $string, $matches);
               $nature = trim($matches[1]);
               preg_match($pattern_ability, $string, $matches);
               $ability = trim($matches[1]);
               preg_match($pattern_teratype, $string, $matches);
               $teratype = trim($matches[1]);
               preg_match($pattern_evs, $string, $matches);
               $ev_values_string = trim($matches[1]);
               $evs = preg_split('/\s*\/\s*/', $ev_values_string);
               preg_match($pattern_ivs, $string, $matches);
               $iv_values_string = trim($matches[1]);
               $ivs = preg_split('/\s*\/\s*/', $iv_values_string);
               $moves_text = trim(substr($string, strpos($string, "IVs:") + 4));
               $moves = preg_split('/\r?\n/', $moves_text, -1, PREG_SPLIT_NO_EMPTY);
       
               // Binden der Parameter und Ausführen des Statements
               $stmt->bindValue(':name', $text_after_at);
               $stmt->bindValue(':item', $item);
               $stmt->bindValue(':level', $level);
               $stmt->bindValue(':nature', $nature);
               $stmt->bindValue(':teratype', $teratype);
               $stmt->bindValue(':ability', $ability);
               $stmt->bindValue(':hpev', GetStatValue($evs, 'HP'));
               $stmt->bindValue(':atkev', GetStatValue($evs, 'Atk'));
               $stmt->bindValue(':defev', GetStatValue($evs, 'Def'));
               $stmt->bindValue(':spatkev', GetStatValue($evs, 'SpA'));
               $stmt->bindValue(':spdefev', GetStatValue($evs, 'SpD'));
               $stmt->bindValue(':speedev', GetStatValue($evs, 'Spe'));
               $stmt->bindValue(':hpiv', GetStatValue($ivs, 'HP'));
               $stmt->bindValue(':atkiv', GetStatValue($ivs, 'Atk'));
               $stmt->bindValue(':defiv', GetStatValue($ivs, 'Def'));
               $stmt->bindValue(':spatkiv', GetStatValue($ivs, 'SpA'));
               $stmt->bindValue(':spdefiv', GetStatValue($ivs, 'SpD'));
               $stmt->bindValue(':speediv', GetStatValue($ivs, 'Spe'));
               $stmt->bindValue(':move1', isset($moves[1]) ? $moves[1] : null);
               $stmt->bindValue(':move2', isset($moves[2]) ? $moves[2] : null);
               $stmt->bindValue(':move3', isset($moves[3]) ? $moves[3] : null);
               $stmt->bindValue(':move4', isset($moves[4]) ? $moves[4] : null);
               $stmt->execute();
       
               echo "Datensatz erfolgreich eingefügt.";
           } catch (Exception $e) {
               echo "Fehler: " . $e->getMessage();
           }
       }
       
       // Hilfsfunktion zur Extraktion des EV/IV-Wertes für eine bestimmte Statistik
       function GetStatValue($stats, $statName)
       {
           foreach ($stats as $stat) {
               list($value, $statType) = preg_split('/\s+/', trim($stat), 2);
               if (strtolower($statType) === strtolower($statName)) {
                   return (int)$value;
               }
           }
           return 0; // Return 0 if the stat is not found
       }