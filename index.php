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
  <!-- Tabulky ma uz nebavia -->
  <img class="logo" src="images/napalilima_logo.png" alt="Napalili ma Logo" height="70" />
      
  <form class="hladat" action="hladat.php" method="post">
  Hladat 
  <input name="hladat" type="text" id="staznost" size="20"  /><input type="submit" value="Hladat" />
  </form>
       
   
    <div class="popis">
      Využite možnosť ventilovať svoj hnev a pomôžte iným vyhnúť sa problémom
      </div>
      <div class="staznost">
   
      <?php
	  include('errors.php');
	  include('functions.php');

	  echo '<form action="send.php" method="post" >
            Co/Kto:<br /><textarea cols="60" rows="1" name="staznost_na"></textarea><br/>
            Ako/Cim:<br /><textarea name="staznost" rows="5" cols="60"></textarea><br/><br/>
            Nick:<input type="text" name="nick"> 
            Kedy:<input type="text" name="staznost_kedy">
            E-mail:<input type="text" name="email"><br/>
            <p><input type="submit" value="Send" name="send"></p>
        </form>';
		        
      if(isset($_POST['send'] ))
      {
      include('db.php');
				
        $staznost_na   = $_POST['staznost_na'];
				$staznost      = $_POST['staznost'];
				$staznost_kedy = $_POST['staznost_kedy'];
				$nick 		   = $_POST['nick'];
				$email 		   = $_POST['email'];
				$ip			   = getIpAddress(); 
                
				$sql = "INSERT INTO staznosti (staznost_na, staznost, staznost_kedy, nick, email, datum_staznost , ip  , browser) 
									   VALUES ('$staznost_na','$staznost','$staznost_kedy', '$nick', '$email', NOW(), '$ip', 'browser')";
				$req = mysql_query($sql);
				//header('Location: send.php');
            } 
      ?>
      </div>
</body>
</html>