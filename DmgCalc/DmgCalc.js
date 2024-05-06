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

// Funktion zum Anwenden von Berechnungen auf ein bestimmtes Attribut
function calculateAttributeStat(
  attribute,
  baseFieldId,
  ivFieldId,
  evFieldId,
  resultElementId,
  level
) {
  const baseStat = parseInt(document.getElementById(baseFieldId).value);
  const iv = parseInt(document.getElementById(ivFieldId).value);
  const ev = parseInt(document.getElementById(evFieldId).value);

  // Initialisieren der Variablen `result` im Funktions-Scope
  let result;

  if (attribute == "HP" || attribute == "HP 2") {
    result = CalcHP(baseStat, iv, ev, level);
  } else {
    result = calcStat(baseStat, iv, ev, level);
  }

  document.getElementById(resultElementId).textContent = result;
}

// Funktion zum Initialisieren der Berechnungen
function initializeCalculations() {
  handleEmptyInputs();
  const level = parseInt(document.getElementById("level").value);
  const level2 = parseInt(document.getElementById("level2").value);

  const attributes = [
    {
      name: "HP",
      baseFieldId: "HPBaseStat",
      ivFieldId: "HPIV",
      evFieldId: "HPEV",
      resultElementId: "resultHP",
      level: level,
    },
    {
      name: "Attack",
      baseFieldId: "AtkBaseStat",
      ivFieldId: "AtkIV",
      evFieldId: "AtkEV",
      resultElementId: "resultAtk",
      level: level,
    },
    {
      name: "Defense",
      baseFieldId: "DefBaseStat",
      ivFieldId: "DefIV",
      evFieldId: "DefEV",
      resultElementId: "resultDef",
      level: level,
    },
    {
      name: "Special Attack",
      baseFieldId: "SpABaseStat",
      ivFieldId: "SpAIV",
      evFieldId: "SpAEV",
      resultElementId: "resultSpA",
      level: level,
    },
    {
      name: "Special Defense",
      baseFieldId: "SpDBaseStat",
      ivFieldId: "SpDIV",
      evFieldId: "SpDEV",
      resultElementId: "resultSpD",
      level: level,
    },
    {
      name: "Speed",
      baseFieldId: "SpeBaseStat",
      ivFieldId: "SpeIV",
      evFieldId: "SpeEV",
      resultElementId: "resultSpe",
      level: level,
    },
    {
      name: "HP 2",
      baseFieldId: "HPBaseStat2",
      ivFieldId: "HPIV2",
      evFieldId: "HPEV2",
      resultElementId: "resultHP2",
      level: level2,
    },
    {
      name: "Attack 2",
      baseFieldId: "AtkBaseStat2",
      ivFieldId: "AtkIV2",
      evFieldId: "AtkEV2",
      resultElementId: "resultAtk2",
      level: level2,
    },
    {
      name: "Defense 2",
      baseFieldId: "DefBaseStat2",
      ivFieldId: "DefIV2",
      evFieldId: "DefEV2",
      resultElementId: "resultDef2",
      level: level2,
    },
    {
      name: "Special Attack 2",
      baseFieldId: "SpABaseStat2",
      ivFieldId: "SpAIV2",
      evFieldId: "SpAEV2",
      resultElementId: "resultSpA2",
      level: level2,
    },
    {
      name: "Special Defense 2",
      baseFieldId: "SpDBaseStat2",
      ivFieldId: "SpDIV2",
      evFieldId: "SpDEV2",
      resultElementId: "resultSpD2",
      level: level2,
    },
    {
      name: "Speed 2",
      baseFieldId: "SpeBaseStat2",
      ivFieldId: "SpeIV2",
      evFieldId: "SpeEV2",
      resultElementId: "resultSpe2",
      level: level2,
    },
  ];

  attributes.forEach((attr) => {
    calculateAttributeStat(
      attr.name,
      attr.baseFieldId,
      attr.ivFieldId,
      attr.evFieldId,
      attr.resultElementId,
      attr.level
    );
  });
}


// Event-Handler für Eingabefelder
document.addEventListener("input", function (event) {
  const targetId = event.target.id;
  if (
    targetId.startsWith("level")||
    targetId.endsWith("EV") ||
    targetId.endsWith("IV") ||
    targetId.endsWith("BaseStat")
  ) {
    initializeCalculations();
  }
});

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

function bodyload() {
  updatePokemonSelection2();
  updatePokemonSelection();
  initializeCalculations();
  moves();
}

async function updatePokemonSelection() {
  debugger;
  const pokemonId = parseInt(document.getElementById("pokemonSelect").value);

  try {
    const response = await fetch(
      `get_pokemon_details.php?pokemon_id=${pokemonId}`
    );
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    const pokemonData = await response.json();
    console.log(pokemonData);
    document.getElementById("HPBaseStat").value = pokemonData.HPBase;
    document.getElementById("HPEV").value = pokemonData.hpEV;
    document.getElementById("HPIV").value = pokemonData.hpIV;
    document.getElementById("AtkBaseStat").value = pokemonData.AtkBase;
    document.getElementById("AtkEV").value = pokemonData.atkEV;
    document.getElementById("AtkIV").value = pokemonData.atkIV;

    document.getElementById("DefBaseStat").value = pokemonData.DefBase;
    document.getElementById("DefEV").value = pokemonData.defEV;
    document.getElementById("DefIV").value = pokemonData.defIV;

    document.getElementById("SpABaseStat").value = pokemonData.SpABase;
    document.getElementById("SpAEV").value = pokemonData.spAtkEV;
    document.getElementById("SpAIV").value = pokemonData.spAtkIV;

    document.getElementById("SpDBaseStat").value = pokemonData.SpDBase;
    document.getElementById("SpDEV").value = pokemonData.spDefEV;
    document.getElementById("SpDIV").value = pokemonData.spDefIV;

    document.getElementById("SpeBaseStat").value = pokemonData.SpeBase;
    document.getElementById("SpeEV").value = pokemonData.speedEV;
    document.getElementById("SpeIV").value = pokemonData.speedIV;
    initializeCalculations();
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}
  async function updatePokemonSelection2() {
    const pokemonId = parseInt(document.getElementById("pokemonSelect2").value);
  
    try {
      const response = await fetch(
        `get_pokemon_details.php?pokemon_id=${pokemonId}`
      );
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      const pokemonData = await response.json();
      console.log(pokemonData);
      document.getElementById("HPBaseStat2").value = pokemonData.HPBase;
      document.getElementById("HPEV2").value = pokemonData.hpEV;
      document.getElementById("HPIV2").value = pokemonData.hpIV;
      document.getElementById("AtkBaseStat2").value = pokemonData.AtkBase;
      document.getElementById("AtkEV2").value = pokemonData.atkEV;
      document.getElementById("AtkIV2").value = pokemonData.atkIV;
  
      document.getElementById("DefBaseStat2").value = pokemonData.DefBase;
      document.getElementById("DefEV2").value = pokemonData.defEV;
      document.getElementById("DefIV2").value = pokemonData.defIV;
  
      document.getElementById("SpABaseStat2").value = pokemonData.SpABase;
      document.getElementById("SpAEV2").value = pokemonData.spAtkEV;
      document.getElementById("SpAIV2").value = pokemonData.spAtkIV;
  
      document.getElementById("SpDBaseStat2").value = pokemonData.SpDBase;
      document.getElementById("SpDEV2").value = pokemonData.spDefEV;
      document.getElementById("SpDIV2").value = pokemonData.spDefIV;
  
      document.getElementById("SpeBaseStat2").value = pokemonData.SpeBase;
      document.getElementById("SpeEV2").value = pokemonData.speedEV;
      document.getElementById("SpeIV2").value = pokemonData.speedIV;
      initializeCalculations();
    } catch (error) {
      console.error("Error fetching data:", error);
    }
}

async function moves() {
  // Alle ausgewählten Move-IDs abrufen
  const moveIds = [];
  for (let i = 1; i <= 4; i++) {
      const selectedMoveId = parseInt(document.getElementById('pokemon2move' + i).value);
      moveIds.push(selectedMoveId);
  }

  // Alle Move-Daten abrufen
  const responses = await Promise.all(moveIds.map(moveId => fetch(`getmovesdetails.php?id=${moveId}`)));
  const moveDatas = await Promise.all(responses.map(response => response.json()));

  // Alle Ergebnis-Elemente aktualisieren
  for (let i = 1; i <= 4; i++) {
      const resultElementId = 'resultmovedmg' + i;
      document.getElementById(resultElementId).textContent = moveDatas[i - 1].Power;
  }

  console.log(moveDatas);
}
