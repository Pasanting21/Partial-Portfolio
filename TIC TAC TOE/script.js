const board = document.getElementById("board");
    const statusText = document.getElementById("status");
  let currentPlayer = "X";
  let gameActive = true;
  let gameState = ["", "", "", "", "", "", "", "", ""];
  let scoreX = 0;
  let scoreO = 0;
  const scoreXText = document.getElementById("scoreX");
  const scoreOText = document.getElementById("scoreO");
    const winningConditions = [
      [0,1,2],[3,4,5],[6,7,8], // rows
      [0,3,6],[1,4,7],[2,5,8], // columns
      [0,4,8],[2,4,6]          // diagonals
    ];
    function createBoard() {
      board.innerHTML = "";
      gameState = ["", "", "", "", "", "", "", "", ""];
      gameActive = true;
      currentPlayer = "X";
      statusText.textContent = "Player X's turn";
      for (let i = 0; i < 9; i++) {
        const cell = document.createElement("div");
        cell.classList.add("cell");
        cell.setAttribute("data-index", i);
        cell.addEventListener("click", handleCellClick);
        cell.style.opacity = 0;
        board.appendChild(cell);
        setTimeout(() => { cell.style.opacity = 1; }, 60 * i);
      }
    }
    function handleCellClick(e) {
      const index = e.target.getAttribute("data-index");
      if (gameState[index] !== "" || !gameActive) return;
      gameState[index] = currentPlayer;
      e.target.textContent = currentPlayer;
      e.target.classList.add("taken");
      e.target.style.color = currentPlayer === "X" ? "#0a74da" : "#e85d04";
      checkWinner();
    }
    function checkWinner() {
      let roundWon = false;
      let winCombo = null;
      for (let condition of winningConditions) {
        const [a, b, c] = condition;
        if (gameState[a] && gameState[a] === gameState[b] && gameState[a] === gameState[c]) {
          roundWon = true;
          winCombo = [a, b, c];
          break;
        }
      }
      if (roundWon) {
        statusText.textContent = `Player ${currentPlayer} Wins! 🎉`;
        gameActive = false;
        if (currentPlayer === "X") {
          scoreX++;
          scoreXText.textContent = `Player X: ${scoreX}`;
        } else {
          scoreO++;
          scoreOText.textContent = `Player O: ${scoreO}`;
        }
        // Highlight winning cells
        if (winCombo) {
          for (let idx of winCombo) {
            board.children[idx].classList.add("win");
          }
        }
        return;
      }
      if (!gameState.includes("")) {
        statusText.textContent = "It's a Draw! 🤝";
        gameActive = false;
        return;
      }
      currentPlayer = currentPlayer === "X" ? "O" : "X";
      statusText.textContent = `Player ${currentPlayer}'s turn`;
    }
    function resetBoard() {
      createBoard();
    }

    function resetScore() {
      scoreX = 0;
      scoreO = 0;
      scoreXText.textContent = `Player X: 0`;
      scoreOText.textContent = `Player O: 0`;
    }
    createBoard();