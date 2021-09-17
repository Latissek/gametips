<?php
    $servername="remotemysql.com";
    $dbusername="FD3plFzaSa";
    $dbpassword="Gb83VmnrNG";
    $dbname="FD3plFzaSa";
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    $dot = "SELECT u.username, w.name, w.server, w.guild, w.faction, w.race, w.class, w.spec, w.filename, w.popis, w.links FROM wow w, users u WHERE id_wow = '{$_COOKIE["prispevek"]}' AND w.username like u.id_u";
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
<body id="wow">
<?php
        include 'navigace.php';
    ?>
    <h1><?= $zaznam["username"] ?> - <?= $zaznam["server"] ?></h1>
    <section>
        <div><strong> Username:</strong> <?= $zaznam["username"] ?></div>
        <div><strong>Name:</strong> <?= $zaznam["name"] ?></div>
        <div><strong>Server:</strong> <?= $zaznam["server"] ?></div>
        <div><strong>Guilda:</strong> <?= $zaznam["guild"] ?></div>
        <div><strong>Frakce:</strong> <?= $zaznam["faction"] ?></div>
        <div><strong>Rasa:</strong> <?= $zaznam["race"] ?></div>
        <div><strong>Class:</strong> <?= $zaznam["class"] ?></div>
        <div><strong>Specializace:</strong> <?= $zaznam["spec"] ?></div>
        <div><strong>Popis:</strong> <?= $zaznam["popis"] ?></div>
        <div><strong>Linky:</strong> <?= $zaznam["links"] ?></div>
        <img src="<?= "img/".$zaznam["filename"] ?>" alt="<?= $zaznam["name"] ?>"width="700" height="400">
    </section>
</body>
</html>