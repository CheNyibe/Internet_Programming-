function addMovie(movieID) {
	// body...
	window.location.replace("./index.php?action=add&movie_id=" + movieID);
	return true;
}

function confirmCheckout() {
	// body...
	if (confirm("Checkingout Already?")){
		window.location.replace("./index.php?action=checkout");
		return true;
	}
	return true;
}


function confirmLogout() {
	// body...
	if (confirm("Logging Out? ")) {
		window.location.replace("./logon.php?action=logoff");
		return true;
	}
	return false;
}

function confirmRemove(title,movieID) {
	// body...
	if (confirm("Remove " + title + " from cart?")) {
		window.location.replace("./index.php?action=remove&movie_id=" + movieID);
		return true;
	}
	return false;
}

