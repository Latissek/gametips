<?php
    $servername="remotemysql.com";
    $dbusername="FD3plFzaSa";
    $dbpassword="Gb83VmnrNG";
    $dbname="FD3plFzaSa";
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    $dotvyp = "SELECT g.ID_gw,u.username, g.name,g.server,g.class FROM gw g, users u WHERE g.user like u.id_u";
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
<body style="background-color: #979797;" id="gw">
<?php
        include 'navigace.php';
    ?>
        <h1>Postavy od uživatelů ze hry Guild Wars 2</h1>
    <section>
        <p id="newf"><a href="/formgw.php">Přidat postavu</a></p>
        <table>
            <tr>
                <th>Usename</th>
                <th>Jméno postavy</th>
                <th>Server</th>
                <th>Class</th>
            </tr>
            <?php
                while($zaznam = mysqli_fetch_assoc($vysledek)){
                    echo mysqli_error($conn);
                echo "<tr>
                <td><a onclick = 'presun({$zaznam["ID_gw"]})' class='{$zaznam["ID_gw"]}'>{$zaznam["username"]}</a></td>
                <td><a onclick = 'presun({$zaznam["ID_gw"]})' class='{$zaznam["ID_gw"]}'>{$zaznam["name"]}</a></td>
                <td><a onclick = 'presun({$zaznam["ID_gw"]})' class='{$zaznam["ID_gw"]}'>{$zaznam["server"]}</a></td>
                <td><a onclick = 'presun({$zaznam["ID_gw"]})' class='{$zaznam["ID_gw"]}'>{$zaznam["class"]}</a></td>
                </tr>";
                }
            ?>
            <script>
                function presun(id){
                    document.cookie="prispevek="+id;
                    location.assign("http://gametips.ga/prispevekgw.php");
                }
            </script>
        </table>
    </section>
</body>
</html>