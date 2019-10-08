<?php
function processPageRequest() {

	//If no GET data exists, display the cart
	if (empty($_GET["action"])) {
		displayCart();
	}

	//If add is requested
	else if ($_GET["action"] == "add") {
		addMovieToCart($_GET["movie_id"]);
		header("Location: ./index.php");
	}

	//If a remove is requested
	else if ($_GET["action"] == "remove") {
		removeMovieFromCart($_GET["movie_id"]);
		header("Location: ./index.php");
	}

	//If a checkout is requested
	else if ($_GET["action"] == "checkout") {
		checkout($_SESSION["display_name"], $_SESSION["email"]);
	}
}
////////////////////////////////////
function readMovieData() {

	$movies = Array(); //an for the movie IDs
	$cartData = fopen("data/cart.db", "r") or die("Error occured");
	$str = fread($cartData,filesize("data/cart.db"));

	//If at least one movie is in the cart/file
	if (filesize("data/cart.db") > 0) {
	$movies = explode(",",$str);
}

	fclose($cartData);
	return array_unique($movies); //Return the movie IDs and remove duplicate values

}
////////////////////////////////////////////////////////////////////
function addMovieToCart($movieID) {
	$movies = readMovieData(); //Gets array of movie IDs

	$movies[] = $movieID; //adds the new movieID to the end of the array

	writeMovieData($movies); //Adds movieID to the cart file
	
}
/////////////////////////////////////////////////////////////////////
function removeMovieFromCart($movieID) {

	$array= readMovieData(); //Gets array of movie IDs
	$key = array_search($movieID, $array); //Searches array for the movieID to be removed

	if ($key !== false) {
		unset($array[$key]);
	}
	
	writeMovieData($array); //updates the cart
}
/////////////////////////////////////////////////////////////////////
function writeMovieData($array) {
	
	$array = array_unique($array); //Gets the array of movie IDs
	
	//Updates the cart file with the new array of movie IDs
	$str = implode(",",$array);
	$movies = fopen("data/cart.db", "w") or die("Error occured");
	fwrite($movies,$str);

	fclose($movies);
}
/////////////////////////////////////////////////////////////////////////
function displayCart()
{
	# code...
	$movies = readMovieData();
	$movCount = count(array_filter($movies));



}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
	<link rel="stylesheet" type="text/css" href="../css/site.css"></link>

</head>


<body id="Cart">
<p>Welcome, <?=$_SESSION["display_name"]?>. <a href="javascript:confirmLogout()">(logout)</a></p>

<br>
	<div class="pageheader">
	<h1>myMovies Xpress!</h1>
	<h2>Your shopping cart</h2>
	<p><?= $movCount ?> movies in your cart.</p>

	<input type="button" class="calcSubmit moviebutton" onClick="javascript:window.location='./search.php'" value="Add Movie">
	<input type="button" class="calcSubmit moviebutton" onClick="return confirmCheckout()" value="Checkout">

</body>


</html>