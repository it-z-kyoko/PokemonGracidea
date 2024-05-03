<?php
class Move {
    public $ID;
    public $Name;
    public $Type;
    public $Category;
    public $Accuracy;
    public $PP;
    public $Effect;
    public $EffectProb;
    public $Target;
    public $Power;

    public function __construct($ID, $Name, $Type, $Category, $Accuracy, $PP, $Effect, $EffectProb, $Target, $Power) {
        $this->ID = $ID;
        $this->Name = $Name;
        $this->Type = $Type;
        $this->Category = $Category;
        $this->Accuracy = $Accuracy;
        $this->PP = $PP;
        $this->Effect = $Effect;
        $this->EffectProb = $EffectProb;
        $this->Target = $Target;
        $this->Power = $Power;
    }

    // Setter
    public function setID($ID) {
        $this->ID = $ID;
    }

    public function setName($Name) {
        $this->Name = $Name;
    }

    public function setType($Type) {
        $this->Type = $Type;
    }

    public function setCategory($Category) {
        $this->Category = $Category;
    }

    public function setAccuracy($Accuracy) {
        $this->Accuracy = $Accuracy;
    }

    public function setPP($PP) {
        $this->PP = $PP;
    }

    public function setEffect($Effect) {
        $this->Effect = $Effect;
    }

    public function setEffectProb($EffectProb) {
        $this->EffectProb = $EffectProb;
    }

    public function setTarget($Target) {
        $this->Target = $Target;
    }

    public function setPower($Power) {
        $this->Power = $Power;
    }

    // Getter
    public function getID() {
        return $this->ID;
    }

    public function getName() {
        return $this->Name;
    }

    public function getType() {
        return $this->Type;
    }

    public function getCategory() {
        return $this->Category;
    }

    public function getAccuracy() {
        return $this->Accuracy;
    }

    public function getPP() {
        return $this->PP;
    }

    public function getEffect() {
        return $this->Effect;
    }

    public function getEffectProb() {
        return $this->EffectProb;
    }

    public function getTarget() {
        return $this->Target;
    }

    public function getPower() {
        return $this->Power;
    }

    public function getDetails() {
        return [
            'ID' => $this->ID,
            'Name' => $this->Name,
            'Type' => $this->Type,
            'Category' => $this->Category,
            'Accuracy' => $this->Accuracy,
            'PP' => $this->PP,
            'Effect' => $this->Effect,
            'EffectProb' => $this->EffectProb,
            'Target' => $this->Target,
            'Power' => $this->Power
        ];
    }
    
}

?>