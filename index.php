<?php
    //error_reporting(1);
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" lang="sk">

<html>
<head>
	<title>Vyhladavanie!</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" >
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<script>
 $(document).ready(function(){
    $("#hladat").autocomplete("js/autocomplete.php", {
         selectFirst: false,
		 minLength:	2,
		 minChars: 2,
		 delay: 100
	});
 });
 </script>
</head>
<body>
<?php
     if (!isset($_SESSION['logged'])){
		print '<div id="logger"> <div class="logger_inputs"><b><a href="req.php?req=reg">Registrácia</a> | <a href="req.php?req=log">Prihlásenie</a></b></div></div>';
	}
	else
	{
		print '<div id="logger"> <div class="logger_inputs"><b><i><u>TU BUDE NICK</u></i> => | Nastavenie | Profil | <a href="req.php?req=out">Odhlásiť</a> | </div></div>';
	}
	// </b> <b> | NICK: </b> <input type="text" /> <b> HESLO: </b> <input type="password" / > <input class ="tlacitko" name="log_me" type="submit" value="Log me" />
	 
	
?>
<div id="container"> <!-- zaciatok containeru!-->
  <div id="header"> <!-- zaciatok headeru!-->
	<a href="index.php"><img class="logo" src="images/napalilima_logo.png" alt="Napalili ma Logo" height="70" /> </a>
		
  </div><!-- koniec headeru!-->
		<div id="input_search">
			<form action="hladat.php" method="post">
				<input name="hladat" type="text" id="hladat" size="20"  />&nbsp;<input name="search" type="submit" value="Hladať" />
			</form>
		</div>
  
  <div id="content"><!-- zaciatok contentu!-->
  
        
   
       
          <?php
            include('errors.php');
            include('functions.php');
      
            echo '<br />
			 <div id="nova_staznost"> <!-- zaciatok novej staznosti!-->
				  <form method="post">
                    Kto/Co: <br /><input type="text" name="claim_at" cols="35"> <br/>
                    Ako/Cim:<br /><textarea name="claim" rows="5" cols="100"></textarea><br/><br/>
                    <input type="submit" value="Odoslať sťažnosť" name="send">
                  </form>
			 </div>'; echo'<!-- koniec novej_staznosti!-->';
                
            if(isset($_POST['send'] ))
              {
				$message="";
                $claim_at   = mysql_real_escape_string(trim($_POST['claim_at']));
                $claim      = mysql_real_escape_string(trim($_POST['claim']));
                $claim_date = date("d.m.Y");
                //$nick 		= mysql_real_escape_string(trim($_POST['nick']));
                //$email 		= mysql_real_escape_string(trim($_POST['email']));
                //$ip			= getIpAddress();
				
				// slovo ln spojene s premennou bude oznacovat dlzku retazca premennej
				// slovo ok budeme spajat s premenou a bude typu boolean
				$ln_claim_at = strlen($claim_at);
				$ln_claim    = strlen($claim);

				if($ln_claim_at > 3 && $ln_claim_at < 50) {$ok_claim_at = true; } else {$ok_claim_at = false; $message.=$error[1];}
				if($ln_claim > 5 && $ln_claim < 200) {$ok_claim = true; } 	 	 else {$ok_claim = false; $message.=$error[2];}
				// blo by fajn keby nick a mail sa dava do session :) teda pri logovaní :)
				
            
                if ($ok_claim_at === true && $ok_claim === true)
                  {
                    include('db.php');
                    $sql  = "INSERT INTO claims (claim_at, claim, claim_date ) 
                             VALUES ('$claim_at','$claim','$claim_date')";
					$res  = mysql_query($sql);
					$id_s = mysql_insert_id(); // funkcia mysql_insert_id dostava poslednu autoinkrementovanu hodnotu primarneho kluca u nas to je id 
					
					$sql  = $vys = ""; // pre istotu vynulovanie premennych
					$vys  = mysql_query($sql);
                    header("Location:index.php");
                  }
                else
                  {
                    echo $message;
                  }
              }
          ?>
		  
     <br />
        <?php
          include('db.php');
                  
          $sql="SELECT * FROM claims order BY id DESC LIMIT 10 ";
          $res=mysql_query($sql);
          $pocet=mysql_num_rows($res);
          
          $i=0;
        echo '<div id="pole_staznosti">';
      
          while($zaznam = mysql_fetch_assoc($res))
            {
              //$nick 	   = $zaznam['nick'];	
              $claim_at    = $zaznam['claim_at'];
             // $claime_date = $zaznam['claime_date']; toto je hlupost z toho pohladu kontorly a podobne kto si bude pamatat daum je to nepodstatne !!!
              $claim	   = $zaznam['claim'];
             // $email	   = $zaznam['email'];
              $claim_date  = $zaznam['claim_date'];
              $i++;

			  echo'<div id="hlavicka_staznosti"> <!-- zaciatok hlavicka_staznosti!-->';
				  echo "<b>Nick: </b>'.'NICK'.' | <b>Sťažnosť na: </b>'.$claim_at.' | <b>Sťažnosť kedy: </b>'.$claim_date.' | <b>E-mail: </b>'.'MAIL'.'" ;
				  echo '<p id="staznost_a">'.$claim.'</p>';
				  echo '<div class="add_comment"><a href="#">Pridať komentár</a></div>';
              echo'</div><!-- koniec hlavicka_staznosti !-->'; 
           }
		  
                
          if(isset($_POST['comment'] ))
              {
                $autor  = $_POST['autor'];
                $komentar  = $_POST['komentar'];

             //   if(!empty($autor)){$bool_staznost_na = true;} else {$bool_staznost_na = false; $message .= $error[1];}
             //  if(!empty($komentar)){$bool_staznost = true;} else {$bool_staznost = false; $message .= $error[2];}
                
              //  if ($bool_staznost_na==true && $bool_staznost==true && $bool_staznost_kedy==true &&  $bool_nick ==true && $bool_email==true)
              //    {
                   // include('db.php');
                    //$sql  = "INSERT INTO comments (autor, comment, ip) 
                      //       VALUES ('$autor','$komentar', NOW(), '$ip')";
					//$res  = mysql_query($sql);
					//$id_s = mysql_insert_id(); // funkcia mysql_insert_id dostava poslednu autoinkrementovanu hodnotu primarneho kluca u nas to je id 
					
					//$sql  = $vys = ""; // pre istotu vynulovanie premennych
                  
					//$vys  = mysql_query($sql);
                   // header("Location:index.php");
                //  }
                }
         
         
         $sql="SELECT * FROM claims ";
         $res=mysql_query($sql);
         $pocet=mysql_num_rows($res);
         
         if($pocet>10) 
            {
             echo '<p><a href="vypis.php">Ďalej</a></p>';
            }
		echo'</div>';
		

		?>
		<br />
		<div id="pata"> <!-- zaciatok paty!-->
			  <p align="center" class="pata">Code and Design by <a href="http://www.am.6f.sk" target="_blank"><img src="images/am_logo.png"  height="15" alt="AM PAGE Andrej Majik Logo"></a>
			  and <a href="http://www.obalco.sk" target="_blank"><img src="images/obalco.png" height="15" alt="OBALCO logo"></a></p>
	    </div>
		<br />
		<!-- koniec paty!-->
		
	</div> <!-- ukoncenie contentu!-->
		
</div> <!-- ukoncenie containeru!-->

 
</body>
</html>