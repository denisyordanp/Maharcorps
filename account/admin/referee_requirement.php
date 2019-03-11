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
        $id_referee=$_GET['id_referee'];
        $querrrefereereq="SELECT id_referee, referee_requirement FROM futsal_referee WHERE id_referee='$id_referee'";
        $referee=mysqli_query($mysqli, $querrrefereereq) or die(mysqli_error);
        $refereeimg = mysqli_fetch_array($referee);
    ?>
        <img src="/img/referee/req/<?php echo $refereeimg['referee_requirement'];?>.jpg">
    </body>
</html>