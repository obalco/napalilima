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
				Hladať <input name="hladat" type="text"/><input name="search" type="submit" value="Hladať" />
</form>
<?php
	if(isset($_POST['search'])){
		include('db.php');
		$claim = mysql_real_escape_string($_POST['hladat']);

		$sql="SELECT * FROM claims WHERE claim='$claim'";
		$res=mysql_query($sql);

		$pocet=mysql_num_rows($res);

		
		$i=0;
		echo '<div id="pole_staznosti">';
		
		while($zaznam = mysql_fetch_assoc($res))
		{
			//$nick 		   = $zaznam['nick'];	
			$claim_at   = $zaznam['staznost_na'];
			$claim_date = $zaznam['staznost_kedy'];
			$claim 	   = $zaznam['staznost'];
			//$email		   = $zaznam['email'];
			$claim_date         = $zaznam['claim_date'];
			$i++;

			echo '<div id="hlavicka_staznosti">';
				echo '<b>Nick: </b>'.NICK.' | <b>Sťažnosť na: </b>'.$claim_at.' | <b>Sťažnosť na: </b>'.$claim_date.' | <b>E-mail: </b>'.MAIL.' | <b>Dátum odoslania: </b>'.$claim_date;
					echo '<div id="staznost_a">'.$claim.'</div>';
			echo'</div>';
		
		}
	echo'</div>';
		mysql_close();
	}
?>
</table>
</body>

