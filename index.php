<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" lang="sk">

<html>
<head>
	<title>Vyhladavanie!</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" >
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <!-- Tabulky ma uz nebavia -->
  <img class="logo" src="images/napalilima_logo.png" alt="Napalili ma Logo" height="70" />
      
  <form class="hladat" action="hladat.php" method="post">
  Hladat <input name="hladat" type="text" /><input type="submit" value="Hladat" />
  </form>
       
   
    <div class="popis">
      Využite možnosť ventilovať svoj hnev a pomôžte iným vyhnúť sa problémom
      </div>
      <div class="staznost">
      <?php
        echo '<form method="post">
     		Co/Kto?:<input type="textarea" width="200" name="kto"><br/>
            Ako/Cim:<input type="textarea" name="content" width="200" rows="5" cols="50"><br/>
            Nick:<input type="text" name="nick"><br />  
            Kedy:<input type="text" name="kedy"><br />
            E-mail:<input type="text" name="mail"><br/>
            <input type="submit" value="Send" name="send">
            <input type="reset" value="Reset">
        </form>';
		        
      if(isset($_POST['send'] ))
      {
        
            @$spojenie = mysql_connect("localhost","root","root");
              if (!$spojenie)
              {
                echo "<p>Nepodarilo sa pripojiďż˝ k databďż˝ze!</p>";
              }
              else
              {
              	$kto = $_POST['kto'];
				$content = $_POST['content'];
				$kedy = $_POST['kedy'];
				$nick = $_POST['nick'];
				$mail = $_POST['mail'];
                @$vysledok = mysql("napalilima",
                "insert into staznosti values(
                '$kto', '$content', '$kedy',
                '$nick', '$mail')");
                  if (!$vysledok)
                  {
                        echo "<p>Novďż˝ zďż˝znam sa nepodarilo pridaďż˝!</p>";
                  }
                  else
                  {
                        echo "<p>Dakujeme za vasu skusenos,urcite pomoze ostatnym.</p>";  
                  }
                 mysql_close($spojenie);
               }
            } 
      ?>
      </div>
</body>
</html>