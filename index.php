<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" lang="sk">

<html>
<head>
	<title>Vyhladavanie!</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" >
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <table width="1200">
  	<tr>
  		<td>
  			<img src="images/napalilima_logo.png" alt="Napalili ma Logo" />
		</td>
  		<td align="right">
  			<form action="hladat.php" method="post">
				Hladat <input name="hladat" type="text" /><input type="submit" value="Hladat" />
			</form>
		</td>
  	</tr>
    <tr>
      <td>
       <div>Popis sluzby<div>
      </td>
    <td>
<?php
	echo '<form method="post">
     		 Co/Kto?:<input type="text"  name="kto"><br/>
            Ako/Cim:<input type="text" name="content" width="200" rows="5" cols="50"><br/>
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
                echo "<p>Nepodarilo sa pripoji� k datab�ze!</p>";
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
                        echo "<p>Nov� z�znam sa nepodarilo prida�!</p>";
                  }
                  else
                  {
                        echo "<p>Dakujeme za vasu skusenos,urcite pomoze ostatnym.</p>";  
                  }
                 mysql_close($spojenie);
               }
            } 
?>
</td>
</tr>

</table>
</body>
</html>