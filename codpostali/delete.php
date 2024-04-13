<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comuni";

// Connessione al database
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Impossibile connettersi al database: " . $conn->connect_error);
}

$response = array();

// Estrai il parametro ID_RECORD dall'URL
$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);
$id_record = isset($parts[3]) ? $parts[3] : null;

// Verifica se è stato passato un parametro ID_RECORD nell'URL
if($id_record !== null) {
    $id = $id_record;

    // Prepara la query per eliminare il record con l'id specificato
    $sql = "DELETE FROM comuni WHERE id='$id'";
    
    // Esegui la query
    if ($conn->query($sql) === TRUE) {
        $response['message'] = "Record eliminato con successo.";
    } else {
        $response['success'] = false;
        $response['message'] = "Errore durante l'eliminazione del record: " . $conn->error;
    }
} else {
    $response['success'] = false;
    $response['message'] = "Parametro ID_RECORD mancante.";
}

// Restituisci la risposta in formato JSON
header('Content-Type: application/json');
echo json_encode($response);

// Chiudi la connessione al database
$conn->close();
?>
