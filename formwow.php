<?php session_start();
   if(!is_dir("./img"))
   {
     mkdir('./img');
   }
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
        $raceAL = "SELECT * FROM race WHERE frakce = 'Alliance'";
        $raceHO = "SELECT * FROM race WHERE frakce = 'Horde'";

        if($susenka == "Alliance"){
            $vysledek = mysqli_query($connf,$raceAL);
        }
        else if($susenka == "Horde"){
            $vysledek = mysqli_query($connf,$raceHO);
        }
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
        
 
        $specDK = "SELECT * FROM spec WHERE Class = 'Death Knight' && game = 'wow'";
        $specDH = "SELECT * FROM spec WHERE Class = 'Demon Hunter' && game = 'wow'";
        $specDR = "SELECT * FROM spec WHERE Class = 'Druid' && game = 'wow'";
        $specHU = "SELECT * FROM spec WHERE Class = 'Hunter' && game = 'wow'";
        $specMA = "SELECT * FROM spec WHERE Class = 'Mage' && game = 'wow'";
        $specMO = "SELECT * FROM spec WHERE Class = 'Monk' && game = 'wow'";
        $specPA = "SELECT * FROM spec WHERE Class = 'Paladin' && game = 'wow'";
        $specPR = "SELECT * FROM spec WHERE Class = 'Priest' && game = 'wow'";
        $specRO = "SELECT * FROM spec WHERE Class = 'Rogue' && game = 'wow'";
        $specSH = "SELECT * FROM spec WHERE Class = 'Shaman' && game = 'wow'";
        $specWL = "SELECT * FROM spec WHERE Class = 'Warlock' && game = 'wow'";
        $specWR = "SELECT * FROM spec WHERE Class = 'Warrior' && game ='wow'";

        if($susenka == "Death Knight"){
            $vysledek = mysqli_query($connf,$specDK);
        }
        else if($susenka == "Demon Hunter"){
            $vysledek = mysqli_query($connf,$specDH);
        }
        else if($susenka == "Druid"){
            $vysledek = mysqli_query($connf,$specDR);
        }
        else if($susenka == "Hunter"){
            $vysledek = mysqli_query($connf,$specHU);
        }
        else if($susenka == "Mage"){
            $vysledek = mysqli_query($connf,$specMA);
        }
        else if($susenka == "Monk"){
            $vysledek = mysqli_query($connf,$specMO);
        }
        else if($susenka == "Paladin"){
            $vysledek = mysqli_query($connf,$specPA);
        }
        else if($susenka == "Priest"){
            $vysledek = mysqli_query($connf,$specPR);
        }
        else if($susenka == "Rogue"){
            $vysledek = mysqli_query($connf,$specRO);
        }
        else if($susenka == "Shaman"){
            $vysledek = mysqli_query($connf,$specSH);
        }
        else if($susenka == "Warlock"){
            $vysledek = mysqli_query($connf,$specWL);
        }
        else if($susenka == "Warrior"){
            $vysledek = mysqli_query($connf,$specWR);
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
    <title>PH Kabel WOW</title>
</head>
<body style="background-color: #979797;" id="wow">   
    
    <?php
        include 'servery.phmtl';
    ?>
    <section>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" placeholder="Usename" value="<?=$_SESSION["userId"] ?>" id="username" name="username"><!-- Z loginu -->
            <p>
                <label for="server">Server</label> 
            </p>
            <input type="text" name="server" id="server" required list="servers" placeholder="Vyberte si server"> <br>        
            <p>            
                <label for="frakce">Frakce</label>           
            </p>
            <select name="frakce" id="frakce">
                <option value="error">Vyberte frakci</option>
                <option value="Alliance">Aliance</option>
                <option value="Horde">Horda</option>
            </select> <br>
            <p>
                <label for="char">Jméno postavy</label> 
            </p>
            <input type="text" required name="name" id="char"> <br>
            <p>
                <label for="race">Rasa</label>
            </p>
            <select name="race" id="race">
            <script>
            console.log(document.getElementById('frakce'));
                document.getElementById('frakce').addEventListener('change', function(e){
                console.log(document.getElementById('frakce').value);
                document.cookie="frakce="+document.getElementById('frakce').value;
                
                let pocet = 12;
                if(document.getElementById('frakce').value == "Alliance"){var vysledek = "<?php echo getRace("Alliance");?>"}
                else if(document.getElementById('frakce').value == "Horde"){var vysledek = "<?php echo getRace("Horde"); ?>"}      

                var opt = document.getElementById("race");
                while (opt.hasChildNodes()) {  
                    opt.removeChild(opt.firstChild);
                }    
                if(document.getElementById('frakce').value != "error"){ 
                    var output = vysledek.split(",");
                    for(var i = 0; i < pocet; i++)
                    {
                        var pomoc = document.createElement("OPTION");
                        pomoc.innerHTML = output[i];
                        document.getElementById("race").appendChild(pomoc);
                    }
                }
                });
            </script>
            
            </select> <br> 
            <p>
                <label for="class">Class</label> 
            </p>
            <select name="class" id="class">
                <option value="error">Vyber classu</option>
                <option value="Death Knight">Death Knight</option>
                <option value="Demon Hunter">Demon Hunter</option>
                <option value="Druid">Druid</option>
                <option value="Hunter">Hunter</option>
                <option value="Mage">Mage</option>
                <option value="Monk">Monk</option>
                <option value="Paladin">Paladin</option>
                <option value="Priest">Priest</option>
                <option value="Rogue">Rogue</option>
                <option value="Shaman">Shaman</option>
                <option value="Warlock">Warlock</option>
                <option value="Warrior">Warrior</option>
            </select> <br>
            <p>
                <label for="spec">Specializace</label> 
            </p>
            <select name="spec" id="spec">
            <script>
                document.getElementById('class').addEventListener('change', function(e){
                console.log(document.getElementById('class').value);
                document.cookie="classa="+document.getElementById('class').value;
                
                let pocet = 3;
                if(document.getElementById('class').value == "Death Knight"){var vysledek = "<?php echo getSpec("Death Knight");?>"}
                else if(document.getElementById('class').value == "Demon Hunter"){var vysledek = "<?php echo getSpec("Demon Hunter"); ?>"; pocet = 2;}
                else if(document.getElementById('class').value == "Druid"){var vysledek ="<?php echo getSpec("Druid")?>"; pocet = 4;}
                else if(document.getElementById('class').value == "Hunter"){var vysledek ="<?php echo getSpec("Hunter")?>";}
                else if(document.getElementById('class').value == "Mage"){var vysledek ="<?php echo getSpec("Mage")?>";}
                else if(document.getElementById('class').value == "Monk"){var vysledek ="<?php echo getSpec("Monk")?>";}
                else if(document.getElementById('class').value == "Paladin"){var vysledek ="<?php echo getSpec("Paladin")?>";}
                else if(document.getElementById('class').value == "Priest"){var vysledek ="<?php echo getSpec("Priest")?>";}
                else if(document.getElementById('class').value == "Rogue"){var vysledek ="<?php echo getSpec("Rogue")?>";}
                else if(document.getElementById('class').value == "Shaman"){var vysledek ="<?php echo getSpec("Shaman")?>";}
                else if(document.getElementById('class').value == "Warlock"){var vysledek ="<?php echo getSpec("Warlock")?>";}
                else if(document.getElementById('class').value == "Warrior"){var vysledek ="<?php echo getSpec("Warrior")?>";}           

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
                <label for="guild">Guilda</label> 
            </p>
            <input type="text" id="guild" name="guild" placeholder="Dobrovolné"> <br>
            <p>    
                <label for="description">Popis postavy</label> 
            </p>
            <input type="text"  name="description" id="description" placeholder="Dobrovolné"> <br>
            <p>
                <label for="links">Odkazy (Raider io, WOW progress...)</label> 
            </p>
            <input type="text"  name="links" id="links" placeholder="Dobrovolné"> <br>
            <p>
                <label for="picture">Fotka</label> 
            </p>
            <input type="file" required name="picture" id="picture"> <br>
            <input type="submit">
        </form>
    </section>
    <?php 
       if(!empty($_POST["username"]) && !empty($_POST["server"]) && !empty($_POST["frakce"]) && !empty($_POST["name"]) && !empty($_POST["race"]) && !empty($_POST["class"]) && !empty($_FILES["picture"])){
            $user = $_SESSION["userId"];
            $server = $_POST["server"];
            $frakce = $_POST["frakce"];
            $name = $_POST["name"];
            $race = $_POST["race"];
            $class = $_POST["class"];
            $spec = $_POST["spec"];
            $guild = $_POST["guild"];
            $popis = $_POST["description"];
            $links = $_POST["links"];
            $wholename = $name . "_" . $server;
            $filename  = $wholename . "." . pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);       
                
            if(file_exists("img/".$wholename."."."png")){
                $dotDrop = "DELETE FROM `wow` WHERE wholeName = '{$wholename}'";
                mysqli_query($conn,$dotDrop);
                echo mysqli_error($conn);
                unlink("img/".$wholename."."."png");
            }
            else if(file_exists("img/".$wholename."."."jpg")){
                $dotDrop = "DELETE FROM `wow` WHERE wholeName = '{$wholename}'";
                mysqli_query($conn,$dotDrop);
                echo mysqli_error($conn);               
                unlink("img/".$wholename."."."jpg");
            }
            
            
            $dotVloz = "INSERT INTO wow (username, name, server, guild, faction, race, class, spec, filename, popis, links, wholeName) VALUES('{$user}', '{$name}', '{$server}', '{$guild}', '{$frakce}', '{$race}', '{$class}', '{$spec}', '{$filename}', '{$popis}', '{$links}', '{$wholename}')";
            //echo $dotVloz;
            move_uploaded_file($_FILES["picture"]["tmp_name"],"img/".$filename);
            mysqli_query($conn,$dotVloz);
            //echo $dotVloz;
            echo mysqli_error($conn);
            header("Location: forumwow.php");
            exit();
            
       }
    ?>
</body>
</html>
