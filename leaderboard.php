<?php
// Mock data for leaderboard
$leaderboard = [
  ["username" => "KnightLance", "xp" => 120, "health" => 80, "gold" => 200],
  ["username" => "DragonSlayer", "xp" => 200, "health" => 90, "gold" => 150],
  ["username" => "MageMystic", "xp" => 150, "health" => 60, "gold" => 250]
];

echo "<table>";
echo "<tr><th>Username</th><th>XP</th><th>Health</th><th>Gold</th></tr>";
foreach ($leaderboard as $player) {
  echo "<tr><td>{$player['username']}</td><td>{$player['xp']}</td><td>{$player['health']}</td><td>{$player['gold']}</td></tr>";
}
echo "</table>";
?>
