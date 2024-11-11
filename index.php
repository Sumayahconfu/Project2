<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dragon Slayer Quest</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: url('title.jpg') no-repeat center center/cover;
        }
        /* Story Text Box Styling */
        .story-box {
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 20px;
            max-width: 600px;
            margin: 50px auto;
            border-radius: 8px;
            text-align: center;
        }
        .start-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e63946;
            color: #fff;
            font-size: 18px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="title-screen">
        <div class="overlay"></div>
        <h1 class="game-title">Dragon Slayer Quest</h1>
        <p class="tagline">Venture into the wild, confront your fears, and slay the dragon!</p>
        
        <!-- Story and Lore Text -->
        <div class="story-box">
            <h2>The Tale of Sir Alaric</h2>
            <p>
                In the ancient kingdom of Eldoria, legends speak of an immortal dragon, Zar’Thul, known as the Devourer. For centuries, this dragon has razed villages and consumed entire armies, spreading fear across the lands.
            </p>
            <p>
                A prophecy foretold of a brave knight with an iron heart and unyielding will who would rise to face Zar’Thul and end its reign of terror. Now, that knight is you, Sir Alaric.
            </p>
            <p>
                Armed with only a sword, you embark on a journey through haunted forests and desolate lands, strengthening yourself for the ultimate confrontation. Your quest begins in a small village where whispers of monsters fill the air.
            </p>
            <p>Will you fulfill the prophecy and free Eldoria from its dark fate?</p>
            <!-- Start Button -->
            <a href="game.php?action=village" class="start-button">Begin Adventure</a>
        </div>

        <!-- Background Music -->
        <audio autoplay loop>
            <source src="music.mp3" type="audio/mpeg">
            <source src="titlemusic.flac" type="audio/flac">
            Your browser does not support the audio element.
        </audio>
    </div>
</body>
</html>
