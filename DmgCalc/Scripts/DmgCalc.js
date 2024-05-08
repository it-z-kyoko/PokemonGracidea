// Event-Handler für Eingabefelder

function bodyload() {
  updatePokemonSelection(
    "pokemonSelect",
    "pokemon1picture",
    "level",
    "HPBaseStat",
    "HPEV",
    "HPIV",
    "AtkBaseStat",
    "AtkEV",
    "AtkIV",
    "DefBaseStat",
    "DefEV",
    "DefIV",
    "SpABaseStat",
    "SpAEV",
    "SpAIV",
    "SpDBaseStat",
    "SpDEV",
    "SpDIV",
    "SpeBaseStat",
    "SpeEV",
    "SpeIV",
    "p1T1",
    "p1T2",
    "natureSelect1",
    "ability1select"
  );
  updatePokemonSelection(
    "pokemonSelect2",
    "pokemon2picture",
    "level2",
    "HPBaseStat2",
    "HPEV2",
    "HPIV2",
    "AtkBaseStat2",
    "AtkEV2",
    "AtkIV2",
    "DefBaseStat2",
    "DefEV2",
    "DefIV2",
    "SpABaseStat2",
    "SpAEV2",
    "SpAIV2",
    "SpDBaseStat2",
    "SpDEV2",
    "SpDIV2",
    "SpeBaseStat2",
    "SpeEV2",
    "SpeIV2",
    "p2T1",
    "p2T2",
    "natureSelect2",
    "ability2select"
  );
  initializeCalculations();
  moves();
}

async function calcDmg1(moveId, min) {
  try {
    const response = await fetch(`Scripts/getmovesdetails.php?id=${moveId}`);
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    const moveData = await response.json();
  } catch (error) {
    console.error("Error fetching data:", error);
  }
  //((Level * (2/5) + 2) * Basischaden * (SpA|Atk / (50* SpD|Def)) * F1 + 2) * Volltreffer * F2 * (Z/100) * STAB * Typ1 * Typ2 * F3
  // Basischaden = RH * BS * IT * LV * LS * NM * AF * ZF

  const movedmg = parseInt(document.getElementById(moveId).textContent);
  const level = document.getElementById("level").value;
  /*const Atk = parseInt(document.getElementById("resultAtk").textContent);
  const SpA = parseInt(document.getElementById("resultSpa").textContent);
  const Def = parseInt(document.getElementById("resultDef").textContent);
  const SpD = parseInt(document.getElementById("resultSpD").textContent);*/
  const p2t1 = document.getElementById("p2T1").textContent;
  const p2t2 = document.getElementById("p2T2").textContent;

  const Atk = getAtk(moveData.Category);
  const Def = getDef();

  const BaseDmg = getBaseDmg();
  const Crit = getCrit(moveId);

  if (min) {
    const Z = 85;
  } else {
    const Z = 100;
  }

  const F1 = getF1();
  const F2 = getF2();
  const STAB = checkStab();
  const Type1 = checkTypes(moveData.Type, p2t1);
  const Type2 = checkTypes(moveData.Type, p2t2);
  const F3 = getF2();

  Dmg =
    ((level * (2 / 5) + 2) * BaseDmg * (ATK / (50 * DEF)) * F1 + 2) *
    Crit *
    F2 *
    (Z / 100) *
    STAB *
    Type1 *
    Type2 *
    F3;

  return Dmg;
}

function checkStab(moveType, Type1, Type2) {
  Type1 = Type1.toLowerCase();
  Type2 = Type2.toLowerCase();
  if (moveType == Type1 || moveType == Type2) {
    return 1.5;
  } else {
    return 1;
  }
}

function getCrit(moveid) {
  const checkboxid = moveid + "Crit";
  const checkbox = document.getElementById(checkboxid);

  if (checkbox.checked) {
    return 1.5;
  } else {
    return 1;
  }
}

function updateCrit() {
  // ID des Elements, das die Funktion ausgelöst hat, erhalten
  const triggeredElementId = event.target.id;

  //calcDmg1(triggeredElementId);
  //ToDo: find way to implement it good
}

function checkTypes(moveType, pokemonTyp) {
  // Typen-Effektivitäten definieren
  const effektivitaeten = {
    normal: { fighting: 1, ghost: 0 },
    fighting: {
      normal: 1,
      rock: 1,
      steel: 1,
      ice: 1,
      dark: 1,
      flying: 0.5,
      poison: 0.5,
      bug: 0.5,
      psychic: 0.5,
      fairy: 0.5,
    },
    flying: {
      fighting: 2,
      rock: 2,
      bug: 2,
      grass: 2,
      electric: 0.5,
      steel: 0.5,
      fighting: 0.5,
      ground: 0,
    },
    poison: {
      grass: 2,
      fairy: 2,
      fighting: 0.5,
      poison: 0.5,
      bug: 0.5,
      ground: 0.5,
      ghost: 0.5,
    },
    ground: {
      poison: 2,
      rock: 2,
      steel: 2,
      fire: 2,
      electric: 0,
      flying: 0,
      bug: 0.5,
      grass: 0.5,
    },
    rock: {
      flying: 0.5,
      bug: 0.5,
      fire: 0.5,
      ice: 0.5,
      fighting: 2,
      ground: 2,
      steel: 2,
    },
    bug: {
      grass: 2,
      psychic: 2,
      dark: 2,
      fighting: 0.5,
      flying: 0.5,
      poison: 0.5,
      ghost: 0.5,
      steel: 0.5,
      fire: 0.5,
      fairy: 0.5,
    },
    ghost: { ghost: 2, psychic: 2, normal: 0, dark: 0.5 },
    steel: {
      rock: 2,
      ice: 2,
      fairy: 2,
      steel: 0.5,
      fire: 0.5,
      water: 0.5,
      electric: 0.5,
    },
    fire: {
      bug: 2,
      steel: 2,
      grass: 2,
      ice: 2,
      rock: 0.5,
      fire: 0.5,
      water: 0.5,
      dragon: 0.5,
    },
    water: { ground: 2, rock: 2, fire: 2, water: 0.5, grass: 0.5, dragon: 0.5 },
    grass: {
      ground: 2,
      rock: 2,
      water: 2,
      grass: 0.5,
      electric: 0.5,
      fire: 0.5,
      ice: 0.5,
      bug: 0.5,
    },
    electric: { flying: 2, water: 2, electric: 0.5, grass: 0.5, dragon: 0.5 },
    psychic: { fighting: 2, poison: 2, psychic: 0.5, dark: 0 },
    ice: {
      flying: 2,
      ground: 2,
      grass: 2,
      dragon: 2,
      water: 0.5,
      fire: 0.5,
      ice: 0.5,
      steel: 0.5,
    },
    dragon: { dragon: 2, steel: 0.5, fairy: 0 },
    dark: { ghost: 2, psychic: 2, fighting: 0.5, dark: 0.5, fairy: 0.5 },
    fairy: { fighting: 2, dragon: 2, dark: 2, bug: 0.5, dark: 0.5, steel: 0.5 },
  };

  // Überprüfen, ob der moveType im Array der Effektivitäten vorhanden ist
  if (effektivitaeten.hasOwnProperty(moveType) && pokemonTyp !== null) {
    // Typen in Kleinbuchstaben umwandeln
    moveType = moveType.toLowerCase();
    pokemonTyp = pokemonTyp.toLowerCase();
    // Überprüfen, ob der pokemonTyp im Array der Effektivitäten für den moveType vorhanden ist
    if (effektivitaeten[moveType].hasOwnProperty(pokemonTyp)) {
      const effektivitaet = effektivitaeten[moveType][pokemonTyp];
      // Überprüfen, ob die Effektivität sehr effektiv, neutral oder nicht sehr effektiv ist
      if (effektivitaet > 1) {
        return 2;
      } else if (effektivitaet < 1) {
        return 0.5;
      } else {
        return 1;
      }
    } else {
      // Falls der pokemonTyp nicht im Array der Effektivitäten für den moveType vorhanden ist
      return 1;
    }
  } else {
    // Falls der moveType nicht im Array der Effektivitäten vorhanden ist
    return 1;
  }
}

function getAtk(Category) {
  if (Category === "Physical") {
    return document.getElementById("resultAtk").textContent;
  } else if (Category === "Special") {
    return document.getElementById("resultSpA").textContent;
  } else {
    return 0;
  }
}

function getDef(Category) {
  if (Category === "Physical") {
    return document.getElementById("resultDef2").textContent;
  } else if (Category === "Special") {
    return document.getElementById("resultSpD2").textContent;
  } else {
    return 0;
  }
}

function getBaseDmg(BaseDmg) {
  const cbRH = document.getElementById("RH1");
  if (cbRH.checked) {
    const RH = 1.5
  } else {
    const RH = 1
  }


  const IT = getItemFactor();
  const cbLV = document.getElementById("LV1");
  if (cbRH.checked) {
    const LV = 1.5
  } else {
    const LV = 1
  }
  const LS = checkLS();
  const NM = checkNM();
  const AF = getownAbilityFactor();
  const ZF = getenemyAbilityFactor();
  

  return RH * BaseDmg * IT * LV * LS * NM * AF * ZF
}

function getItemFactor() {
  return null;
}

function getownAbilityFactor() {
  return null;
}

function getenemyAbilityFactor() {
  return null;
}

function checkLS() {
  return null;
}

function checkNM() {
  return null;
}