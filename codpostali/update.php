<?php
$database_host = "localhost";
$database_user = "root";
$database_password = "";
$database_name = "comuni";

$connection = new mysqli($database_host, $database_user, $database_password, $database_name);

if ($connection->connect_error) {
    die("Impossibile connettersi al database: " . $connection->connect_error);
}

$response = array();

// Estrai i parametri dall'URL
$url = $_SERVER['REQUEST_URI'];
$parts = explode('/', $url);

// Verifica se ci sono abbastanza segmenti nell'URL
if(count($parts) >= 5) {
    $id = $parts[3];
    $new_cap = $parts[4];
    $new_provincia = $parts[5];

    $update_query = "UPDATE comuni SET cap='$new_cap', provincia='$new_provincia' WHERE id='$id'";
    
    if ($connection->query($update_query) === TRUE) {
        $response['message'] = "Record aggiornato correttamente.";
    } else {
        $response['success'] = false;
        $response['message'] = "Errore durante l'aggiornamento del record: " . $connection->error;
    }
} else {
    $response['success'] = false;
    $response['message'] = "Parametri mancanti.";
}

header('Content-Type: application/json');
echo json_encode($response);

$connection->close();
?>
