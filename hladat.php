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
<form method="post">
				Hladat <input name="hladat" type="text" id="staznost" /><input type="submit" value="Hladať" />
</form>
<?php

include('db.php');
$sql="SELECT * FROM staznosti  WHERE staznost=".mysql_real_escape_string($_POST['hladat']);
$res=mysql_query($sql);

$pocet=mysql_num_rows($res);
echo 'V tabulke "Napalili ma" je '.$pocet.' staznosti.';
echo '<table border="1">';
 $i=0;
 while($zaznam = mysql_fetch_assoc($res))
{
				$staznost_na   = $zaznam['staznost_na'];
				$staznost 	   = $zaznam['staznost'];
				$staznost_kedy = $zaznam['staznost_kedy'];
				$nick 		   = $zaznam['nick'];
				$email		   = $zaznam['email'];
				$i++;

echo '<tr>';
echo '<td>'.$i.'.'.'</td>';
echo '<td align="center">'.$staznost_na.'</td>';
echo '<td>'.$staznost.'</td>';
echo '<td>'.$staznost_kedy.'</td>';
echo '<td>'.$nick.'</td>';
echo '<td align="right">'.$email.'</td>';
echo '</tr>';
}
mysql_close();
?>
</table>
</body>

