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
  