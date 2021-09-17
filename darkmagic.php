<?php 

if(isset($_POST["gombik"])){
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
    $email=$_POST["email"];
    $password=$_POST["password"];
    if(empty($username) || empty($email) || empty($password)){
        echo "Jsi pepega, která mění html a není to cool";
        header("Location: /signup.php?error=htmlerror");//domyslet později
        exit();
    }
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header("Location: /signup.php?error=Invalid_email");//domyslet později
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        header("Location: /signup.php?error=Invalid_username");//domyslet později
        exit();
    }
    else{
        $sql="SELECT* FROM users WHERE id_u=?;";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: /signup.php?error=sqlerror");//domyslet později
            exit();
        }
        else{                
            mysqli_stmt_bind_param($stmt,"s",$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck=mysqli_stmt_num_rows($stmt);
            if($resultcheck>0){
                header("Location: /signup.php?error=User_taken");//domyslet později
                exit();
            }
            else{
                $sql="INSERT INTO users(username, email, passwd) VALUES(?,?,?)";
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: /signup.php?error=sqlerror");//domyslet později
                    exit();
                }
                else{
                    $hashedpwd=password_hash($password,PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hashedpwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: /signup.php?succes");//domyslet později
                    exit();
                }
            }
        }
    }
   mysqli_stmt_close($stmt); 
   mysqli_close($conn);
}
else{
    header("Location: /signup.php");
    exit();
}
?>