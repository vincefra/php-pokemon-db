<?php
    //session för våra fel-meddelanden
    session_start();
    //nå vår dateklass
    require('Date.php');
    require('Validator.php');

    //fånga submit
    if (filter_has_var(INPUT_POST, 'submit')) {
        try {
            $validator = new Pos_Validator(array('username', 
                'email'), 'post');
            $validator->checkTextLength('username', 3, 25);
            $validator->removeTags('username');
            $validator->isEmail('email');

            //validera, samla errors
            $filtered = $validator->validateInput();
            $missing = $validator->getMissing();
            $errors = $validator->getErrors();

            //loopa igenom våra errors, lagra som session för index ska få fram
            foreach ($errors as $value) {
                $_SESSION[$value] = $value . '-fältet har fel i sig, var vänlig och checka!';
              }

            //skapa två nya objekt av vår klass, tidzon sthlm och helsinki
            $sweden = new Pos_Date('now', new DateTimeZone('Europe/Stockholm'));
            $finland = new Pos_Date('now', new DateTimeZone('Europe/Helsinki'));

            //vår date.php gör checkar som att det är int och att datum existerar
            $sweden->setDate($_POST['date_one_y'], $_POST['date_one_m'], 
                $_POST['date_one_d']);
            $finland->setDate($_POST['date_two_y'], $_POST['date_two_m'], 
                $_POST['date_two_d']);

            //få fram offset i timmar genom /3600, minus/plus 
            //för skillnaden mellan tidzonerna
            $diffWithOffset = ($sweden->getOffset() / 3600) 
                - ($finland->getOffset() / 3600);

            $diff = $finland->diff($sweden);
            $hours = $diff->h;
            $hours = $hours + ($diff->days*24);
            
            echo 'Det skiljer sig ' . ($hours-$diffWithOffset) .
                ' timma(r) mellan Sverige, 
                    Finland för dessa datum med nuvarande tid: ' . 
                    date("H:i:s") .'<br /><br />' . 
                'Stockholm: ' . $sweden . '<br />Finland: ' . $finland . '<br />';

            echo 'Användarnamn: ' . $filtered['username'] . '<br />
                Epostadress: ' . $filtered['email']
            ?>
            <br /><br />
            <a href="index.php" class="btn btn-success" role="button">Gå tillbaka</a>
            <?php          
        }
        catch (Exception $e) { 
            header("Location:http://localhost/index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" 
        crossorigin="anonymous">
    <title>Övning - Validator</title>
    </head>
    <body>
    </body>
</html>