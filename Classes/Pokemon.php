<?php

include_once("DBConnection.php");

class Pokemon
{
    // Attribute
    public $nr;
    public $name;
    public $typ1;
    public $typ2;
    public $ability;
    public $level = 1;
    public $nature;
    public $teraType;
    public $move1;
    public $move2;
    public $move3;
    public $move4;
    private $hpEV = 0;
    private $atkEV = 0;
    private $defEV = 0;
    private $spAtkEV = 0;
    private $spDefEV = 0;
    private $speedEV = 0;
    public $hpIV = 0;
    public $atkIV = 0;
    public $defIV = 0;
    public $spAtkIV = 0;
    public $spDefIV = 0;
    public $speedIV = 0;
    public $hp = 0;
    public $atk = 0;
    public $def = 0;
    public $spAtk = 0;
    public $spDef = 0;
    public $speed = 0;
    public $HPBase;
    public $AtkBase;
    public $DefBase;
    public $SpABase;
    public $SpDBase;
    public $SpeBase;


    // Konstruktor
    public function __construct($nr, $name)
    {
        $this->nr = $nr;
        $this->name = $name;
        $this->getTypes();
        $this->setBaseStats();
        $this->CalcAllStats();
    }
    public function getHPBase()
    {
        return $this->HPBase;
    }

    public function getAtkBase()
    {
        return $this->AtkBase;
    }

    public function getDefBase()
    {
        return $this->DefBase;
    }

    public function getSpABase()
    {
        return $this->SpABase;
    }

    public function getSpDBase()
    {
        return $this->SpDBase;
    }

    public function getSpeBase()
    {
        return $this->SpeBase;
    }
    public function getHPEV()
    {
        return $this->hpEV;
    }

    public function getAtkEV()
    {
        return $this->atkEV;
    }

    public function getDefEV()
    {
        return $this->defEV;
    }

    public function getSpAtkEV()
    {
        return $this->spAtkEV;
    }

    public function getSpDefEV()
    {
        return $this->spDefEV;
    }

    public function getSpeedEV()
    {
        return $this->speedEV;
    }

    // Getter für IVs
    public function getHPIV()
    {
        return $this->hpIV;
    }

    public function getAtkIV()
    {
        return $this->atkIV;
    }

    public function getDefIV()
    {
        return $this->defIV;
    }

    public function getSpAtkIV()
    {
        return $this->spAtkIV;
    }

    public function getSpDefIV()
    {
        return $this->spDefIV;
    }

    public function getSpeedIV()
    {
        return $this->speedIV;
    }

    public function getNr()
    {
        return $this->nr;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTyp1()
    {
        return $this->typ1;
    }

    public function getTyp2()
    {
        return $this->typ2;
    }

    public function getAbility()
    {
        return $this->ability;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getNature()
    {
        return $this->nature;
    }

    public function getTeraType()
    {
        return $this->teraType;
    }

    public function getMove1()
    {
        return $this->move1;
    }

    public function getMove2()
    {
        return $this->move2;
    }

    public function getMove3()
    {
        return $this->move3;
    }

    public function getMove4()
    {
        return $this->move4;
    }

    public function getHP()
    {
        return $this->hp;
    }

    public function getATK()
    {
        return $this->atk;
    }

    public function getDEF()
    {
        return $this->def;
    }

    public function getSPATK()
    {
        return $this->spAtk;
    }

    public function getSPDEF()
    {
        return $this->spDef;
    }

    public function getSPEED()
    {
        return $this->speed;
    }

    public function setNature($value)
    {
        $this->nature = $value;
    }

    public function setAbility($value)
    {
        $this->ability = $value;
    }

    public function setLevel($value)
    {
        $this->level = $value;
    }
    public function setHPBase($value)
    {
        $this->HPBase = $value;
    }

    public function setAtkBase($value)
    {
        $this->AtkBase = $value;
    }

    public function setDefBase($value)
    {
        $this->DefBase = $value;
    }

    public function setSpABase($value)
    {
        $this->SpABase = $value;
    }

    public function setSpDBase($value)
    {
        $this->SpDBase = $value;
    }

    public function setSpeBase($value)
    {
        $this->SpeBase = $value;
    }

    public function setHPEV($value)
    {
        $this->hpEV = $value;
    }

    public function setAtkEV($value)
    {
        $this->atkEV = $value;
    }

    public function setDefEV($value)
    {
        $this->defEV = $value;
    }

    public function setSpAtkEV($value)
    {
        $this->spAtkEV = $value;
    }

    public function setSpDefEV($value)
    {
        $this->spDefEV = $value;
    }

    public function setSpeedEV($value)
    {
        $this->speedEV = $value;
    }

    // Setter-Methoden für IVs
    public function setHPIV($value)
    {
        $this->hpIV = $value;
    }

    public function setAtkIV($value)
    {
        $this->atkIV = $value;
    }

    public function setDefIV($value)
    {
        $this->defIV = $value;
    }

    public function setSpAtkIV($value)
    {
        $this->spAtkIV = $value;
    }

    public function setSpDefIV($value)
    {
        $this->spDefIV = $value;
    }

    public function setSpeedIV($value)
    {
        $this->speedIV = $value;
    }

    // Setter-Methoden für Statuswerte
    public function setHP($value)
    {
        $this->hp = $value;
    }

    public function setATK($value)
    {
        $this->atk = $value;
    }

    public function setDEF($value)
    {
        $this->def = $value;
    }

    public function setSPATK($value)
    {
        $this->spAtk = $value;
    }

    public function setSPDEF($value)
    {
        $this->spDef = $value;
    }

    public function setSPEED($value)
    {
        $this->speed = $value;
    }

    public function setType1($value)
    {
        $this->typ1 = $value;
    }

    public function setType2($value)
    {
        $this->typ2 = $value;
    }


    public function setBaseStats()
    {
        $conn = DBConnection::getConnection();

        $sql = "SELECT * FROM PokedexBaseStats WHERE Nr = :Nr AND Name = :Name";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':Nr', $this->getNr());
        $stmt->bindValue(':Name', $this->getName());

        $result = $stmt->execute();

        $row = $result->fetchArray(SQLITE3_ASSOC);

        $this->setAtkBase($row["ATK"]);
        $this->setHPBase($row["HP"]);
        $this->setDEFBase($row["DEF"]);
        $this->setSPABase($row["SpA"]);
        $this->setSPDBase($row["SpD"]);
        $this->setSPEBase($row["Spe"]);
    }

    public function CalcStat($BaseStat, $IV, $EV)
    {
        $Stat = round((((2 * $BaseStat + $IV + round($EV / 4)) * $this->getLevel()) / 100) + 5);
        return $Stat;
    }

    public function CalcHP()
    {
        $HP = floor((((2 * $this->getHPBase() + $this->getHPIV() + floor($this->getHPEV() / 4)) * $this->getLevel()) / 100) + $this->getLevel() + 10);
        $this->setHP($HP);
    }

    public function NatureAffect()
    {
        switch ($this->getNature()) {
            case 'Hardy':
                // Keine Änderungen, da neutral
                break;
            case 'Lonely':
                // ATK erhöht, DEF verringert
                $this->setATK(floor($this->getATK() * 1.1));
                $this->setDEF(floor($this->getDEF() * 0.9));
                break;
            case 'Brave':
                // ATK erhöht, SPEED verringert
                $this->setATK(floor($this->getATK() * 1.1));
                $this->setSPEED(floor($this->getSPEED() * 0.9));
                break;
            case 'Adamant':
                // ATK erhöht, SPATK verringert
                $this->setATK(floor($this->getATK() * 1.1));
                $this->setSPATK(floor($this->getSPATK() * 0.9));
                break;
            case 'Naughty':
                // ATK erhöht, SPDEF verringert
                $this->setATK(floor($this->getATK() * 1.1));
                $this->setSPDEF(floor($this->getSPDEF() * 0.9));
                break;
            case 'Bold':
                // DEF erhöht, ATK verringert
                $this->setDEF(floor($this->getDEF() * 1.1));
                $this->setATK(floor($this->getATK() * 0.9));
                break;
            case 'Docile':
                // Keine Änderungen, da neutral
                break;
            case 'Relaxed':
                // DEF erhöht, SPEED verringert
                $this->setDEF(floor($this->getDEF() * 1.1));
                $this->setSPEED(floor($this->getSPEED() * 0.9));
                break;
            case 'Impish':
                // DEF erhöht, SPATK verringert
                $this->setDEF(floor($this->getDEF() * 1.1));
                $this->setSPATK(floor($this->getSPATK() * 0.9));
                break;
            case 'Lax':
                // DEF erhöht, SPDEF verringert
                $this->setDEF(floor($this->getDEF() * 1.1));
                $this->setSPDEF(floor($this->getSPDEF() * 0.9));
                break;
            case 'Timid':
                // SPEED erhöht, ATK verringert
                $this->setSPEED(floor($this->getSPEED() * 1.1));
                $this->setATK(floor($this->getATK() * 0.9));
                break;
            case 'Hasty':
                // SPEED erhöht, DEF verringert
                $this->setSPEED(floor($this->getSPEED() * 1.1));
                $this->setDEF(floor($this->getDEF() * 0.9));
                break;
            case 'Serious':
                // Keine Änderungen, da neutral
                break;
            case 'Jolly':
                // SPEED erhöht, SPATK verringert
                $this->setSPEED(floor($this->getSPEED() * 1.1));
                $this->setSPATK(floor($this->getSPATK() * 0.9));
                break;
            case 'Naive':
                // SPEED erhöht, SPDEF verringert
                $this->setSPEED(floor($this->getSPEED() * 1.1));
                $this->setSPDEF(floor($this->getSPDEF() * 0.9));
                break;
            case 'Modest':
                // SPATK erhöht, ATK verringert
                $this->setSPATK(floor($this->getSPATK() * 1.1));
                $this->setATK(floor($this->getATK() * 0.9));
                break;
            case 'Mild':
                // SPATK erhöht, DEF verringert
                $this->setSPATK(floor($this->getSPATK() * 1.1));
                $this->setDEF(floor($this->getDEF() * 0.9));
                break;
            case 'Quiet':
                // SPATK erhöht, SPEED verringert
                $this->setSPATK(floor($this->getSPATK() * 1.1));
                $this->setSPEED(floor($this->getSPEED() * 0.9));
                break;
            case 'Bashful':
                // Keine Änderungen, da neutral
                break;
            case 'Rash':
                // SPATK erhöht, SPDEF verringert
                $this->setSPATK(floor($this->getSPATK() * 1.1));
                $this->setSPDEF(floor($this->getSPDEF() * 0.9));
                break;
            case 'Calm':
                // SPDEF erhöht, ATK verringert
                $this->setSPDEF(floor($this->getSPDEF() * 1.1));
                $this->setATK(floor($this->getATK() * 0.9));
                break;
            case 'Gently':
                // SPDEF erhöht, SPEED verringert
                $this->setSPDEF(floor($this->getSPDEF() * 1.1));
                $this->setSPEED(floor($this->getSPEED() * 0.9));
                break;
            case 'Sassy':
                // SPDEF erhöht, SPATK verringert
                $this->setSPDEF(floor($this->getSPDEF() * 1.1));
                $this->setSPATK(floor($this->getSPATK() * 0.9));
                break;
            case 'Careful':
                // SPDEF erhöht, SPATK verringert
                $this->setSPDEF(floor($this->getSPDEF() * 1.1));
                $this->setSPATK(floor($this->getSPATK() * 0.9));
                break;
            case 'Quirky':
                // Keine Änderungen, da neutral
                break;
            default:
                break;
        }
    }

    public function CalcAllStats()
    {
        $this->CalcHP();
        $this->setATK($this->CalcStat($this->getAtkBase(), $this->getAtkIV(), $this->getAtkEV()));
        $this->setDEF($this->CalcStat($this->getDefBase(), $this->getDefIV(), $this->getDefEV()));
        $this->setSPATK($this->CalcStat($this->getSPABase(), $this->getSpAtkIV(), $this->getSpAtkEV()));
        $this->setSPDEF($this->CalcStat($this->getSpDBase(), $this->getSpDefIV(), $this->getSpDefEV()));
        $this->setSPEED($this->CalcStat($this->getSpeBase(), $this->getSpeedIV(), $this->getSpeedEV()));
        $this->NatureAffect();
    }

    public function setAllMoves($move1, $move2, $move3, $move4)
    {
        $this->move1 = $move1;
        $this->move2 = $move2;
        $this->move3 = $move3;
        $this->move4 = $move4;
    }


    public function getTypes()
    {
        $conn = DBConnection::getConnection();

        $sql = "SELECT * FROM PokemonTypes WHERE Nr = :Nr AND Name = :Name";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':Nr', $this->getNr());
        $stmt->bindValue(':Name', $this->getName());

        $result = $stmt->execute();

        $row = $result->fetchArray(SQLITE3_ASSOC);

        $this->setType1($row["Type1"]);
        $this->setType2($row["Type2"]);
    }

    public function serializeToJson() {
        return json_encode(get_object_vars($this));
    }

    public function serialize() {
        return serialize($this);
    }
}
