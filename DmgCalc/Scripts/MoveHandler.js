async function updateMoveResults(prefix) {

    const moveIds = [];
    for (let i = 1; i <= 4; i++) {
      const selectedMoveId = parseInt(
        document.getElementById( "pokemon" + prefix + "move" + i).value
      );
      moveIds.push(selectedMoveId);
    }
  
    const responses = await Promise.all(
      moveIds.map((moveId) => fetch(`Scripts/getmovesdetails.php?id=${moveId}`))
    );
    const moveDatas = await Promise.all(
      responses.map((response) => response.json())
    );
  
    for (let i = 1; i <= 4; i++) {
      const resultElementId = prefix + "resultmovedmg" + i;
      document.getElementById(resultElementId).textContent =
        moveDatas[i - 1].Power;
    }
  }
  
  async function moves() {
    await updateMoveResults("1");
    await updateMoveResults("2");
  }
  
  function selectOptionByName(name, prefix, move) {
    // debugger;
    var options = document.getElementById("pokemon" + prefix + "move" + move).options;
    for (var i = 0; i < options.length; i++) {
        if (options[i].text === name) {
            options[i].selected = true;
            break;
        }
      }
      setCheckboxAndTriggerChange(prefix + "resultmovedmg" + move + "Crit");
}
