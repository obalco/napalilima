<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" lang="sk">

<html>
<head>
	<title>Napalil ma!</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" >
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<form method="post">
				Hladat <input name="hladat" type="text" /><input type="submit" value="Hladat" />
</form>
<?php
$hladat = $_POST['hladat'];
mysql_connect("localhost","root","root");
$result=mysql("napalilima","select * from staznosti where Ako = '$hladat'");
$pocet=mysql_numrows($result);
echo 'V tabulke "Napalili ma" je '.$pocet.' staznosti.';
echo '<table border="1">';
for($i=0; $i<$pocet; $i++)
{
echo '<tr>';
echo '<td align="center">'.mysql_result($result, $i, "Kto").'</td>';
echo '<td>'.mysql_result($result, $i, "Ako").'</td>';
echo '<td>'.mysql_result($result, $i, "Kedy").'</td>';
echo '<td>'.mysql_result($result, $i, "Nick").'</td>';
echo '<td align="right">'.mysql_result($result, $i, "Mail").'</td>';
echo '</tr>';
}
mysql_close();
?>
</table>
</body>

