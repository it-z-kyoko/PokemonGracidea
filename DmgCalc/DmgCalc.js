// Definieren Sie die pokemon-Variable im globalen Bereich
var pokemon;

// Rufen Sie das Pokemon-Objekt mit JavaScript ab
fetch("pokemon_data.php")
  .then((response) => response.json())
  .then((data) => {
    pokemon = data;

    console.log(pokemon);
  })
  .catch((error) => console.error("Error fetching Pokemon data:", error));

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

function berechne() {
  let inputFeld = document.getElementById("HPEV");
  let HpEvValue = parseInt(inputFeld.value);

  // Prüfen, ob die pokemon-Variable definiert ist, bevor sie verwendet wird
  if (pokemon) {
    pokemon.hpEV = parseInt(HpEvValue);
    pokemon.atkEv = parseInt(AtkEvValue);

    // Hier kann das Pokemon-Objekt verwendet werden
    console.log(pokemon);

    let result = calcStat(140, 31, 254, 60);

    document.getElementById("resultAtk").textContent = result;
  }
}

function CalcHPStat() {
  let HPInputEV = document.getElementById("HPEV");
  let HPEVValue = HPInputEV.value;

  let HPIVInputField = document.getElementById("HPIV");
  let HPIVValue = parseInt(HPIVInputField.value);

  let HPBaseField = document.getElementById("HPBaseStat");
  let HPBaseValue = parseInt(HPBaseField.value);

  let levelField = document.getElementById("level");
  let level = parseInt(levelField.value);

  if (pokemon) {
    console.log(pokemon);
    console.log("EV: " + HPEVValue);
    console.log("IV: " + HPIVValue);
    console.log("Level: " + level);
    console.log("Base: " + HPBaseValue);

    let result = CalcHP(HPBaseValue, HPIVValue, HPEVValue, level);

    document.getElementById("resultHP").textContent = result;
  }
}

function CalcAtkStat() {
  let AtkEVInputField = document.getElementById("AtkEV");
  let AtkEVValue = parseInt(AtkEVInputField.value);

  let AtkIVInputField = document.getElementById("AtkIV");
  let AtkIVValue = parseInt(AtkIVInputField.value);

  let AtkBaseField = document.getElementById("AtkBaseStat");
  let AtkBaseValue = parseInt(AtkBaseField.value);

  let LevelField = document.getElementById("level");
  let level = parseInt(LevelField.value);

  if (pokemon) {
    console.log(pokemon);
    console.log("EV: " + AtkEVValue);
    console.log("IV: " + AtkIVValue);
    console.log("Level: " + level);
    console.log("Base: " + AtkBaseValue);

    let result = calcStat(AtkBaseValue, AtkIVValue, AtkEVValue, level);

    document.getElementById("resultAtk").textContent = result;
  }
}

function CalcDefStat() {
  let DefEVInputField = document.getElementById("DefEV");
  let DefEVValue = parseInt(DefEVInputField.value);

  let DefIVInputField = document.getElementById("DefIV");
  let DefIVValue = parseInt(DefIVInputField.value);

  let DefBaseField = document.getElementById("DefBaseStat");
  let DefBaseValue = parseInt(DefBaseField.value);

  let LevelField = document.getElementById("level");
  let level = parseInt(LevelField.value);

  if (pokemon) {
    console.log(pokemon);
    console.log("EV: " + DefEVValue);
    console.log("IV: " + DefIVValue);
    console.log("Level: " + level);
    console.log("Base: " + DefBaseValue);

    let result = calcStat(DefBaseValue, DefIVValue, DefEVValue, level);

    document.getElementById("resultDef").textContent = result;
  }
}

function CalcSpAStat() {
  let SpAEVInputField = document.getElementById("SpAEV");
  let SpAEVValue = parseInt(SpAEVInputField.value);

  let SpAIVInputField = document.getElementById("SpAIV");
  let SpAIVValue = parseInt(SpAIVInputField.value);

  let SpABaseField = document.getElementById("SpABaseStat");
  let SpABaseValue = parseInt(SpABaseField.value);

  let LevelField = document.getElementById("level");
  let level = parseInt(LevelField.value);

  if (pokemon) {
    console.log(pokemon);
    console.log("EV: " + SpAEVValue);
    console.log("IV: " + SpAIVValue);
    console.log("Level: " + level);
    console.log("Base: " + SpABaseValue);

    let result = calcStat(SpABaseValue, SpAIVValue, SpAEVValue, level);

    document.getElementById("resultSpA").textContent = result;
  }
}

function CalcSpDStat() {
  let SpDEVInputField = document.getElementById("SpDEV");
  let SpDEVValue = parseInt(SpDEVInputField.value);

  let SpDIVInputField = document.getElementById("SpDIV");
  let SpDIVValue = parseInt(SpDIVInputField.value);

  let SpDBaseField = document.getElementById("SpDBaseStat");
  let SpDBaseValue = parseInt(SpDBaseField.value);

  let LevelField = document.getElementById("level");
  let level = parseInt(LevelField.value);

  if (pokemon) {
    console.log(pokemon);
    console.log("EV: " + SpDEVValue);
    console.log("IV: " + SpDIVValue);
    console.log("Level: " + level);
    console.log("Base: " + SpDBaseValue);

    let result = calcStat(SpDBaseValue, SpDIVValue, SpDEVValue, level);

    document.getElementById("resultSpD").textContent = result;
  }
}

function CalcSpeStat() {
  let SpeEVInputField = document.getElementById("SpeEV");
  let SpeEVValue = parseInt(SpeEVInputField.value);

  let SpeIVInputField = document.getElementById("SpeIV");
  let SpeIVValue = parseInt(SpeIVInputField.value);

  let SpeBaseField = document.getElementById("SpeBaseStat");
  let SpeBaseValue = parseInt(SpeBaseField.value);

  let LevelField = document.getElementById("level");
  let level = parseInt(LevelField.value);

  if (pokemon) {
    console.log(pokemon);
    console.log("EV: " + SpeEVValue);
    console.log("IV: " + SpeIVValue);
    console.log("Level: " + level);
    console.log("Base: " + SpeBaseValue);

    let result = calcStat(SpeBaseValue, SpeIVValue, SpeEVValue, level);

    document.getElementById("resultSpe").textContent = result;
  }
}

document.getElementById("HPEV").addEventListener("input", CalcHPStat);
document.getElementById("HPIV").addEventListener("input", CalcHPStat);
document.getElementById("AtkEV").addEventListener("input", CalcAtkStat);
document.getElementById("AtkIV").addEventListener("input", CalcAtkStat);
document.getElementById("DefEV").addEventListener("input", CalcDefStat);
document.getElementById("DefIV").addEventListener("input", CalcDefStat);
document.getElementById("SpAEV").addEventListener("input", CalcSpAStat);
document.getElementById("SpAIV").addEventListener("input", CalcSpAStat);
document.getElementById("SpDEV").addEventListener("input", CalcSpDStat);
document.getElementById("SpDIV").addEventListener("input", CalcSpDStat);
document.getElementById("SpeEV").addEventListener("input", CalcSpeStat);
document.getElementById("SpeIV").addEventListener("input", CalcSpeStat);

function bodyload() {
  debugger;
  let HPInputEV = document.getElementById("HPEV");
  let HPEVValue = HPInputEV.value;

  let HPIVInputField = document.getElementById("HPIV");
  let HPIVValue = parseInt(HPIVInputField.value);

  let HPBaseField = document.getElementById("HPBaseStat");
  let HPBaseValue = parseInt(HPBaseField.value);

  let levelField = document.getElementById("level");
  let level = parseInt(levelField.value);

  console.log("EV: " + HPEVValue);
  console.log("IV: " + HPIVValue);
  console.log("Level: " + level);
  console.log("Base: " + HPBaseValue);

  let resultHp = CalcHP(HPBaseValue, HPIVValue, HPEVValue, level);

  document.getElementById("resultHP").textContent = resultHp;

  let AtkEVInputField = document.getElementById("AtkEV");
  let AtkEVValue = parseInt(AtkEVInputField.value);

  let AtkIVInputField = document.getElementById("AtkIV");
  let AtkIVValue = parseInt(AtkIVInputField.value);

  let AtkBaseField = document.getElementById("AtkBaseStat");
  let AtkBaseValue = parseInt(AtkBaseField.value);

  console.log(pokemon);
  console.log("EV: " + AtkEVValue);
  console.log("IV: " + AtkIVValue);
  console.log("Level: " + level);
  console.log("Base: " + AtkBaseValue);

  let resultATK = calcStat(AtkBaseValue, AtkIVValue, AtkEVValue, level);

  document.getElementById("resultAtk").textContent = resultATK;

  let DefEVInputField = document.getElementById("DefEV");
  let DefEVValue = parseInt(DefEVInputField.value);

  let DefIVInputField = document.getElementById("DefIV");
  let DefIVValue = parseInt(DefIVInputField.value);

  let DefBaseField = document.getElementById("DefBaseStat");
  let DefBaseValue = parseInt(DefBaseField.value);

  console.log("EV: " + DefEVValue);
  console.log("IV: " + DefIVValue);
  console.log("Level: " + level);
  console.log("Base: " + DefBaseValue);

  let resultDef = calcStat(DefBaseValue, DefIVValue, DefEVValue, level);

  document.getElementById("resultDef").textContent = resultDef;
  let SpAEVInputField = document.getElementById("SpAEV");
  let SpAEVValue = parseInt(SpAEVInputField.value);

  let SpAIVInputField = document.getElementById("SpAIV");
  let SpAIVValue = parseInt(SpAIVInputField.value);

  let SpABaseField = document.getElementById("SpABaseStat");
  let SpABaseValue = parseInt(SpABaseField.value);

  console.log(pokemon);
  console.log("EV: " + SpAEVValue);
  console.log("IV: " + SpAIVValue);
  console.log("Level: " + level);
  console.log("Base: " + SpABaseValue);

  let resultSpA = calcStat(SpABaseValue, SpAIVValue, SpAEVValue, level);

  document.getElementById("resultSpA").textContent = resultSpA;

  let SpDEVInputField = document.getElementById("SpDEV");
  let SpDEVValue = parseInt(SpDEVInputField.value);

  let SpDIVInputField = document.getElementById("SpDIV");
  let SpDIVValue = parseInt(SpDIVInputField.value);

  let SpDBaseField = document.getElementById("SpDBaseStat");
  let SpDBaseValue = parseInt(SpDBaseField.value);

  console.log(pokemon);
  console.log("EV: " + SpDEVValue);
  console.log("IV: " + SpDIVValue);
  console.log("Level: " + level);
  console.log("Base: " + SpDBaseValue);

  let resultSpD = calcStat(SpDBaseValue, SpDIVValue, SpDEVValue, level);

  document.getElementById("resultSpD").textContent = resultSpD;

  let SpeEVInputField = document.getElementById("SpeEV");
  let SpeEVValue = parseInt(SpeEVInputField.value);

  let SpeIVInputField = document.getElementById("SpeIV");
  let SpeIVValue = parseInt(SpeIVInputField.value);

  let SpeBaseField = document.getElementById("SpeBaseStat");
  let SpeBaseValue = parseInt(SpeBaseField.value);

    console.log(pokemon);
    console.log("EV: " + SpeEVValue);
    console.log("IV: " + SpeIVValue);
    console.log("Level: " + level);
    console.log("Base: " + SpeBaseValue);

    let resultSpe = calcStat(SpeBaseValue, SpeIVValue, SpeEVValue, level);

    document.getElementById("resultSpe").textContent = resultSpe;
}
