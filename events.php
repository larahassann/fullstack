<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>events</title>
    <link rel="stylesheet" href="style.css?v=1.0">

</head>
<body>
<div class="header">
    <a href="index.php"><h2 class="header-item" id="band" >bands</h2></a>
    <a href="events.php"><h2 class="header-item" id="event">events</h2></a>
    <a href="bandevent.php"><h2 class="header-item" id="bandevent" >koppelen</h2></a>
    <a href="homepage.php"><h2  class="header-item" id="home">home pagina</h2></a>

</div>
<div class="containers">
        <h1>Events</h1>
    <form action="events.php" method="post">
      <div class="events">
        <input type="text" id="eventname" name="eventname" placeholder= "Event name....">
        <input type="price" id="price" name="price" placeholder= "Prijs....">
        <input type="date" id="datum" name="datum" placeholder= "Datum....">
        <input type="time" id="time" name="time" placeholder= "time....">
        <input id="submit" type="submit" name="submit" value="Submit">
    </form>
</div>
</div>



</body>
</html>
<?php
require('database.php');
$conn->select_db("fullstack");
if (isset($_POST['submit'])) {
    //als er op submit is geklikt voert hij de code onderin uit


    //php code die de waarde uit de ingevulde html formulier en slaat op in variabele
    $event_name = $_POST['eventname']; // haalt alle waardes op wat er is ingevuld op eventname
    $event_price = $_POST['price']; // haallt alle waardes op die is ingevuld bij price
    $event_date = $_POST['datum']; // haalt alle waardes op die is ingevuld bij datum
    $event_time = $_POST['time']; // haalt alle waardes op die is ingevuld bij time

 
   
// deze query probeert de kolom uit events te vullen naam_event`, `prijs_event`, `datum_event`, `time_event met de placeholders ???? dus de waarde die is ingevoerd door de gebruiker
    $sql = $conn->prepare("INSERT INTO events (`naam_event`, `prijs_event`, `datum_event`, `time_event`) VALUES (?,?,?,?)");
    $sql->bind_param("siss", $event_name,$event_price,$event_date,$event_time); //values een waarde gegeven string,int,string,string
    $sql->execute(); // dit voert de prepared statement uit die je daarboven hebt gemaakt met de ingevulde parameters
        echo "$event_name, $event_price, $event_date, $event_time";
        //dat word dan uitgeprint met echo
}
      ?>
