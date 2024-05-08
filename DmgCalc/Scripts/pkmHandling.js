async function updatePokemonSelection(
  pokemonSelectId,
  pokemonPictureId,
  levelId,
  HPBaseStatId,
  HPEVId,
  HPIVId,
  AtkBaseStatId,
  AtkEVId,
  AtkIVId,
  DefBaseStatId,
  DefEVId,
  DefIVId,
  SpABaseStatId,
  SpAEVId,
  SpAIVId,
  SpDBaseStatId,
  SpDEVId,
  SpDIVId,
  SpeBaseStatId,
  SpeEVId,
  SpeIVId,
  p1T1Id,
  p1T2Id,
  natureid,
  abilityid
) {
  const pokemonId = parseInt(document.getElementById(pokemonSelectId).value);
  const selectedOption =
    document.getElementById(pokemonSelectId).options[
      document.getElementById(pokemonSelectId).selectedIndex
    ];
  const selectedName = selectedOption.textContent;
  const meinBild = document.getElementById(pokemonPictureId);

  meinBild.src = "../sprites/Gracidea-Dex/" + pokemonId + ".png";

  try {
    const response = await fetch(
      `Scripts/get_pokemon_details.php?pokemon_id=${pokemonId}&nickname=${selectedName}`
    );
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    const pokemonData = await response.json();
    console.log(pokemonData);
    document.getElementById(levelId).value = pokemonData.level;
    document.getElementById(HPBaseStatId).value = pokemonData.HPBase;
    document.getElementById(HPEVId).value = pokemonData.hpEV;
    document.getElementById(HPIVId).value = pokemonData.hpIV;
    document.getElementById(AtkBaseStatId).value = pokemonData.AtkBase;
    document.getElementById(AtkEVId).value = pokemonData.atkEV;
    document.getElementById(AtkIVId).value = pokemonData.atkIV;
    document.getElementById(DefBaseStatId).value = pokemonData.DefBase;
    document.getElementById(DefEVId).value = pokemonData.defEV;
    document.getElementById(DefIVId).value = pokemonData.defIV;
    document.getElementById(SpABaseStatId).value = pokemonData.SpABase;
    document.getElementById(SpAEVId).value = pokemonData.spAtkEV;
    document.getElementById(SpAIVId).value = pokemonData.spAtkIV;
    document.getElementById(SpDBaseStatId).value = pokemonData.SpDBase;
    document.getElementById(SpDEVId).value = pokemonData.spDefEV;
    document.getElementById(SpDIVId).value = pokemonData.spDefIV;
    document.getElementById(SpeBaseStatId).value = pokemonData.SpeBase;
    document.getElementById(SpeEVId).value = pokemonData.speedEV;
    document.getElementById(SpeIVId).value = pokemonData.speedIV;
    if (pokemonData.nature === null) {
      pokemonData.nature = "Hardy";
    }
    updateNature("natureSelect1");
    setNature(natureid, pokemonData.nature);
    updateNature("natureSelect2");
    setAbility(pokemonSelectId,abilityid);

    document.getElementById(p1T1Id).textContent = pokemonData.typ1;
    document.getElementById(p1T2Id).textContent = pokemonData.typ2;
    initializeCalculations();
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}

async function setAbility(pokemonSelectId,abilityid) {
  const pokemonId = parseInt(document.getElementById(pokemonSelectId).value);
  const selectedOption = document.getElementById(pokemonSelectId).options[
    document.getElementById(pokemonSelectId).selectedIndex
  ];
  const selectedName = selectedOption.textContent;

  try {
    const response = await fetch(
      `Scripts/getabilitydetails.php?pokemon_id=${pokemonId}&nickname=${selectedName}`
    );
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    const pokemonAbilities = await response.json();
    const selectElement = document.getElementById(abilityid);
    
    if (!selectElement) {
      console.error("Ability select element not found");
      return;
    }
    // Entfernen Sie vorhandene Optionen
    selectElement.innerHTML = '';
    // Iteriere über die Fähigkeiten und füge sie dem Select-Element hinzu
    for (const key in pokemonAbilities) {
      if (Object.hasOwnProperty.call(pokemonAbilities, key)) {
        const option = document.createElement("option");
        option.value = pokemonAbilities[key]; // Setzen Sie den Wert der Option auf den Wert der Fähigkeit
        option.textContent = pokemonAbilities[key]; // Setzen Sie den Text der Option auf den Wert der Fähigkeit
        selectElement.appendChild(option);
      }
    }
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}



function calcStat(BaseStat, IV, EV, level) {
  let stat = Math.floor(
    ((2 * BaseStat + IV + Math.floor(EV / 4)) * level) / 100 + 5
  );
  return stat;
}

function CalcHP(BaseStat, IV, EV, level) {
  let stat = Math.floor(
    ((2 * BaseStat + IV + Math.floor(EV / 4)) * level) / 100 + level + 10
  );
  return stat;
}

function calculateAttributeStat(
  attribute,
  baseFieldId,
  ivFieldId,
  evFieldId,
  resultElementId,
  level,
  nature
) {
  const baseStat = parseInt(document.getElementById(baseFieldId).value);
  const iv = parseInt(document.getElementById(ivFieldId).value);
  const ev = parseInt(document.getElementById(evFieldId).value);

  let result;

  // Berechne den Wert ohne Berücksichtigung der Natur
  if (attribute === "HP" || attribute === "HP 2") {
    result = CalcHP(baseStat, iv, ev, level);
  } else {
    result = calcStat(baseStat, iv, ev, level, nature);
  }

  // Berücksichtige die Natur, falls angegeben
  if (nature) {
    switch (nature) {
      case "Lonely":
        // ATK erhöht, DEF verringert
        if (attribute === "Attack" || attribute === "Attack 2") {
          result = Math.floor(result * 1.1);
        } else if (attribute === "Defense" || attribute === "Defense 2") {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Brave":
        // ATK erhöht, SPEED verringert
        if (attribute === "Attack" || attribute === "Attack 2") {
          result = Math.floor(result * 1.1);
        } else if (attribute === "Speed" || attribute === "Speed 2") {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Adamant":
        // ATK erhöht, SPATK verringert
        if (attribute === "Attack" || attribute === "Attack 2") {
          result = Math.floor(result * 1.1);
        } else if (
          attribute === "Special Attack" ||
          attribute === "Special Attack 2"
        ) {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Naughty":
        // ATK erhöht, SPDEF verringert
        if (attribute === "Attack" || attribute === "Attack 2") {
          result = Math.floor(result * 1.1);
        } else if (
          attribute === "Special Defense" ||
          attribute === "Special Defense 2"
        ) {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Bold":
        // DEF erhöht, ATK verringert
        if (attribute === "Defense" || attribute === "Defense 2") {
          result = Math.floor(result * 1.1);
        } else if (attribute === "Attack" || attribute === "Attack 2") {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Relaxed":
        // DEF erhöht, SPEED verringert
        if (attribute === "Defense" || attribute === "Defense 2") {
          result = Math.floor(result * 1.1);
        } else if (attribute === "Speed" || attribute === "Speed 2") {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Impish":
        // DEF erhöht, SPATK verringert
        if (attribute === "Defense" || attribute === "Defense 2") {
          result = Math.floor(result * 1.1);
        } else if (
          attribute === "Special Attack" ||
          attribute === "Special Attack 2"
        ) {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Lax":
        // DEF erhöht, SPDEF verringert
        if (attribute === "Defense" || attribute === "Defense 2") {
          result = Math.floor(result * 1.1);
        } else if (
          attribute === "Special Defense" ||
          attribute === "Special Defense 2"
        ) {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Timid":
        // SPEED erhöht, ATK verringert
        if (attribute === "Speed" || attribute === "Speed 2") {
          result = Math.floor(result * 1.1);
        } else if (attribute === "Attack" || attribute === "Attack 2") {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Hasty":
        // SPEED erhöht, DEF verringert
        if (attribute === "Speed" || attribute === "Speed 2") {
          result = Math.floor(result * 1.1);
        } else if (attribute === "Defense" || attribute === "Defense 2") {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Serious":
        // Keine Änderungen, da neutral
        break;
      case "Jolly":
        // SPEED erhöht, SPATK verringert
        if (attribute === "Speed" || attribute === "Speed 2") {
          result = Math.floor(result * 1.1);
        } else if (
          attribute === "Special Attack" ||
          attribute === "Special Attack 2"
        ) {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Naive":
        // SPEED erhöht, SPDEF verringert
        if (attribute === "Speed" || attribute === "Speed 2") {
          result = Math.floor(result * 1.1);
        } else if (
          attribute === "Special Defense" ||
          attribute === "Special Defense 2"
        ) {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Modest":
        // SPATK erhöht, ATK verringert
        if (
          attribute === "Special Attack" ||
          attribute === "Special Attack 2"
        ) {
          result = Math.floor(result * 1.1);
        } else if (attribute === "Attack" || attribute === "Attack 2") {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Mild":
        // SPATK erhöht, DEF verringert
        if (
          attribute === "Special Attack" ||
          attribute === "Special Attack 2"
        ) {
          result = Math.floor(result * 1.1);
        } else if (attribute === "Defense" || attribute === "Defense 2") {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Quiet":
        // SPATK erhöht, SPEED verringert
        if (
          attribute === "Special Attack" ||
          attribute === "Special Attack 2"
        ) {
          result = Math.floor(result * 1.1);
        } else if (attribute === "Speed" || attribute === "Speed 2") {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Rash":
        // SPATK erhöht, SPDEF verringert
        if (
          attribute === "Special Attack" ||
          attribute === "Special Attack 2"
        ) {
          result = Math.floor(result * 1.1);
        } else if (
          attribute === "Special Defense" ||
          attribute === "Special Defense 2"
        ) {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Calm":
        // SPDEF erhöht, ATK verringert
        if (
          attribute === "Special Defense" ||
          attribute === "Special Defense 2"
        ) {
          result = Math.floor(result * 1.1);
        } else if (attribute === "Attack" || attribute === "Attack 2") {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Gently":
        // SPDEF erhöht, SPEED verringert
        if (
          attribute === "Special Defense" ||
          attribute === "Special Defense 2"
        ) {
          result = Math.floor(result * 1.1);
        } else if (attribute === "Speed" || attribute === "Speed 2") {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Sassy":
        // SPDEF erhöht, SPATK verringert
        if (
          attribute === "Special Defense" ||
          attribute === "Special Defense 2"
        ) {
          result = Math.floor(result * 1.1);
        } else if (
          attribute === "Special Attack" ||
          attribute === "Special Attack 2"
        ) {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Careful":
        // SPDEF erhöht, SPATK verringert
        if (
          attribute === "Special Defense" ||
          attribute === "Special Defense 2"
        ) {
          result = Math.floor(result * 1.1);
        } else if (
          attribute === "Special Attack" ||
          attribute === "Special Attack 2"
        ) {
          result = Math.floor(result * 0.9);
        }
        break;
      case "Quirky":
        // Keine Änderungen, da neutral
        break;
      default:
        break;
    }
  }

  // Aktualisiere das Ergebnis-Element
  document.getElementById(resultElementId).textContent = result;
}

function initializeCalculations() {
  handleEmptyInputs();
  const level = parseInt(document.getElementById("level").value);
  const level2 = parseInt(document.getElementById("level2").value);
  const nature1 = document.getElementById("natureSelect1").value;
  const nature2 = document.getElementById("natureSelect2").value;

  const attributes = [
    {
      name: "HP",
      baseFieldId: "HPBaseStat",
      ivFieldId: "HPIV",
      evFieldId: "HPEV",
      resultElementId: "resultHP",
      level: level,
      nature: nature1,
    },
    {
      name: "Attack",
      baseFieldId: "AtkBaseStat",
      ivFieldId: "AtkIV",
      evFieldId: "AtkEV",
      resultElementId: "resultAtk",
      level: level,
      nature: nature1,
    },
    {
      name: "Defense",
      baseFieldId: "DefBaseStat",
      ivFieldId: "DefIV",
      evFieldId: "DefEV",
      resultElementId: "resultDef",
      level: level,
      nature: nature1,
    },
    {
      name: "Special Attack",
      baseFieldId: "SpABaseStat",
      ivFieldId: "SpAIV",
      evFieldId: "SpAEV",
      resultElementId: "resultSpA",
      level: level,
      nature: nature1,
    },
    {
      name: "Special Defense",
      baseFieldId: "SpDBaseStat",
      ivFieldId: "SpDIV",
      evFieldId: "SpDEV",
      resultElementId: "resultSpD",
      level: level,
      nature: nature1,
    },
    {
      name: "Speed",
      baseFieldId: "SpeBaseStat",
      ivFieldId: "SpeIV",
      evFieldId: "SpeEV",
      resultElementId: "resultSpe",
      level: level,
      nature: nature1,
    },
    {
      name: "HP 2",
      baseFieldId: "HPBaseStat2",
      ivFieldId: "HPIV2",
      evFieldId: "HPEV2",
      resultElementId: "resultHP2",
      level: level2,
      nature: nature2,
    },
    {
      name: "Attack 2",
      baseFieldId: "AtkBaseStat2",
      ivFieldId: "AtkIV2",
      evFieldId: "AtkEV2",
      resultElementId: "resultAtk2",
      level: level2,
      nature: nature2,
    },
    {
      name: "Defense 2",
      baseFieldId: "DefBaseStat2",
      ivFieldId: "DefIV2",
      evFieldId: "DefEV2",
      resultElementId: "resultDef2",
      level: level2,
      nature: nature2,
    },
    {
      name: "Special Attack 2",
      baseFieldId: "SpABaseStat2",
      ivFieldId: "SpAIV2",
      evFieldId: "SpAEV2",
      resultElementId: "resultSpA2",
      level: level2,
      nature: nature2,
    },
    {
      name: "Special Defense 2",
      baseFieldId: "SpDBaseStat2",
      ivFieldId: "SpDIV2",
      evFieldId: "SpDEV2",
      resultElementId: "resultSpD2",
      level: level2,
      nature: nature2,
    },
    {
      name: "Speed 2",
      baseFieldId: "SpeBaseStat2",
      ivFieldId: "SpeIV2",
      evFieldId: "SpeEV2",
      resultElementId: "resultSpe2",
      level: level2,
      nature: nature2,
    },
  ];

  attributes.forEach((attr) => {
    calculateAttributeStat(
      attr.name,
      attr.baseFieldId,
      attr.ivFieldId,
      attr.evFieldId,
      attr.resultElementId,
      attr.level,
      attr.nature
    );
  });
}

function updateNature(selectId) {
  const selectedNature = document.getElementById(selectId).value;

  // Setze das Wesen entsprechend
  setNature(selectId, selectedNature);
  initializeCalculations();
}

function setNature(selectId, selectedNature) {
  const selectElement = document.getElementById(selectId);
  const options = selectElement.options;
  for (let i = 0; i < options.length; i++) {
    if (options[i].value === selectedNature) {
      options[i].selected = true;
    } else {
      options[i].selected = false;
    }
  }
}

function updatePokemon() {
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
    "ability2select"
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
    "ability1select"
  );
}

function handleEmptyInput(inputElement) {
  if (!inputElement.id === "level" && inputElement.value === "") {
    inputElement.value = "0";
  } else if (inputElement.id === "level" && inputElement.value === "") {
    inputElement.value = "1";
  }
}

function handleEmptyInputs() {
  const inputElements = document.querySelectorAll("input[type=number]");
  inputElements.forEach((input) => {
    input.addEventListener("input", function () {
      handleEmptyInput(input);
    });
  });
}

document.addEventListener("input", function (event) {
  const targetId = event.target.id;
  if (
    targetId.startsWith("level") ||
    targetId.endsWith("EV") ||
    targetId.endsWith("IV") ||
    targetId.endsWith("BaseStat")
  ) {
    initializeCalculations();
  }
});
