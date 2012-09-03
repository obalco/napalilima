<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" lang="sk">

<html>
<head>
	<title>Napalil ma|Vypis!</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" >
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<form method="post" action="">
				Hladať <input name="hladat" type="text" id="staznost" /><input name="search" type="submit" value="Hladať" />
</form>
<?php
		include('db.php');

		$sql="SELECT * FROM staznosti";
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
			$datum         = date("d.m.Y \o H:i",strtotime($zaznam['datum_staznost']));
			$i++;

			echo '<div id="hlavicka_staznosti">';
				echo '<b>Nick: </b>'.$nick.' | <b>Sťažnosť na: </b>'.$staznost_na.' | <b>Sťažnosť na: </b>'.$staznost_kedy.' | <b>E-mail: </b>'.$email.' | <b>Dátum odoslania: </b>'.$datum;
					echo '<div id="staznost_a">'.$staznost.'</div>';
			echo'</div>';
		
		}
	echo'</div>';
		mysql_close();
?>
</table>
</body>