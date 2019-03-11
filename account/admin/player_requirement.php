<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Mahar Corps | Admin</title>
        <link rel="icon" type="image/png" href="/img/icon.png">   
    </head>
    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <?php
        include('../../system/core/connection.php');
        include('../../system/function.php');
        include('../../system/session/admin_page_session.php');
        $id_player=$_GET['id_player'];
        $querryplayerreq="SELECT id_player, player_requirement FROM futsal_player WHERE id_player='$id_player'";
        $player=mysqli_query($mysqli, $querryplayerreq) or die(mysqli_error);
        $playerimg = mysqli_fetch_array($player);
    ?>
        <img src="/img/player/req/<?php echo $playerimg['player_requirement'];?>.jpg">
    </body>
</html>