<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koppel je event met een band</title>
    <link rel="stylesheet" href="style.css?v=1.0">

</head>
<body>
    <div class="header">
    <a href="index.php" class="header-item" id="band">bands</a>
    <a href="events.php" class="header-item" id="event">events</a>
    <a href="bandevent.php" class="header-item" id="bandevent">koppelen</a>
    <a href="homepage.php" class="header-item" id="home">home pagina</a>
    </div>

    <div class="container">
        <h2>Koppel je event met een band</h2>
        
       
        <form action="bandevent.php" method="post">
            <div>
                <label for="event">Event:</label>
                <select name="event_id" required>
                    <option value="">Selecteer een event</option>
                    <?php
                    require('database.php');
                    $conn->select_db("fullstack");

                    
                    $sql = "SELECT idevents, naam_event, prijs_event, datum_event, time_event FROM events";
                    $result = $conn->query($sql); // voert de sql query uit en slaat op in $result
                    if ($result->num_rows > 0) { // geeft aabtal rijen terug
                        while($row = $result->fetch_assoc()) { //haalt resultaat uit sql query
                            echo '<option value="' . $row["idevents"] . '">' . htmlspecialchars($row["naam_event"]) . ' - ' . htmlspecialchars($row["datum_event"]) . '</option>';
                        } // option is dropdown en het pakt de idevent naam event datum event en komt dan te zien op de dropdown
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="band">Band:</label>
                <?php
                // Query om bands op te halen
                $sql = "SELECT idbands, namen, genre FROM bands";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<label>';
                        echo '<input type="checkbox" name="bands[]" value="' . $row["idbands"] . '"> ' . htmlspecialchars($row["namen"]) . ' (' . htmlspecialchars($row["genre"]) . ')';
                        echo '</label><br>';
                    }
                }
                ?>
            </div>

            <input type="submit" name="submit" value="Koppel band aan event">
        </form>

        <?php
        if (isset($_POST['submit'])) { //word pas uitgevoerd als er op submit is geklikt
            
            if (!empty($_POST['event_id']) && !empty($_POST['bands'])) { // zorgt ervoor dat het niet leeg is met php functie !empty
                $event_id = $_POST['event_id']; // controleert of er een event is aangeklikt
                $bands = $_POST['bands']; // controleert of er EEn of meer is aangeklikt 

                // if statement als beide true is dus asl alles is ingevuld dan pas werkt het mocht er een false zitten dan komt er een fout melding

                // foreach loopt door elke band id en slaat het op in $band_id
                foreach ($bands as $band_id) {
                    $sql = "INSERT INTO bands_has_events (bands_idbands, events_idevents) VALUES ($band_id, $event_id)"; //voegt in de tabel bands_has_events de id van bands en events
                    if ($conn->query($sql) === TRUE) { // voert de sql query uit op de database
                        echo "<p>Band succesvol gekoppeld aan event!</p>";
                    } else {
                        echo "<p>Fout bij het koppelen van band aan event: " . $conn->error . "</p>";
                        //als de if statement true is voert print hij succesvol gekoppeld zo niet dan word er een foutmelding gegeven.
                    }
                }
            } else {
                echo "<p>Selecteer een event en minimaal één band om te koppelen.</p>";
            }
        }
    

        ?>
