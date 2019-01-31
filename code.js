function pfc_game(a) {
	var request = new XMLHttpRequest();
	request.onreadystatechange = function() {
        if(request.readyState == 4 && request.status == 200){
			var div = document.getElementById("res");
			div.innerHTML = request.responseText;
		}
	}
	var b = Math.floor(Math.random()*3) + 1;
	request.open("GET", "res.php?a="+a+"&b="+b);
	request.send();
}