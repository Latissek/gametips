<?php
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
                        header("Location: /login.php?error=wrong_passord");//domyslet později
                        exit();
                    }
                    else if($pwdcheck==true){
                        session_start();
                        $_SESSION["userId"] = $row["id_u"];
                        $_SESSION["userId"] = $row["username"];
                        header("Location: /login.php?succes");//domyslet později
                        exit();
                    }
                    else{
                        header("Location: /login.php?wrong_password");//domyslet později
                        exit();
                    }
                    
                }
                else{
                    header("Location: /login.php?no_user_found");//domyslet později
                    exit();
                }
            }
        }

    }
    //skoro nic
?>