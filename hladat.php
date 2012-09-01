<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" lang="sk">

<html>
<head>
	<title>Napalil ma!</title>
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
<form method="post" action="">
				Hladať <input name="hladat" type="text" id="staznost" /><input name="search" type="submit" value="Hladať" />
</form>
<?php
	if(isset($_POST['search'])){
		include('db.php');
		$staznost =mysql_real_escape_string($_POST['hladat']);

		$sql="SELECT * FROM staznosti WHERE staznost='$staznost'";
		$res=mysql_query($sql);

		$pocet=mysql_num_rows($res);

		
		$i=0;
		echo '<div id="pole_staznosti">';
		
		while($zaznam = mysql_fetch_assoc($res))
		{
			$nick 		   = $zaznam['nick'];	
			$staznost_na   = $zaznam['staznost_na'];
			$staznost_kedy = $zaznam['staznost_kedy'];
			$staznost 	   = $zaznam['staznost'];
			$email		   = $zaznam['email'];
			$i++;

			echo '<div id="hlavicka_staznosti">';
				echo '<b>Nick: </b>'.$nick.' | <b>Sťažnosť na: </b>'.$staznost_na.' | <b>Sťažnosť napísaná: </b>'.$staznost_kedy.' | <b>E-mail: </b>'.$email;
					echo '<div id="staznost_a">'.$staznost.'</div>';
			echo'</div>';
		
		}
		
			echo'</div>';
		echo '<br />V tabulke "Napalili ma" je '.$pocet.' staznosti.';
		mysql_close();
	}
?>
</table>
</body>

