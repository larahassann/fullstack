<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Band Name and Genre Input</title>
    <link rel="stylesheet" href="style.css?v=1.0">

</head>
<body>
<div class="header">
<a href="index.php"><h2 class="header-item" id="band" >Bands</h2></a>
    <a href="events.php"><h2 class="header-item" id="event">Events</h2></a>
    <a href="bandevent.php"><h2 class="header-item" id="bandevent" >Koppelen</h2></a>
    <a href="homepage.php"><h2  class="header-item" id="home">Home pagina</h2></a>
</div>

        <div class="container">
    <h2>voeg hier uw  bandnaam en genre</h2>
    <form action="index.php" method="post">
        <div>
            <label for="band_name">Band Name:</label>
            <input type="text" id="band_name" name="band" required>
        </div>
        <div>
            <label for="music-genre">Genre:</label>
            <br>
            <select id="music-genre" name="genre" required>
                <option value="Rock">Rock</option>
                <option value="Hiphop">Hiphop</option>
                <option value="Rap">Rap</option>
                <option value="RnB">RnB</option>
                <option value="Jazz">Jazz</option>
                <option value="Techno">Techno</option>
                <option value="Pop">Pop</option>
            </select>
        </div>
        <div>
            <input type="submit" name="submit_band" value="Add Band">
        </div>
    </form>
    
   

</body>
</html>
<?php
require('database.php');
$conn->select_db("fullstack");
if (isset($_POST['submit_band'])) {
    // als er op submit is geklikt word de onderstaande code uitgevoerd
    $bandnaam = $_POST['band']; // pakt alle ingevulde waardes en slaat op in de variable
    $genre = $_POST['genre']; //  pakt alle ingevulde waardes en slaat op in de variable


// prepare statement met ?? als placeholders zodat wat er ingevoerd dat het dan in de tabel bands komt te staan
$sql= $conn->prepare ("INSERT INTO bands (namen,genre) VALUES (?,?) ");
$sql->bind_param("ss", $bandnaam,$genre); // prepare heb ik parameters gegeven zoals string,string
$sql->execute(); // dit voert de prepared statement uit die je daarboven hebt gemaakt met de ingevulde parameters
echo"$bandnaam,$genre<br>";}
// dit print hij uit met echo
?>
