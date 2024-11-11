<?php
session_start();

// Initialize player stats if starting a new game
if (!isset($_SESSION['player'])) {
    $_SESSION['player'] = [
        'health' => 100,
        'max_health' => 100,
        'strength' => 15,
        'experience' => 0,
        'inventory' => ['Sword', 'Healing Potion'],
        'location' => 'Village',
        'alive' => true, // Track if the player is alive
        'battles_fought' => 0 // Track the number of battles
    ];
}

$player = &$_SESSION['player'];
$action = isset($_GET['action']) ? $_GET['action'] : 'start';

// Function to display player stats
function displayStats() {
    global $player;
    echo "<div class='stats'><h2>Player Stats</h2>";
    echo "<p>Health: " . $player['health'] . " / " . $player['max_health'] . "</p>";
    echo "<p>Strength: " . $player['strength'] . "</p>";
    echo "<p>Experience: " . $player['experience'] . "</p>";
    echo "<p>Inventory: " . implode(", ", $player['inventory']) . "</p>";
    echo "<p>Battles Fought: " . $player['battles_fought'] . "</p>";
    echo "</div>";
}

// Function to randomly select a monster background image
function getRandomMonsterBackground() {
    $monsterImages = ['monster1.jpg', 'monster2.jpg', 'monster3.jpg'];
    return $monsterImages[array_rand($monsterImages)];
}

// Function to handle monster encounter with randomized damage
function encounterMonster() {
    global $player;
    $damage = rand(10, 30); // Random damage between 10 and 30
    $player['health'] -= $damage;
    $player['experience'] += 10; // Gain experience per encounter
    $player['battles_fought'] += 1; // Increment battles fought

    // Check if player has died
    if ($player['health'] <= 0) {
        $player['health'] = 0;
        $player['alive'] = false;
        return "<p>You were defeated by the monster and took $damage damage. You have died.</p><a href='index.php' class='button'>Start Over</a>";
    }

    return "<p>You fought a monster and took $damage damage. Your current health is {$player['health']}.</p>";
}

// Handle different actions based on the player's choice
if ($player['alive']) { // Check if player is alive before processing actions
    if ($action == 'start') {
        // Start in the village
        $player['location'] = 'Village';
        echo "<p>Welcome to the village, Sir Alaric! Prepare for your journey.</p>";
        echo "<a href='game.php?action=explore' class='button'>Go to Forest</a>";
    } elseif ($action == 'explore') {
        // Entering the forest
        $player['location'] = 'Forest';
        echo "<p>You venture into the eerie forest. Shadows loom, and danger lies ahead.</p>";
        echo "<a href='game.php?action=continue_exploring' class='button'>Continue Exploring</a>";
        echo "<a href='game.php?action=village' class='button'>Return to Village</a>";
    } elseif ($action == 'continue_exploring') {
        if ($player['battles_fought'] >= 5) {
            // Trigger the final battle with the dragon after 5 battles
            $player['location'] = 'Dragon Encounter';
            echo "<p>A mighty dragon appears before you as the final challenge! Do you wish to flee or fight?</p>";
            echo "<a href='game.php?action=final_battle' class='button'>Fight the Dragon</a>";
            echo "<a href='game.php?action=village' class='button'>Flee to Village</a>";
        } else {
            // Normal monster encounter
            $player['location'] = 'Monster Encounter';
            $background = getRandomMonsterBackground();
            echo "<style>body { background: url('$background') no-repeat center center/cover; }</style>";
            echo encounterMonster();
            echo "<a href='game.php?action=continue_exploring' class='button'>Continue Exploring</a>";
            echo "<a href='game.php?action=village' class='button'>Return to Village</a>";
        }
    } elseif ($action == 'village') {
        $player['location'] = 'Village';
        $player['health'] = $player['max_health']; // Automatically heal to full health in the village
        echo "<p>You have returned to the village. Your health is fully restored.</p>";
        echo "<a href='game.php?action=explore' class='button'>Go to Forest</a>";
    } elseif ($action == 'final_battle') {
        // Battle with the dragon
        $damage = rand(30, 50); // Dragon deals more damage
        $player['health'] -= $damage;

        if ($player['health'] > 0) {
            echo "<p>You fought bravely and defeated the dragon! Victory is yours.</p>";
            echo "<a href='index.php' class='button'>Play Again</a>";
            session_destroy(); // End game after victory
        } else {
            $player['health'] = 0;
            $player['alive'] = false;
            echo "<p>The dragon was too powerful. You have perished.</p><a href='index.php' class='button'>Start Over</a>";
            session_destroy(); // End game on defeat
        }
    }
}

// Set background based on location
if ($player['location'] == 'Village') {
    $background = 'village.jpg';
} elseif ($player['location'] == 'Forest') {
    $background = 'forrest.jpg';
} elseif ($player['location'] == 'Dragon Encounter') {
    $background = 'dragon.jpg';
} elseif ($player['location'] == 'Monster Encounter') {
    $background = getRandomMonsterBackground();
} else {
    $background = 'default.jpg'; // Default background if none is set
}

echo "<style>body { background: url('$background') no-repeat center center/cover; }</style>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dragon Slayer Quest</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="game-container">
        <h2><?php echo $player['location']; ?></h2>
        
        <?php
        if ($player['alive']) { // Show options only if player is alive
            if ($player['location'] == 'Village') {
                echo "<p>You are in the village, where your journey begins. Your health has been restored to {$player['max_health']}.</p>";
                echo "<a href='game.php?action=explore' class='button'>Go to Forest</a>";
            }
        } else {
            echo "<p>Your journey ends here, brave knight. You have fallen.</p><a href='index.php' class='button'>Start Over</a>";
        }
        
        displayStats();
        ?>
    </div>
</body>
</html>
