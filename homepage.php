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
    <a href="index.php" class="header-item" id="band">bands</a>
    <a href="events.php" class="header-item" id="event">events</a>
    <a href="bandevent.php" class="header-item" id="bandevent">koppelen</a>
    <a href="homepage.php" class="header-item" id="home">home pagina</a>
</div>


    <?php
    require('database.php');
    $query = $conn->query("
        SELECT 
            events.naam_event AS eventname, 
            GROUP_CONCAT(bands.namen SEPARATOR ', ') AS bands, 
            events.prijs_event AS price, 
            events.time_event AS time, 
            events.datum_event AS datum
        FROM bands_has_events
        INNER JOIN events ON bands_has_events.events_idevents = events.idevents
        INNER JOIN bands ON bands_has_events.bands_idbands = bands.idbands
        GROUP BY events.naam_event, events.prijs_event, events.time_event, events.datum_event
        ");
// events.naam_event AS eventname, haalt alle namen van de eventen op
//GROUP_CONCAT(bands.namen SEPARATOR ', ') AS bands, laat alle bandnamen zien met een , 
//events.prijs_event AS price, haalt alle prijzen op
//events.time_event AS time, haalt alle tijden op
//events.datum_event AS datum haalt alle datums op
//FROM bands_has_events haalt alle gegevens op van die tabel
//INNER JOIN events ON bands_has_events.events_idevents = events.idevents bands_has_events wordt gekoppeld aan de tabel events via de kolom events_idevents
//GROUP BY hiermee word alles gegroepeerd naam event prijs tijd en datum
if ($query->num_rows > 0) { // haalt alle waardes op uit de rijen die groter zijn dan 0 
            echo "<h2>Gekoppelde bands en evenementen</h2>";

            echo "<table border='1'>
                    <tr> 
                        <th>Eventnaam</th>
                        <th>Bands</th>
                        <th>Tijd</th>
                        <th>Datum</th>
                        <th>Prijs (€)</th>
                    </tr>";

            while ($row = $query->fetch_assoc()) { // dit is een assosiative array en je kan mett de $row een specifieke sleutel openen zoals datum bijv 
                // gaat langs elke rij 
                //$query->fetch_assoc dit haalt een rij resultaten van de sql query resultaten die is uitgevoerd
                // tot aan de laatste rij gaat het door dan toont de fetch false en stopt het
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['eventname']) . "</td>"; // toont de event name van event
                echo "<td>" . htmlspecialchars($row['bands']) . "</td>"; // toont de bands naam meerdere van event
                echo "<td>" . htmlspecialchars($row['time']) . "</td>"; // toont de tijd van event
                echo "<td>" . htmlspecialchars($row['datum']) . "</td>"; // toont de datum van event
                echo "<td>€" . htmlspecialchars($row['price']) . "</td>"; // toont de prijs van event
                echo "</tr>";
            } // hier word een tabel gemaakt en mocht er weer iets ingevuld worden dan komt er een nieuwe tabel kolom 

            echo "</table>"; 
        } else {
            echo "<p>Geen gekoppelde bands en evenementen gevonden</p>";
        }

   ?>