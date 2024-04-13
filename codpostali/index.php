<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comandi CAP e Provincia</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
<h2>Comandi disponibili:</h2>
    <ul>
    <li>Ricerca per CAP: <code>localhost/codpostali/search/XXXXX</code></li>
        <li>Ricerca per Provincia: <code>localhost/codpostali/search/Nome_Provincia</code></li>
        <li>Modifica Record: <code>localhost/codpostali/update/ID_RECORD/Nuovo_CAP/Nuova_Provincia</code></li>
        <li>Elimina Record: <code>localhost/codpostali/delete/ID_RECORD</code></li>
        <li>Aggiungi Record: <code>localhost/codpostali/create/Nuovo_CAP/Nuova_Provincia</code></li>
    </ul>
    <h2>Tabella Province</h2>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "comuni";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM comuni";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>CAP</th><th>Provincia</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['cap']."</td>";
            echo "<td>".$row['provincia']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nessun risultato trovato.";
    }

    $conn->close();
    ?>

   
</body>
</html>