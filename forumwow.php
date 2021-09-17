<?php
    $servername="remotemysql.com";
    $dbusername="FD3plFzaSa";
    $dbpassword="Gb83VmnrNG";
    $dbname="FD3plFzaSa";
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    $dotvyp = "SELECT wow.id_wow,users.username, wow.name,wow.server,wow.class,wow.faction FROM wow, users WHERE wow.username like users.id_u";
    $d = "SELECT * FROM wow";
    $vysledek = mysqli_query($conn,$dotvyp);
    echo mysqli_error($conn);
?>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylforum.css" />
    <link rel="icon" href="images/G.ico">
    <title>Forum wow</title>
</head>
<body style="background-color: #979797;" id="wow">
<?php
        include 'navigace.php';
    ?>
        <h1>Postavy od uživatelů ze hry World of Warcraft</h1>
    <section>
        <p id="newf"><a href="/formwow.php">Přidat postavu</a></p>
        <table>
            <tr>
                <th>Usename</th>
                <th>Jméno postavy</th>
                <th>Server</th>
                <th>Class</th>
                <th>Frakce</th>
            </tr>
            <?php
                while($zaznam = mysqli_fetch_assoc($vysledek)){
                    echo mysqli_error($conn);
                echo "<tr>
                <td><a onclick = 'presun({$zaznam["id_wow"]})' class='{$zaznam["id_wow"]}'>{$zaznam["username"]}</a></td>
                <td><a onclick = 'presun({$zaznam["id_wow"]})' class='{$zaznam["id_wow"]}'>{$zaznam["name"]}</a></td>
                <td><a onclick = 'presun({$zaznam["id_wow"]})' class='{$zaznam["id_wow"]}'>{$zaznam["server"]}</a></td>
                <td><a onclick = 'presun({$zaznam["id_wow"]})' class='{$zaznam["id_wow"]}'>{$zaznam["class"]}</a></td>
                <td><a onclick = 'presun({$zaznam["id_wow"]})' class='{$zaznam["id_wow"]}'>{$zaznam["faction"]}</a></td>
                </tr>";
                }
            ?>
            <script>
                function presun(id){
                    document.cookie="prispevek="+id;
                    location.assign("http://gametips.ga/prispevek.php");
                }
            </script>
        </table>
    </section>
</body>
</html>