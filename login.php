<?php
    session_start();

    if(isset($_POST["username"])){
        //všechno
        $servername="remotemysql.com";
        $dbusername="FD3plFzaSa";
        $dbpassword="Gb83VmnrNG";
        $dbname="FD3plFzaSa";
        $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

        if(!$conn)
        {
            die("Connection failed".mysqli_connect_error());
        }
        $username=$_POST["username"];
        $password=$_POST["password"];
        if(empty($username) || empty($password)){
            echo "Jsi pepega, která mění html a není to cool";
            header("Location: /login.php?error=htmlerror");//domyslet později
            exit();
        }
        else{
            $sql="SELECT* FROM users WHERE username=?;";
            $stmt=mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: /login.php?error=sqlerror");//domyslet později
                exit();
            }
            else{                
                mysqli_stmt_bind_param($stmt,"s",$username);
                mysqli_stmt_execute($stmt);
                $result=mysqli_stmt_get_result($stmt);
                if($row=mysqli_fetch_assoc($result)){
                    $pwdcheck=password_verify($password,$row["passwd"]);
                    if($pwdcheck==false){
                        echo "<script> alert('Špatné heslo'); </script>";
                    }
                    else if($pwdcheck==true){
                        session_start();
                        $_SESSION["userId"] = $row["id_u"];
                        $_SESSION["username"] = $row["username"];
                        echo "<script> alert('Přihlášen!'); </script>";
                    }
                    else{
                        echo "<script> alert('Špatné heslo'); </script>";
                    }
                    
                }
                else{
                    echo "<script> alert('Uživatel nenalezen!'); </script>";
                }
            }
        }

    }
?>
<!DOCTYPE html>

<html lang="cs">
<head>
    <meta charset="utf-8" />
    <title>Log in</title>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <link rel="stylesheet" href="styllogin.css" />
    <link rel="icon" href="images/G.ico">

</head>
<body>
    <section>
        <p id="vetsi">Přihlášení uživatele</p>
        <p id="mensi">na web Gametips</p>
    <form method="POST">
        <p><label for="user">Username</label> </p>
        <p><input type="text" name="username" required id="user" placeholder="Your username"> </p>
        <p><label for="pass">Password</label> </p>
        <p><input type="password" name="password" required id="pass" placeholder="Your password"> </p>
        <p><input type="submit" value="Log in"> </p>
    </form>
    <p>Ještě nemáte účet? Zaregistrujte se <a href="signup.php">zde</a></p>
    <p>Pokud se chcete vrátit na domovskou stránku tak klikněte <a href="index.php">zde</a></p>
    </section>
 
</body>
</html>