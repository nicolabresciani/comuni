<?php
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

// Estrai i parametri dal percorso dell'URL
$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$cap = isset($parts[3]) ? $parts[3] : null;
$provincia = isset($parts[4]) ? $parts[4] : null;

// Verifica se i parametri sono stati forniti
if($cap !== null && $provincia !== null) {
    $new_cap = mysqli_real_escape_string($conn, $cap);
    $new_provincia = mysqli_real_escape_string($conn, $provincia);

    // Query SQL per verificare se il comune esiste già nel database
    $check_query = "SELECT * FROM comuni WHERE cap = '$new_cap' AND provincia = '$new_provincia'";
    $result = $conn->query($check_query);

    if ($result && $result->num_rows > 0) {
        // Se il comune esiste già, restituisci un messaggio di errore
        $response['success'] = false;
        $response['message'] = "Il comune esiste già nel database.";
    } else {
        // Altrimenti, procedi con l'inserimento del nuovo comune
        $sql = "INSERT INTO comuni (cap, provincia) VALUES ('$new_cap', '$new_provincia')";
        
        if ($conn->query($sql) === TRUE) {
            $response['success'] = true;
            $response['message'] = "Record aggiunto con successo.";
        } else {
            $response['success'] = false;
            $response['message'] = "Errore durante l'aggiunta del record: " . $conn->error;
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = "Parametri mancanti.";
}

// Stampiamo la risposta e gli eventuali errori
echo "Response: " . json_encode($response) . "\n";
echo "Error: " . $conn->error . "\n";

// Chiusura della connessione al database
$conn->close();
?>
