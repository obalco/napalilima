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
  $("#staznost").autocomplete("js/autocomplete.php", {
         selectFirst: false,
		 minLength:	2,
		 minChars: 2,
		 delay: 100
		 });
 });
</script>
</head>
<body>
<div class="hlavicka">
  <!-- Tabulky ma uz nebavia -->
  <img class="logo" src="images/napalilima_logo.png" alt="Napalili ma Logo" height="70" />
      
  <form class="hladat" action="hladat.php" method="post">
  Hladať 
  <input name="hladat" type="text" id="staznost" size="20"  /><input name="search" type="submit" value="Hladať" />
  </form>       
    <div class="popis">
      Využite možnosť ventilovať svoj hnev a pomôžte iným vyhnúť sa problémom
      </div>
      
</div>
<div class="telo">
    <p class="registration">Vyuzite rozsirene moznosti po zaregistrovani. Je to zadarmo a trva 2 minutky. Click here</p>
      <div class="staznost">
      <?php
	  session_start();
	  include('errors.php');
	  include('functions.php');
		
	  echo '<form  method="post">
            Co/Kto:<br /><textarea cols="60" rows="1" name="staznost_na"></textarea><br/>
            Ako/Cim:<br /><textarea name="staznost" rows="5" cols="60"></textarea><br/><br/>
            Nick:<input type="text" name="nick"> 
            Kedy:<input type="text" name="staznost_kedy">
            E-mail:<input type="text" name="email"><br/>
            <p><input type="submit" value="Send" name="send"></p>
        </form>';
		        
      if(isset($_POST['send'] ))
      {
     
				$staznost_na   = $_POST['staznost_na'];
				$staznost      = $_POST['staznost'];
				$staznost_kedy = $_POST['staznost_kedy'];
				$nick 		   = $_POST['nick'];
				$email 		   = $_POST['email'];
				$ip			   = getIpAddress();
				$message="";
				
				
				
				if(!empty($staznost_na)){$bool_staznost_na = true;}		else {$bool_staznost_na = false; $message .= $error[1];}
				if(!empty($staznost)){$bool_staznost = true;}			else {$bool_staznost = false; $message .= $error[2];}
				if(!empty($staznost_kedy)){$bool_staznost_kedy = true;}	else {$bool_staznost_kedy = false; $message .= $error[3];}
				if(!empty($nick)){$bool_nick = true;}					else {$bool_nick = false; $message .= $error[4];}
				if(!empty($email)){$bool_email = true;}					else {$bool_email = false; $message .= $error[5];}
				
				if ($bool_staznost_na==true && $bool_staznost==true && $bool_staznost_kedy==true &&  $bool_nick ==true && $bool_email==true){
					include('db.php');
					$sql = "INSERT INTO staznosti (staznost_na, staznost, staznost_kedy, nick, email, datum_staznost , ip  , browser) 
										   VALUES ('$staznost_na','$staznost','$staznost_kedy', '$nick', '$email', NOW(), '$ip', 'browser')";
					$res = mysql_query($sql);
					header("Location:index.php");
				}
				else
				{
					echo $message;
				}
				
		} 
      ?>
      </div>
      </div>
</body>
</html>