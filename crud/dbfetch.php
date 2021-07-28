<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fetch Pokemon</title>
</head>
<body>

<?php
// inkludera pdoext där vi angav mysql-uppgifter
include 'dbcon.php';

// skapa en ny instans av DB
$db = new DB();

//hämta pokemon + model genom JOIN
$query = "SELECT pokeid, nickname, age, weight, height, name
          FROM pokemon JOIN model ON model.id = pokemon.pokeid";

// Om vi får ett resultat, loopa då igenom detta och skriv ut varje rad
if ($result = $db->query($query)) {
    while ($row = $result->fetch(PDO::FETCH_NUM)) {
        
        //printa ut variablarna med titel för varje kolumn
        echo "<pre>" . "Nickname: " . $row[1] . "</pre>";
        echo "<pre>" . "Age: " . $row[2] . "</pre>";
        echo "<pre>" . "Weight: " . $row[3] . "</pre>";
        echo "<pre>" . "Height: " . $row[4] . "</pre>";
        echo "<pre>" . "Modelname: " . $row[5] . "</pre><br />";
    }
}