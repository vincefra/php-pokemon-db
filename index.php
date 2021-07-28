<?php
    include('manage/texts.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <style>
        html, body { height:100%; }
    </style>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" 
        crossorigin="anonymous">
    
    <title>Pokemon Center</title>
    </head>
    <body>
        <!-- external texts from textclass -->
        <div class="btn-group btn-group-lg">
            <button type="button" id="buttonUsers" class="btn btn-primary">
                <?php echo $texts->getUser(); ?></button>
            <button type="button" id="buttonItems" class="btn btn-warning"
                ><?php echo $texts->getItem(); ?></button>
            <button type="button" id="buttonLoans" class="btn btn-danger">
                <?php echo $texts->getLoan(); ?></button>
        </div>

        <!-- jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
        <!-- iframe for presenting different pages -->
        <iframe id="iframe" src="about:blank" width="100%" height="100%"></iframe>

        <!-- script for iframes :) -->
        <script src="js/script.js"></script>
    </body>
</html>
