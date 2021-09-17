<?php
    $servername="remotemysql.com";
    $dbusername="FD3plFzaSa";
    $dbpassword="Gb83VmnrNG";
    $dbname="FD3plFzaSa";
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    $dot = "SELECT u.username, g.name, g.server, g.guild, g.race, g.class, g.spec,g.spec_2,g.spec_3, g.file_name, g.popis  FROM gw g, users u WHERE ID_gw = '{$_COOKIE["prispevek"]}' AND g.user like u.id_u";
    $vysledek = mysqli_query($conn,$dot);
    echo mysqli_error($conn);
    $zaznam = mysqli_fetch_assoc($vysledek);
    //print_r($zaznam);
?>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylPrispevek.css" />
    <link rel="icon" href="images/G.ico">
    <title>Příspěvek</title>
</head>
<body id="gw">
<?php
        include 'navigace.php';
    ?>
    <h1><?= $zaznam["username"] ?> - <?= $zaznam["server"] ?></h1>
    <section>
        <div><strong> Username:</strong> <?= $zaznam["username"] ?></div>
        <div><strong>Name:</strong> <?= $zaznam["name"] ?></div>
        <div><strong>Server:</strong> <?= $zaznam["server"] ?></div>
        <div><strong>Guilda:</strong> <?= $zaznam["guild"] ?></div>
        <div><strong>Rasa:</strong> <?= $zaznam["race"] ?></div>
        <div><strong>Class:</strong> <?= $zaznam["class"] ?></div>
        <div><strong>Hlavní specializace:</strong> <?= $zaznam["spec"] ?></div>
        <div><strong>Vedlejší specializace 1:</strong> <?= $zaznam["spec_2"] ?></div>
        <div><strong>Vedlejší specializace 2:</strong> <?= $zaznam["spec_3"] ?></div>
        <div><strong>Popis:</strong> <?= $zaznam["popis"] ?></div>
        <img src="<?= "img/".$zaznam["file_name"] ?>" alt="<?= $zaznam["name"] ?>"width="700" height="400">
    </section>
</body>
</html>