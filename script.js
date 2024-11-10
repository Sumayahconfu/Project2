// Initial player stats
let xp = 0;
let health = 100;
let gold = 50;

// Display initial player stats
document.getElementById("xpText").innerText = xp;
document.getElementById("healthText").innerText = health;
document.getElementById("goldText").innerText = gold;

// Mock leaderboard data
const leaderboardData = [
  { username: "DragonSlayer", xp: 1200, health: 80, gold: 150, rank: 1 },
  { username: "KnightRider", xp: 1100, health: 70, gold: 200, rank: 2 },
  { username: "MageMaster", xp: 1050, health: 60, gold: 120, rank: 3 },
  { username: "Swordsmith", xp: 950, health: 50, gold: 90, rank: 4 },
  { username: "ShieldBearer", xp: 850, health: 40, gold: 60, rank: 5 },
  { username: "ArcherQueen", xp: 800, health: 45, gold: 70, rank: 6 },
  { username: "StealthNinja", xp: 750, health: 65, gold: 100, rank: 7 },
  { username: "WarriorPrince", xp: 700, health: 55, gold: 110, rank: 8 }
];

// Function to display leaderboard data
function displayLeaderboard() {
  const leaderboardContainer = document.getElementById('leaderboard');

  leaderboardData.forEach(player => {
    const playerRow = document.createElement('div');
    playerRow.classList.add('player-row');

    playerRow.innerHTML = `
      <span class="rank">#${player.rank}</span>
      <span class="username">${player.username}</span>
      <span class="xp">XP: ${player.xp}</span>
      <span class="health">Health: ${player.health}</span>
      <span class="gold">Gold: ${player.gold}</span>
    `;

    leaderboardContainer.appendChild(playerRow);
  });
}

// Displays the leaderboard on page load
window.onload = displayLeaderboard;

// Example of a function that updates main player stats
function updateStats(newXp, newHealth, newGold) {
  xp += newXp;
  health += newHealth;
  gold += newGold;
  
  document.getElementById("xpText").innerText = xp;
  document.getElementById("healthText").innerText = health;
  document.getElementById("goldText").innerText = gold;
}
