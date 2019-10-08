<?php
session_start(); // Connect to the existing session
processPageRequest(); // Call the processPageRequest() function

//func1
function displaySearchForm(){
	#code todo	
	
} //end display 

//func2
function displaySearchResults($searchString){
	#code todo
	$results = file_get_contents('http://www.omdbapi.com/?i=tt3896198&apikey=13f769ec&s='.urlencode($searchString).'&type=movie&r=json');
   // echo $results;
    $array = json_decode($results, true)["Search"];
    $resNum = count($array);

    echo '<body>
            <div class="pageheader">';
    echo "<h2>".$resNum." movies found. </h2><br><br>";

    if ($resNum > 0) {
        
     echo '<table class="movieTable">'; //starts table

    for ($x = 0; $x < $resNum; $x++) {
        
        $movie = $array[$x];

        //Begin HTML table ?>
        
        <?php } //End for loop
        } //End if statement

        //Ends table, adds cancel button
        echo '</table><br>';
        echo  '<input type="button" class="calcReset" onClick="javascript:window.location=&quot;./index.php&quot;" value="Cancel" style="width:75%"></body>
        </div></body>';
}

//func3
function processPageRequest()
{
	# code...
	if (empty($_POST)) {
        displaySearchForm();
    }

    else {
        displaySearchResults($_POST["searchfield"]); //Display search results with search parameter
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Search for Movies</title>
	<link rel="stylesheet" type="text/css" href="../css/site.css">
</head>
<body>
<body id="search">

<p>Welcome, <?=$_SESSION["display_name"]?>. <a href="javascript:confirmLogout()">(logout)</a></p>
<div class="pageheader">
<br><h1>myMovies Xpress!</h1>
<h2>Movie Search</h2><br>
<p>Search movies by keywords</p><br>

<form action="./search.php" method="post">
Search for movies:<br>
<input type="text" name="searchfield" class="searchfield" placeholder="Search keywords..."><br><br>
<input type="submit" value="Search" class="calcSubmit">
<input type="reset" value="Clear" class="calcReset" style="background-color: rgba(1235); border: 1px solid yellow">
<input type="button" value="Cancel" onClick="javascript:window.location='./index.php'" class="calcReset">
</form>

<!--//Begin HTML table-->
    
        <tr>
            <td class="poster"><img src="<?= $movie['Poster']?>" alt="<?= $movie["Title"]?>"></td>
            <td class="name"><a href="http://imdb.com/title/<?= $movie['imdbID'] ?>" target="_blank"> <?= $movie["Title"].' ('.$movie["Year"].')'?></a></td>
            <td><h2><a href="javascript:addMovie('<?= $movie['imdbID'] ?>')">+</a></h2></td>

        </tr>

</body>
</div>
<script src="script.js"></script>
</html>