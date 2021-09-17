<?php session_start();
   
    if(empty($_SESSION)){
        header("Location: index.php");
        echo "tumtum";
    }
    $servername="remotemysql.com";
    $dbusername="FD3plFzaSa";
    $dbpassword="Gb83VmnrNG";
    $dbname="FD3plFzaSa";
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

    function getRace($susenka){
        $servername="remotemysql.com";
        $dbusername="FD3plFzaSa";
        $dbpassword="Gb83VmnrNG";
        $dbname="FD3plFzaSa";
        $connf = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        $racegw = "SELECT * FROM race WHERE frakce = 'gw'";
        


            $vysledek = mysqli_query($connf,$racegw);

        while($zaznam = mysqli_fetch_assoc($vysledek)){
            echo $zaznam["name"]. ",";
        }
    }
    
    function getSpec($susenka){
        $servername="remotemysql.com";
        $dbusername="FD3plFzaSa";
        $dbpassword="Gb83VmnrNG";
        $dbname="FD3plFzaSa";
        $connf = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
        
 
        
        $specMS="SELECT  *  FROM  spec  WHERE  Class  =  'Mesmer'  &&  game  =  'gw'";
        $specGU="SELECT  *  FROM  spec  WHERE  Class  =  'Guardian'  &&  game  =  'gw'";
        $specNE="SELECT  *  FROM  spec  WHERE  Class  =  'Necromancer'  &&  game  =  'gw'";
        $specRA="SELECT  *  FROM  spec  WHERE  Class  =  'Ranger'  &&  game  =  'gw'";
        $specEL="SELECT  *  FROM  spec  WHERE  Class  =  'Elementalist'  &&  game  =  'gw'";
        $specWA="SELECT  *  FROM  spec  WHERE  Class  =  'Warrior'  &&  game  =  'gw'";
        $specTH="SELECT  *  FROM  spec  WHERE  Class  =  'Thief'  &&  game  =  'gw'";
        $specEN="SELECT  *  FROM  spec  WHERE  Class  =  'Engineer'  &&  game  =  'gw'";
        $specRE="SELECT  *  FROM  spec  WHERE  Class  =  'Revenant'  &&  game  =  'gw'";

        if($susenka == "Mesmer"){
            $vysledek = mysqli_query($connf,$specMS);
        }
        else if($susenka == "Guardian"){
            $vysledek = mysqli_query($connf,$specGU);
        }
        else if($susenka == "Necromancer"){
            $vysledek = mysqli_query($connf,$specNE);
        }
        else if($susenka == "Ranger"){
            $vysledek = mysqli_query($connf,$specRA);
        }
        else if($susenka == "Elementalist"){
            $vysledek = mysqli_query($connf,$specEL);
        }
        else if($susenka == "Warrior"){
            $vysledek = mysqli_query($connf,$specWA);
        }
        else if($susenka == "Thief"){
            $vysledek = mysqli_query($connf,$specTH);
        }
        else if($susenka == "Engineer"){
            $vysledek = mysqli_query($connf,$specEN);
        }
        else if($susenka == "Revenant"){
            $vysledek = mysqli_query($connf,$specRE);
        }
        
        
        while($zaznam = mysqli_fetch_assoc($vysledek)){
        echo $zaznam["Spec"]. ",";
        }

    };   
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylForm.css" />
    <link rel="icon" href="images/G.ico">
    <title>Formulář GW</title>
</head>
<body id="gw">   
    
    <?php
        include 'servery_gw.php';
    ?>
    <section>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" placeholder="Usename" value="<?=$_SESSION["username"] ?>" id="username" name="username"><!-- Z loginu -->
            <p>
                <label for="server">Server</label> 
            </p>
            <input type="text" name="server" id="server" required list="servers" placeholder="Vyberte si server"> <br>                  
            <p>
                <label for="char">Jméno postavy</label> 
            </p>
            <input type="text" required name="name" id="char"> <br>
            <p>
                <label for="race">Rasa</label>
            </p>
            <select name="race" id="race">
            <script>                
                let pocet = 5;
                var vysledek = "<?php echo getRace("gw"); ?>"    

                var opt = document.getElementById("race");
                while (opt.hasChildNodes()) {  
                    opt.removeChild(opt.firstChild);
                }    
                
                    var output = vysledek.split(",");
                    for(var i = 0; i < pocet; i++)
                    {
                        var pomoc = document.createElement("OPTION");
                        pomoc.innerHTML = output[i];
                        document.getElementById("race").appendChild(pomoc);
                    }
                
            
            </script>
            
            </select> <br> 
            <p>
                <label for="class">Class</label> 
            </p>
            <select name="class" id="class">
                <option value="error">Vyber classu</option>
                <option value="Engineer">Engineer</option>
                <option value="Necromancer">Necromancer</option>
                <option value="Thief">Thief</option>
                <option value="Elementalist">Elementalist</option>
                <option value="Warrior">Warrior</option>
                <option value="Ranger">Ranger</option>
                <option value="Mesmer">Mesmer</option>
                <option value="Guardian">Guardian</option>
                <option value="Revenant">Revenant</option>
            </select> <br>
            <p>
                <label for="spec">Hlavní specializace</label> 
            </p>
            <select name="spec" id="spec">
            <script>
                document.getElementById('class').addEventListener('change', function(e){
                console.log(document.getElementById('class').value);
                document.cookie="classa="+document.getElementById('class').value;
                
                let pocet = 7;
                
                if(document.getElementById('class').value == "Engineer"){var vysledek = "<?php echo getSpec("Engineer"); ?>"; }
                else if(document.getElementById('class').value == "Necromancer"){var vysledek ="<?php echo getSpec("Necromancer")?>";}
                else if(document.getElementById('class').value == "Thief"){var vysledek ="<?php echo getSpec("Thief")?>";}
                else if(document.getElementById('class').value == "Elementalist"){var vysledek ="<?php echo getSpec("Elementalist")?>";}
                else if(document.getElementById('class').value == "Warrior"){var vysledek ="<?php echo getSpec("Warrior")?>";}
                else if(document.getElementById('class').value == "Ranger"){var vysledek ="<?php echo getSpec("Ranger")?>";}
                else if(document.getElementById('class').value == "Mesmer"){var vysledek ="<?php echo getSpec("Mesmer")?>";}
                else if(document.getElementById('class').value == "Guardian"){var vysledek ="<?php echo getSpec("Guardian")?>";}
                else if(document.getElementById('class').value == "Revenant"){var vysledek ="<?php echo getSpec("Revenant")?>";}         

                var opt = document.getElementById("spec");
                while (opt.hasChildNodes()) {  
                opt.removeChild(opt.firstChild);
                }    
                if(document.getElementById('class').value != "error"){  
                    var output = vysledek.split(",");
                    for(var i = 0; i < pocet; i++)
                    {
                        var pomoc = document.createElement("OPTION");
                        pomoc.innerHTML = output[i];
                        document.getElementById("spec").appendChild(pomoc);
                    }
                }
                });
            </script>
            </select> <br>
            <p>
            <label for="spec_2">Vedlejší specializace 1</label> 
            </p>
            <select name="spec_2" id="spec_2">
            <script>
                document.getElementById('class').addEventListener('change', function(e){
                console.log(document.getElementById('class').value);
                document.cookie="classa="+document.getElementById('class').value;
                
                let pocet = 7;
                
                if(document.getElementById('class').value == "Engineer"){var vysledek = "<?php echo getSpec("Engineer"); ?>"; }
                else if(document.getElementById('class').value == "Necromancer"){var vysledek ="<?php echo getSpec("Necromancer")?>";}
                else if(document.getElementById('class').value == "Thief"){var vysledek ="<?php echo getSpec("Thief")?>";}
                else if(document.getElementById('class').value == "Elementalist"){var vysledek ="<?php echo getSpec("Elementalist")?>";}
                else if(document.getElementById('class').value == "Warrior"){var vysledek ="<?php echo getSpec("Warrior")?>";}
                else if(document.getElementById('class').value == "Ranger"){var vysledek ="<?php echo getSpec("Ranger")?>";}
                else if(document.getElementById('class').value == "Mesmer"){var vysledek ="<?php echo getSpec("Mesmer")?>";}
                else if(document.getElementById('class').value == "Guardian"){var vysledek ="<?php echo getSpec("Guardian")?>";}
                else if(document.getElementById('class').value == "Revenant"){var vysledek ="<?php echo getSpec("Revenant")?>";}         

                var opt = document.getElementById("spec_2");
                while (opt.hasChildNodes()) {  
                opt.removeChild(opt.firstChild);
                }    
                if(document.getElementById('class').value != "error"){  
                    var output = vysledek.split(",");
                    var pomoc = document.createElement("OPTION");
                        pomoc.innerHTML = "Dobrovolné";
                        document.getElementById("spec_2").appendChild(pomoc);
                    for(var i = 0; i < pocet; i++)
                    {
                        var pomoc = document.createElement("OPTION");
                        pomoc.innerHTML = output[i];
                        document.getElementById("spec_2").appendChild(pomoc);
                    }
                }
                });
            </script>
            
            </select> <br>
            <p>
            <label for="spec_3">Vedlejší specializace 2</label> 
            </p>
            <select name="spec_3" id="spec_3">
            <script>
                document.getElementById('class').addEventListener('change', function(e){
                console.log(document.getElementById('class').value);
                document.cookie="classa="+document.getElementById('class').value;
                
                let pocet = 7;
                
                if(document.getElementById('class').value == "Engineer"){var vysledek = "<?php echo getSpec("Engineer"); ?>"; }
                else if(document.getElementById('class').value == "Necromancer"){var vysledek ="<?php echo getSpec("Necromancer")?>";}
                else if(document.getElementById('class').value == "Thief"){var vysledek ="<?php echo getSpec("Thief")?>";}
                else if(document.getElementById('class').value == "Elementalist"){var vysledek ="<?php echo getSpec("Elementalist")?>";}
                else if(document.getElementById('class').value == "Warrior"){var vysledek ="<?php echo getSpec("Warrior")?>";}
                else if(document.getElementById('class').value == "Ranger"){var vysledek ="<?php echo getSpec("Ranger")?>";}
                else if(document.getElementById('class').value == "Mesmer"){var vysledek ="<?php echo getSpec("Mesmer")?>";}
                else if(document.getElementById('class').value == "Guardian"){var vysledek ="<?php echo getSpec("Guardian")?>";}
                else if(document.getElementById('class').value == "Revenant"){var vysledek ="<?php echo getSpec("Revenant")?>";}         

                var opt = document.getElementById("spec_3");
                while (opt.hasChildNodes()) {  
                opt.removeChild(opt.firstChild);
                }    
                if(document.getElementById('class').value != "error"){  
                    var output = vysledek.split(",");
                    var pomoc = document.createElement("OPTION");
                        pomoc.innerHTML = "Dobrovolné";
                        document.getElementById("spec_3").appendChild(pomoc);
                    for(var i = 0; i < pocet; i++)
                    {
                        var pomoc = document.createElement("OPTION");
                        pomoc.innerHTML = output[i];
                        document.getElementById("spec_3").appendChild(pomoc);
                    }
                }
                });
            </script>
            
            </select> <br>
            <p>
                <label for="guild">Guilda</label> 
            </p>
            <input type="text" id="guild" name="guild" placeholder="Dobrovolné"> <br>
            <p>    
                <label for="description">Popis postavy</label> 
            </p>
            <input type="text"  name="description" id="description" placeholder="Dobrovolné"> <br>
            <p>
                <label for="picture">Fotka</label> 
            </p>
            <input type="file" required name="picture" id="picture"> <br>
            <input type="submit">
        </form>
    </section>
    <?php 
       if(!empty($_POST["username"]) && !empty($_POST["server"])  && !empty($_POST["name"]) && !empty($_POST["race"]) && !empty($_POST["class"]) && !empty($_FILES["picture"])){
            $user = $_SESSION["userId"];
            $server = $_POST["server"];
            $name = $_POST["name"];
            $race = $_POST["race"];
            $class = $_POST["class"];
            $spec = $_POST["spec"];
            $guild = $_POST["guild"];
            $popis = $_POST["description"];
            if($_POST["spec_2"] != "Dobrovolné"){
            $spec2 = $_POST["spec_2"];}
            else $spec2 = "";
            if($_POST["spec_3"] != "Dobrovolné"){
            $spec3 = $_POST["spec_3"];}
            else $spec3 = "";
            $wholename = $name . "_" . $server;
            $filename  = $wholename . "." . pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);       
                
            if(file_exists("img/".$wholename."."."png")){
                $dotDrop = "DELETE FROM `gw` WHERE wholeName = '{$wholename}'";
                mysqli_query($conn,$dotDrop);
                echo mysqli_error($conn);
                unlink("img/".$wholename."."."png");
            }
            else if(file_exists("img/".$wholename."."."jpg")){
                $dotDrop = "DELETE FROM `gw` WHERE wholeName = '{$wholename}'";
                mysqli_query($conn,$dotDrop);
                echo mysqli_error($conn);               
                unlink("img/".$wholename."."."jpg");
            }
            move_uploaded_file($_FILES["picture"]["tmp_name"],"img/".$filename);
            $dotVloz = "INSERT INTO gw (user, name, server, guild, race, class, spec, spec_2, spec_3, file_name, popis, wholeName) VALUES('{$user}', '{$name}', '{$server}', '{$guild}', '{$race}', '{$class}', '{$spec}', '{$spec2}', '{$spec3}', '{$filename}', '{$popis}', '{$wholename}')";
            mysqli_query($conn,$dotVloz);
            //echo $dotVloz;
            echo mysqli_error($conn);

       }
    ?>
</body>
</html>
