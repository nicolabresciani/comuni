<?php
// Informazioni di connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comuni";

// Connessione al database
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$response = array();

// Verifica se è stato fornito il parametro
if(isset($_GET['param'])) {
    // Estrai il parametro dalla richiesta GET
    $param = $_GET['param'];
    
    // Query SQL per cercare il parametro nel CAP o nella provincia
    $sql = "SELECT * FROM comuni WHERE cap = '$param' OR provincia LIKE '%$param%'";
    
    // Esegui la query
    $result = $conn->query($sql);

    // Verifica se sono stati trovati risultati
    if ($result->num_rows > 0) {
        // Array per memorizzare i dati trovati
        $response['data'] = array();
        
        // Ciclo attraverso i risultati e li memorizzo nell'array
        while($row = $result->fetch_assoc()) {
            $response['data'][] = $row;
        }
    } else {
        // Nessun risultato trovato
        $response['success'] = false;
        $response['message'] = "Nessun risultato trovato.";
    }
} else {
    // Parametri mancanti
    $response['success'] = false;
    $response['message'] = "Parametri mancanti.";
}

// Restituisci la risposta in formato JSON
header('Content-Type: application/json');
echo json_encode($response);

// Chiudi la connessione al database
$conn->close();
?>
