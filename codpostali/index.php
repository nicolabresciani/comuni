<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comandi CAP e Provincia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h2 {
            margin-top: 20px;
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
        }
        input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        code {
            background-color: #f2f2f2;
            padding: 3px 5px;
            border-radius: 3px;
            color: #333;
        }
        #provinceTable {
            margin-top: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        
    </style>
</head>
<body>
<h2>Comandi disponibili:</h2>

    <ul>
        <li>Ricerca per CAP: <code>localhost/codpostali/search/XXXXX</code><input type="text" id="capInput"><button onclick="searchByCAP()">Cerca per CAP</button></li>
        <li>Ricerca per Provincia: <code>localhost/codpostali/search/Nome_Provincia</code><input type="text" id="provinceInput"><button onclick="searchByProvince()">Cerca per Provincia</button></li>
        <li>Modifica Record: <code>localhost/codpostali/update/ID_RECORD/Nuovo_CAP/Nuova_Provincia</code><input type="text" id="updateIdInput"><input type="text" id="updateCAPInput"><input type="text" id="updateProvinceInput"><button onclick="updateRecord()">Modifica Record</button></li>
        <li>Elimina Record: <code>localhost/codpostali/delete/ID_RECORD</code><input type="text" id="deleteIdInput"><button onclick="deleteRecord()">Elimina Record</button></li>
        <li>Aggiungi Record: <code>localhost/codpostali/create/Nuovo_CAP/Nuova_Provincia</code><input type="text" id="addCAPInput"><input type="text" id="addProvinceInput"><button onclick="addRecord()">Aggiungi Record</button></li>
    </ul>
    <h2>Tabella Province</h2>
    <div id="provinceTable"></div>
    
    <script>
        function searchByCAP() {
            var cap = document.getElementById("capInput").value;
            sendRequest("search.php?param=" + cap);
        }

        function searchByProvince() {
            var province = document.getElementById("provinceInput").value;
            sendRequest("search.php?param=" + province);
        }

        function updateRecord() {
            var id = document.getElementById("updateIdInput").value;
            var newCAP = document.getElementById("updateCAPInput").value;
            var newProvince = document.getElementById("updateProvinceInput").value;
            sendRequest("update.php/" + id + "/" + newCAP + "/" + newProvince);
        }

        function deleteRecord() {
            var id = document.getElementById("deleteIdInput").value;
            sendRequest("delete.php/" + id);
        }

        function addRecord() {
            var newCAP = document.getElementById("addCAPInput").value;
            var newProvince = document.getElementById("addProvinceInput").value;
            sendRequest("create.php/" + newCAP + "/" + newProvince);
        }

        function sendRequest(url) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("provinceTable").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }

        // Carica la tabella all'avvio della pagina
        window.onload = function() {
            sendRequest("search.php?param="); // Assumendo che ci sia una route per ottenere la tabella iniziale
        };
    </script>
</body>
</html>
