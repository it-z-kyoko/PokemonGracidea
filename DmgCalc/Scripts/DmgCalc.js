document.addEventListener("DOMContentLoaded", async function () {
  try {
    await updatePokemonSelection(
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

    await updatePokemonSelection(
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
    await setCheckboxAndTriggerChange("CurrHP1");
    await setCheckboxAndTriggerChange("CurrHP2");
    initializeCalculations();
    moves();

    fillAttacks(1);
    fillAttacks(2);




  } catch (error) {
    console.error("Error:", error);
  }
});


function calc(pokemon) {
  
  const triggeredElementId = event.target.id;
  const moveid = triggeredElementId.slice(0, -4); // Verwenden Sie 'const' hier

  const lastChar = moveid.slice(-1);

  const selectElementID = pokemon + "move" + lastChar;

  const selectElement = document.getElementById(selectElementID);

  if (!selectElement) {
    console.error("Select element not found:", selectElementID);
    return;
  }

  const selectedMoveId = parseInt(selectElement.value);

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
  const moveData = await getMoveData(selectedMoveId);
  for (let i = 85; i < 101; i++) {
    let calc = await calcDmg(moveid, target, i, moveData);
    if (calc !== null && !resultarray.includes(calc)) {
      resultarray.push(calc);
    }
  }

  document.getElementById(moveid + "dmgrolls").innerHTML = resultarray.join(", ");

  // Berechnung des Prozentbereichs
  const maxHP = getMaxHP(target);
  if (resultarray.length > 0 && maxHP > 0) {
    const minPercent = ((resultarray[0] / maxHP) * 100).toFixed(1);
    const maxPercent = ((resultarray[resultarray.length - 1] / maxHP) * 100).toFixed(1);
    const percentRange = `${minPercent}% - ${maxPercent}%`;

    document.getElementById(moveid + "percentage").innerHTML = percentRange;
  } else {
    document.getElementById(moveid + "percentage").innerHTML = "N/A";
  }
}



function getMaxHP(target) {
  const maxHPElementId = `CurrHP${target}`;
  const maxHP = parseInt(document.getElementById(maxHPElementId).value, 10);
  return maxHP;
}



async function calcDmg(triggered, target, Z, moveData) {
  let levelid, pType1, pType2, Defid, SpDefid;
  if (moveData != null) {
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
    const movedmg = moveData.Power;
    const typeatk = moveData.Type;
    const levelElem = document.getElementById(levelid);
    const pType1Elem = document.getElementById(pType1);
    const pType2Elem = document.getElementById(pType2);

    if (!levelElem || !pType1Elem || !pType2Elem) {
      console.error("Required element(s) not found.");
      return null;
    }

    const level = parseInt(levelElem.value, 10);
    const p2t1 = pType1Elem.textContent;
    const p2t2 = pType2Elem.textContent;

    const Atk = getAtk(moveData.Category, target);
    const Def = getDef(moveData.Category, target);

    const BaseDmg = getBaseDmg(movedmg);
    const Crit = getCrit(triggered);

    const F1 = getF1(moveData.Category, parseInt(moveData.Target, 10), moveData.Type);
    const F2 = getF2();
    const STAB = checkStab(typeatk, p2t1, p2t2);
    const Type1 = checkTypes(typeatk, p2t1);
    const Type2 = checkTypes(typeatk, p2t2);
    const F3 = getF3();

    const Dmg = ((level * (2 / 5) + 2) * BaseDmg * (Atk / (50 * Def)) * F1 + 2) *
      Crit * F2 * (Z / 100) * STAB * Type1 * Type2 * F3;

    if (isNaN(Dmg)) {
      console.error("Dmg calculation resulted in NaN. Variables:");
      console.log({
        level,
        movedmg,
        typeatk,
        Atk,
        Def,
        BaseDmg,
        Crit,
        F1,
        F2,
        STAB,
        Type1,
        Type2,
        F3,
        Z
      });
    }

    return Math.floor(Dmg);
  }
  else {
    return 0;
  }
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

function getAtk(Category, target, ability) {
  function getBoostedAtk(atk, StatusOption) {
    switch (StatusOption.textContent) {
      case "-6":
        return Math.floor(atk * (ability === "Simple" ? 0.25 : 0.25));
      case "-5":
        return Math.floor(atk * (ability === "Simple" ? 0.25 : (2 / 7)));
      case "-4":
        return Math.floor(atk * (ability === "Simple" ? 0.25 : (1 / 3)));
      case "-3":
        return Math.floor(atk * (ability === "Simple" ? 0.25 : 0.4));
      case "-2":
        return Math.floor(atk * (ability === "Simple" ? (1 / 3) : 0.5));
      case "-1":
        return Math.floor(atk * (ability === "Simple" ? 0.5 : (2 / 3)));
      case "0":
        return Math.floor(atk * 1);
      case "+1":
        return Math.floor(atk * (ability === "Simple" ? 2 : 1.5));
      case "+2":
        return Math.floor(atk * (ability === "Simple" ? 3 : 2));
      case "+3":
        return Math.floor(atk * (ability === "Simple" ? 4 : 2.5));
      case "+4":
        return Math.floor(atk * (ability === "Simple" ? 4 : 3));
      case "+5":
        return Math.floor(atk * (ability === "Simple" ? 4 : 3.5));
      case "+6":
        return Math.floor(atk * (ability === "Simple" ? 4 : 4));
      default:
        return atk;
    }
  }

  function getFF(ability, target) {
    let FF = 1; // Default value

    const status = document.getElementById(target === "1" ? "status1select" : "status2select").value;
    const isNotHealthyOrAsleep = status !== "healthy" && status !== "asleep";

    const CurrHP = parseInt(document.getElementById(target === "1" ? "CurrHP1" : "CurrHP2").value, 10);
    const MaxHP = parseInt(document.getElementById(target === "1" ? "CurrHP1" : "CurrHP2").max, 10);

    const PMCheckbox = document.getElementById(target === "1" ? "PM1" : "PM2").checked;
    const SSCheckbox = document.getElementById(target === "1" ? "SS1" : "SS2").checked;
    const STCheckbox = document.getElementById("ST").checked;

    switch (ability) {
      case "Guts":
        if (isNotHealthyOrAsleep) {
          FF = 1.5;
        }
        break;
      case "Toxic Boost":
        if (status === "Poisoned") {
          FF = 1.5;
        }
        break;
      case "Flare Boost":
        if (status === "Burned") {
          FF = 1.5;
        }
        break;
      case "Huge Power":
      case "Pure Power":
        FF = 2;
        break;
      case "Minus":
      case "Plus":
        if (PMCheckbox) {
          FF = 1.5;
        }
        break;
      case "Flower Gift":
        if (STCheckbox) {
          FF = 1.5;
        }
        break;
      case "Slow Start":
        if (SSCheckbox) {
          FF = 0.5;
        }
        break;
      case "Defeatist":
        if (CurrHP < MaxHP / 2) {
          FF = 0.5;
        }
        break;
      case "Solar Power":
        if (STCheckbox) {
          FF = 1.5;
        }
        break;
      case "Hustle":
        FF = 1.5;
        break;
      default:
        FF = 1;
    }

    return FF;
  }


  if (Category === "Physical") {
    let atk = parseInt(
      document.getElementById(target === "1" ? "resultAtk" : "resultAtk2").textContent
    );
    const StatusOption = document.getElementById(target === "1" ? "Atkboost1" : "Atkboost2").options[
      document.getElementById(target === "1" ? "Atkboost1" : "Atkboost2").selectedIndex
    ];
    return getBoostedAtk(atk, StatusOption) * getFF(ability, target);
  } else if (Category === "Special") {
    let atk = parseInt(
      document.getElementById(target === "1" ? "resultSpA" : "resultSpA2").textContent
    );
    const StatusOption = document.getElementById(target === "1" ? "SpAboost1" : "SpAboost2").options[
      document.getElementById(target === "1" ? "SpAboost1" : "SpAboost2").selectedIndex
    ];
    return getBoostedAtk(atk, StatusOption);
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

function getBaseDmg(BaseDmg, target) {
  const cbRH = document.getElementById(target === "1" ? "RH1" : "RH2"); // Rechte Hand
  const RH = cbRH.checked ? 1.5 : 1;

  const IT = getItemFactor(target); // ItemFactor

  const cbLV = document.getElementById(target === "1" ? "LV1" : "LV2"); // Ladevorgang
  const LV = cbLV.checked ? 1.5 : 1;

  const LS = checkLS(target); // Lehmsuhler
  const NM = checkNM(target); // Nassmacher
  const AF = getownAbilityFactor(target); // Anwender Fähigkeit
  const ZF = getenemyAbilityFactor(target); // Ziel Fähigkeit

  return RH * BaseDmg * IT * LV * LS * NM * AF * ZF;
}


function getItemFactor(target) {
  return 1;
}

function getownAbilityFactor(target) {
  return 1;
}

function getenemyAbilityFactor(target) {
  return 1;
}

function checkLS(target) {
  return 1;
}

function checkNM(target) {
  return 1;
}

function getF1(Category, Target, moveType) {
  const statusSelectId = Target === "1" ? "status1select" : "status2select";
  const abilitySelectId = Target === "1" ? "ability1select" : "ability2select";
  const refCheckboxId = Target === "1" ? "Ref1" : "Ref2";
  const liCheckboxId = Target === "1" ? "Li1" : "Li2";

  const StatusOption = document.getElementById(statusSelectId).options[
    document.getElementById(statusSelectId).selectedIndex
  ];
  const StatusName = StatusOption.textContent;

  const AbilityOption = document.getElementById(abilitySelectId).options[
    document.getElementById(abilitySelectId).selectedIndex
  ];
  const AbilityName = AbilityOption.textContent;

  let BRT = 1;
  if (StatusName === "Burned") {
    BRT = AbilityName === "Adrenaline" ? 2 : 0.5;
  }

  let RL = 1;
  if (Category === "Physical") {
    const cbRef = document.getElementById(refCheckboxId);
    RL = cbRef.checked ? 0.5 : 1;
  } else if (Category === "Special") {
    const cbLi = document.getElementById(liCheckboxId);
    RL = cbLi.checked ? 0.5 : 1;
  }

  const V = Target !== "1" ? 0.75 : 1;

  const SR = CheckSR(moveType);
  const FF = checkFF(moveType, Target);

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

function checkFF(moveType, Target) {
  const ffCheckboxId = Target === "1" ? "FF1" : "FF2";
  const cbFF = document.getElementById(ffCheckboxId);
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

function setCheckboxAndTriggerChange(checkboxId) {
  return new Promise((resolve, reject) => {
    const checkbox = document.getElementById(checkboxId);
    if (checkbox) {
      const event = new Event('change');
      checkbox.dispatchEvent(event);
      resolve();
    } else {
      console.error(`Checkbox with ID ${checkboxId} not found.`);
      reject(`Checkbox with ID ${checkboxId} not found.`);
    }
  });
}


function fillAttacks(nr) {
  for (let i = 1; i <= 4; i++) {
    const moveSelect = document.getElementById(`pokemon${nr}move${i}`);
    const resultSpan = document.getElementById(`${nr}resultmovedmg${i}name`);

    if (moveSelect && resultSpan) {
      const moveOption = moveSelect.options[moveSelect.selectedIndex];
      const abilityName = moveOption.textContent;
      resultSpan.textContent = abilityName;
    }
  }
}

function healthupdate() {
  
  let maxHP;
  let nr;
  const triggeredElementId = event.target.id;

  const currHP = document.getElementById(triggeredElementId).value;
  if (triggeredElementId === "CurrHP1") {
    maxHP = document.getElementById("resultHP").textContent;
    nr = 1;
  } else if (triggeredElementId === "CurrHP2") {
    maxHP = document.getElementById("resultHP2").textContent;
    nr = 2;
  }
  updateHealthBar(maxHP, currHP, nr);
}

function updateHealthBar(maxHealth, currentHealth, nr) {
  const healthBarInner = document.getElementById(nr + "health-bar-inner");
  const healthPercentage = (currentHealth / maxHealth) * 100;
  healthBarInner.style.width = healthPercentage + "%";
  healthBarInner.textContent = currentHealth + " / " + maxHealth;

  if (currentHealth > 50) {
    healthBarInner.style.backgroundColor = "green";
  } else if (currentHealth > 20) {
    healthBarInner.style.backgroundColor = "yellow";
  } else {
    healthBarInner.style.backgroundColor = "red";
  }
}

async function getMoveData(moveid) {
  let moveData;
  try {
    const url = `Scripts/getmovesdetails.php?id=${moveid}`;
    console.log(`Fetching data from URL: ${url}`);

    const response = await fetch(url);
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    moveData = await response.json();

    console.log(moveData);
    if (moveData.Category === "Status") {
      return null;
    }
    else {
      if (!moveData || typeof moveData !== 'object' || !moveData.Power || !moveData.Type || !moveData.Category) {
        throw new Error("Invalid move data received");
      }
      return moveData;
    }

  } catch (error) {
    console.error("Error fetching data:", error);
    return null;
  }
}