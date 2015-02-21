<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Recommender System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="styles.css" type="text/css" />
</head>
<body>
<h1>Odporucania produktov</h1>
<hr />
<div id="dolphincontainer">
  <div id="dolphinnav">
    <ul>
      <li><a href="http://localhost/recommendations.php" ><span>Najpredavanejsie celkovo</span></a></li>
      <li><a href="http://localhost/recommendations_category.php"><span>Najpredavanejsie v kategorii</span></a></li>
      <li><a href="http://localhost/recommendations_time.php"><span>Najpredavanejsie v case</span></a></li>
      <li><a href="http://localhost/recommendations_random.php"  class="current"><span>Nahodne</span></a></li>
      <li><a href="http://localhost/recommendations_special.php"><span>Specialne akcie</span></a></li>
      <li><a href="http://localhost/recommendations_colab.php"><span>Kolaborativne filtrovanie</span></a></li>
    </ul>
  </div>
</div>

<?php
define("SERVER","localhost");
define("LOGIN","root");
define("PASS","");
define("DATABASE","mytable");
$db = mysql_connect(SERVER,LOGIN,PASS) or die("Nie je možné pripoji sa k DB");
mysql_select_db(DATABASE,$db);
?>

<br>
<br><br>
<form action="recommendations_random.php" method="get">
<b>Zadaj presne ID zakaznika: <input type="text" name="search_cust"></b>
<input type="submit" name="send" value="Vyhladaj">
</form>

<br>
<br>
<table border="2" cellpadding="10">
<th>Odporucane produkty</th>
<br>

<?php
if (isset($_GET["search_cust"])) {
    $search = $_GET['search_cust'];
    $send = $_GET['send'];
	$sql=mysql_query("SELECT * FROM prod_rec WHERE customer_id like \"%".$_GET['search_cust']."%\""); 
	if($_GET['send']=="Vyhladaj") 
	{
	if(mysql_num_rows($sql)<1){
   		echo "Zakaznik nie je prihlaseny, odporucame mu:";
		echo randomProducts();
}else{
if($zaznam=mysql_fetch_object($sql))
{ 
	echo "Prihlaseny zakaznik s ID:   $zaznam->customer_id"; 
	echo randomProducts();
}
}
}
echo "</table>";
}
?>

<br><br><br>

<?php
function randomProducts() {
$sql="SELECT product_id FROM `prod_rec` ORDER BY RAND() LIMIT 5";
if($result=mysql_query("$sql")){
while($record=mysql_fetch_array($result)){
echo ("<td>".$record['product_id']."</td>");
}
echo ("\t nahodne vybrane produkty");
}
else echo mysql_error();
}

?>
</table>
<br>



</body>
</html>