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
  initMoveCalc();
}

function calc(pokemon) {
  const triggeredElementId = event.target.id;
  console.log(triggeredElementId);
  const moveid = triggeredElementId.slice(0, -4); // Verwenden Sie 'const' hier
  console.log(moveid);

  const lastChar = moveid.slice(-1);
  console.log("Last Character of Move ID:", lastChar);

  const selectElementID = pokemon + "move" + lastChar;

  const selectElement = document.getElementById(selectElementID);

  if (!selectElement) {
    console.error("Select element not found:", selectElementID);
    return;
  }

  const selectedMoveId = parseInt(selectElement.value);

  console.log(selectedMoveId);
  if (selectedMoveId != null && moveid != "") {
    if (pokemon === "pokemon1") {
      fillResult(selectedMoveId, moveid, "1");
    } else if (pokemon === "pokemon2") {
      fillResult(selectedMoveId, moveid, "2");
    }
  }
}

async function fillResult(selectedMoveId, moveid, target) {
  let resultarray = [];
  for (let i = 85; i < 101; i++) {
    let calc = await calcDmg(selectedMoveId, moveid, target, i);
    if (!resultarray.includes(calc)) {
      resultarray.push(calc);
    }
  }
  console.log(resultarray);
  document.getElementById(moveid+"dmgrolls").innerHTML = resultarray.join(', ');
}

async function calcDmg(moveId, triggered, target, Z) {
  let levelid, pType1, pType2, Defid, SpDefid;

  if (target === "1") {
    levelid = "level";
    pType1 = "p2T1";
    pType2 = "p2T2";
    Defid = "resultDef2";
    SpDefid = "resultSpDef2";
  } else if (target === "2") {
    levelid = "level2";
    pType1 = "p1T1";
    pType2 = "p1T2";
    Defid = "resultDef";
    SpDefid = "resultSpDef";
  } else {
    throw new Error("Invalid target");
  }

  let moveData;
  try {
    const response = await fetch(`Scripts/getmovesdetails.php?id=${moveId}`);
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    moveData = await response.json();
    console.log(moveData);
  } catch (error) {
    console.error("Error fetching data:", error);
  }

  const movedmg = moveData.Power;
  const typeatk = moveData.Type;
  const level = document.getElementById(levelid).value;
  const p2t1 = document.getElementById(pType1).textContent;
  const p2t2 = document.getElementById(pType2).textContent;

  const Atk = getAtk(moveData.Category, target);
  const Def = getDef(moveData.Category, target);

  const BaseDmg = getBaseDmg(movedmg);
  const Crit = getCrit(triggered);

  const F1 = getF1(moveData.Category, parseInt(moveData.Target), moveData.Type);
  const F2 = getF2();
  const STAB = checkStab(typeatk, p2t1, p2t2);
  const Type1 = checkTypes(typeatk, p2t1);
  const Type2 = checkTypes(typeatk, p2t2);
  const F3 = getF3();

  const Dmg =
    ((level * (2 / 5) + 2) * BaseDmg * (Atk / (50 * Def)) * F1 + 2) *
    Crit *
    F2 *
    (Z / 100) *
    STAB *
    Type1 *
    Type2 *
    F3;
  console.log(Math.floor(Dmg));
  return Math.floor(Dmg);
}

function checkStab(moveType, Type1, Type2) {
  Type1 = Type1.toLowerCase();
  Type2 = Type2.toLowerCase();
  if (moveType === Type1 || moveType === Type2) {
    return 1.5;
  } else {
    return 1;
  }
}

function getCrit(moveid) {
  if (moveid !== undefined) {
    const checkboxid = moveid + "Crit";
    const checkbox = document.getElementById(checkboxid);

    if (checkbox.checked) {
      return 1.5;
    } else {
      return 1;
    }
  }
}

function checkTypes(moveType, pokemonTyp) {
  //Done
  moveType = moveType.toLowerCase();
  pokemonTyp = pokemonTyp.toLowerCase();
  const effektivitaeten = {
    normal: {
      ghost: 0,
    },
    fighting: {
      normal: 2,
      rock: 2,
      steel: 2,
      ice: 2,
      dark: 2,
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
      flying: 2,
      bug: 2,
      fire: 2,
      ice: 2,
      fighting: 0.5,
      ground: 0.5,
      steel: 0.5,
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

  if (effektivitaeten.hasOwnProperty(moveType) && pokemonTyp !== null) {
    moveType = moveType.toLowerCase();
    pokemonTyp = pokemonTyp.toLowerCase();
    if (effektivitaeten[moveType].hasOwnProperty(pokemonTyp)) {
      const effektivitaet = effektivitaeten[moveType][pokemonTyp];
      if (effektivitaet > 1) {
        return 2;
      } else if (effektivitaet < 1) {
        return 0.5;
      } else {
        return 1;
      }
    } else {
      return 1;
    }
  } else {
    return 1;
  }
}

function getAtk(Category, target) {
  if (Category === "Physical") {
    return parseInt(
      document.getElementById(target === "1" ? "resultAtk2" : "resultAtk")
        .textContent
    );
  } else if (Category === "Special") {
    return parseInt(
      document.getElementById(target === "1" ? "resultSpA2" : "resultSpA")
        .textContent
    );
  } else {
    return 0;
  }
}

function getDef(Category, target) {
  if (Category === "Physical") {
    return parseInt(
      document.getElementById(target === "1" ? "resultDef2" : "resultDef")
        .textContent
    );
  } else if (Category === "Special") {
    return parseInt(
      document.getElementById(target === "1" ? "resultSpDef2" : "resultSpDef")
        .textContent
    );
  } else {
    return 0;
  }
}

function getBaseDmg(BaseDmg) {
  const cbRH = document.getElementById("RH1"); // Rechte Hand
  const RH = cbRH.checked ? 1.5 : 1;

  const IT = getItemFactor(); // ItemFactor

  const cbLV = document.getElementById("LV1"); // Ladevorgang
  const LV = cbLV.checked ? 1.5 : 1;

  const LS = checkLS(); // Lehmsuhler
  const NM = checkNM(); // Nassmacher
  const AF = getownAbilityFactor(); // Anwender Fähigkeit
  const ZF = getenemyAbilityFactor(); // Ziel Fähigkeit

  return RH * BaseDmg * IT * LV * LS * NM * AF * ZF;
}

function getItemFactor() {
  return 1;
}

function getownAbilityFactor() {
  return 1;
}

function getenemyAbilityFactor() {
  return 1;
}

function checkLS() {
  return 1;
}

function checkNM() {
  return 1;
}

function getF1(Category, Target, moveType) {
  const StatusOption =
    document.getElementById("status1select").options[
      document.getElementById("status1select").selectedIndex
    ];
  const StatusName = StatusOption.textContent;
  const AbilityOption =
    document.getElementById("ability1select").options[
      document.getElementById("ability1select").selectedIndex
    ];
  const AbilityName = AbilityOption.textContent;

  let BRT = 1;
  if (StatusName === "Burn") {
    BRT = AbilityName === "Adrenaline" ? 2 : 0.5;
  }

  let RL = 1;
  if (Category === "Physical") {
    const cbRef = document.getElementById("Ref1");
    RL = cbRef.checked ? 0.5 : 1;
  } else if (Category === "Special") {
    const cbLi = document.getElementById("Li1");
    RL = cbLi.checked ? 0.5 : 1;
  }

  const V = Target !== 1 ? 0.75 : 1;

  const SR = CheckSR(moveType);
  const FF = checkFF(moveType);

  return BRT * RL * V * SR * FF;
}

function CheckSR(moveType) {
  const cbST = document.getElementById("ST");
  if (cbST.checked) {
    if (moveType === "Fire") {
      return 1.5;
    } else if (moveType === "Water") {
      return 0.5;
    } else {
      return 1;
    }
  }

  const cbRT = document.getElementById("RT");
  if (cbRT.checked) {
    if (moveType === "Water") {
      return 1.5;
    } else if (moveType === "Fire") {
      return 0.5;
    } else {
      return 1;
    }
  } else {
    return 1;
  }
}

function checkFF(moveType) {
  const cbFF = document.getElementById("FF1");
  return cbFF.checked && moveType === "Fire" ? 1.5 : 1;
}

function getF2(item, moveName) {
  let LO = 1; // Life Orb
  let M = 1; // Metronome
  let ET = 1; // Egotrip

  if (item === "Life Orb") {
    LO = 1.3;
  }

  if (moveName === "Egotrip") {
    ET = 1.5;
  }

  return LO * M * ET;
}

function getF3(item, ability, type1, type2, itemp2) {
  let FKF = 1; // Felskern || Filter
  let EG = 1; // Expertengurt
  let A = 1; // Aufwertung
  let B = 1; // Beere

  if (
    (item === "Expertbelt" && type1 > 1) ||
    (item === "Expertengurt" && type2 > 1)
  ) {
    EG = 1.2;
  }

  if (ability === "Felskern" || ability === "Filter") {
    if (type1 > 1 || type2 > 1) {
      FKF = 0.5;
    }
  }

  if (ability === "Aufwertung") {
    if (type1 < 1 || type2 < 1) {
      A = 2;
    }
  }

  if (checkBerry(itemp2)) {
    B = 0.5;
  }

  return FKF * EG * A * B;
}

function checkBerry(itemp2) {
  return itemp2 === "y";
}

function initMoveCalc() {
  setCheckboxAndTriggerChange("1resultmovedmg1Crit");
  setCheckboxAndTriggerChange("1resultmovedmg2Crit");
  setCheckboxAndTriggerChange("1resultmovedmg3Crit");
  setCheckboxAndTriggerChange("1resultmovedmg4Crit");
}

function setCheckboxAndTriggerChange(checkboxId) {
  const checkbox = document.getElementById(checkboxId);
  if (checkbox) {
    checkbox.checked = true;
    // Create and dispatch the event
    const event = new Event('change');
    checkbox.dispatchEvent(event);
  } else {
    console.error(`Checkbox with ID ${checkboxId} not found.`);
  }
}