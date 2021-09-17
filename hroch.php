<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahoj Hrochu</title>
</head>
<body>
    <datalist id="samo">
    <option>Ano</option>
    <option>Ne</option>
    </datalist>
    <form method="POST">
        <label for="jmeno">Jméno</label>
        <input type="text" name="jmeno" id="jmeno" required> <br> 
        <label for="prijmeni">Příjmeni</label>
        <input type="text" name="prijmeni" id="prijmeni" required> <br> 
        <label for="dat_nar">Datum narození</label>
        <input type="date" name="dat_nar" id="dat_nar" required> <br> 
        <label for="oddeleni">Oddělení</label>
        <input type="text" name="oddeleni" id="oddeleni" required> <br> 
        <label for="datum">Datum zapsaní</label>
        <input type="date" name="datum" id="datum" required> <br> 
        <label for="sam">Samostatné vyplnění</label>
        <input type="text" name="sam" id="sam" list="samo" required> <br> 
        <input type="submit" value="Zapsat" >
    </form>
    <?php
        unset($_SESSION["user"]);
        $servername="remotemysql.com";
        $dbusername="FD3plFzaSa";
        $dbpassword="Gb83VmnrNG";
        $dbname="FD3plFzaSa";
        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        if(isset($_POST["jmeno"])){
        $dotvloz = "INSERT INTO hroch (jmeno, prijmeni, dat_nar, oddeleni, datum, sam) VALUES ('{$_POST["jmeno"]}','{$_POST["prijmeni"]}','{$_POST["dat_nar"]}','{$_POST["oddeleni"]}','{$_POST["datum"]}','{$_POST["sam"]}')";
        mysqli_query($conn,$dotvloz);
        echo mysqli_error($conn);
        }
        $dotvypis = "SELECT * FROM hroch ORDER BY ID_dot";
        $vysledek = mysqli_query($conn, $dotvypis);
        echo mysqli_error($conn);
    ?>
    <table>
    <tr>
        <th>Pořadové číslo</th>
        <th>Jméno</th>
        <th>Příjmeni</th>
        <th>Datum Narození</th>
        <th>Oddělení</th>
        <th>Datum zapsaní</th>
        <th>Samostatné vyplnění</th>
    </tr>
    

 <?php
  
  while ($zaznam = mysqli_fetch_assoc($vysledek)) {
      echo "<tr>";
      echo "<td>{$zaznam["ID_dot"]}</td>";
      echo "<td>{$zaznam["jmeno"]}</td>";
      echo "<td>{$zaznam["prijmeni"]}</td>";     
      echo "<td>{$zaznam["dat_nar"]}</td>";
      echo "<td>{$zaznam["oddeleni"]}</td>";
      echo "<td>{$zaznam["datum"]}</td>";
      echo "<td>{$zaznam["sam"]}</td>";
      echo "</tr>";
  }
  ?>

</table>
</body>
</html>