<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add & Remove</title>
</head>
<body>
<?php
    include('dbcon.php');
    $db = db();

    // static db, to reach it everywhere in this code
    function db() {
        static $db;

        if ($db===NULL) {
            $db = new DB();
        }
        return $db;
    }
    function generatePokemon() {
        $db = db();
        
        // function for our droplist
        $query = "SELECT * from pokemon";

        // html with select/option for dropdown
        if ($result = $db->query($query)) {
            echo "<select name='selectedPokemon'>
                <option disabled selected>-- Select Pokemon --</option>";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='". $row['id'] ."'>" .$row['nickname'] ."</option>";
            }
            echo "</select>";
        }
    }

    // add Pokemon to DB
    if (isset($_GET['delPokemon'])) {
        $id = filter_input(INPUT_GET, 'selectedPokemon', FILTER_SANITIZE_NUMBER_INT);

        // query for deleting our pokemon :(
        $query = "DELETE FROM pokemon WHERE id=(:id)";

        $sth = $db->prepare($query);
    
        if ($sth->execute(array(':id' => $id))) {
            echo "<h4>Pokemon with id: " . $id . " deleted";
        } else {
            echo "<h4>Error</h4>";
            echo "<pre>" . print_r($sth->errorInfo(), 1) . "</pre>";
        }
    }
?>
    <!-- form for adding pokemon, dropdown list with models -->
    <h4>Delete Pokemon</h4>
        <form action="dbdel.php" method="get">
            <?php generatePokemon(); ?>
            <input type="submit" name="delPokemon" value="Submit">
        </form>
</body>
</html>