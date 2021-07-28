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
    
    // function for our droplist
    function generateModels() {
        $db = db();
        
        $query = "SELECT * from model";

        // html with select/option for dropdown
        if ($result = $db->query($query)) {
            echo "<select name='selectedModel'>
                <option disabled selected>-- Select Model --</option>";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='". $row['id'] ."'>" .$row['name'] ."</option>";
            }
            echo "</select>";
        }
    }
    // generate data from API
    if (isset($_POST['generateModel'])) {

        //filter input, sanitize special chars (not needed but good practice)
        $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_SPECIAL_CHARS);
        $data = file_get_contents('https://pokeapi.co/api/v2/pokemon/'.$model.'');
        $json = json_decode($data);
        
        //present data from API
        echo '<pre>'.'ModelID: ' . $json->id . '</pre>';
        echo '<pre>'.'Modelname: ' . $json->name . '</pre>';
        echo '<pre>'.'Weight: ' . $json->weight . '</pre>';
        echo '<pre>'.'Height: ' . $json->height . '</pre>';
    }

    // add Pokemon to DB
    if (isset($_POST['addPokemon'])) {
        // query för att lägga till items
        $query = "INSERT INTO pokemon(nickname, pokeid, age)
        VALUES (:nickname, :pokeid, :age)";

        // filter inputs
        $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_SPECIAL_CHARS);
        $pokeid = filter_input(INPUT_POST, 'selectedModel', FILTER_SANITIZE_NUMBER_INT);
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);

        // prep statement with our values
        $values = array(':age' => $age,
                ':nickname' => $nickname,
                ':pokeid' => $pokeid);

        $sth = $db->prepare($query);

        if ($sth->execute($values)) {
            echo "<h4>Pokemon added</h4>";
        } else {
            echo "<h4>Error</h4>";
            echo "<pre>" . print_r($sth->errorInfo(), 1) . "</pre>";
        }
    }

    // add Model to DB
    if (isset($_POST['addModel'])) {
        // query för att lägga till items
        $query = "INSERT INTO model(name, weight, height)
        VALUES (:name, :weight, :height)";

        // filter inputs
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $weight = filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_NUMBER_INT);
        $height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_NUMBER_INT);

        // prep statement with our values
        $values = array(':name' => $name,
                ':weight' => $weight,
                ':height' => $height);

        $sth = $db->prepare($query);

        if ($sth->execute($values)) {
            echo "<h4>Model added</h4>";
        } else {
            echo "<h4>Error</h4>";
            echo "<pre>" . print_r($sth->errorInfo(), 1) . "</pre>";
        }
    }
?>
    <!-- form for generating models from API, type in name -->
    <h4>Generate Pokemon from Extern API (pokeapi.co)</h4>
        <form action="dbadd.php" method="post">
            <input type="text" name="model" placeholder="Pikachu">
            <input type="submit" name="generateModel" value="Submit">
        </form>

    <!-- form for adding pokemon, dropdown list with models -->
    <h4>Add Pokemon to Database</h4>
        <form action="dbadd.php" method="post">
            <input type="text" name="nickname" placeholder="Nickname">
            <?php generateModels(); ?>
            <input type="text" name="age" placeholder="Age">
            <input type="submit" name="addPokemon" value="Submit">
        </form>

    <!-- form for adding model -->
    <h4>Add Model to Database</h4>
    <form action="dbadd.php" method="post">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="weight" placeholder="Weight">
        <input type="text" name="height" placeholder="Height">
        <input type="submit" name="addModel" value="Submit">
    </form>
</body>
</html>