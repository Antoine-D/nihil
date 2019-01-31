function pfc_game(player_choice) {
	var request = new XMLHttpRequest();
	request.onreadystatechange = function () {
		if (request.readyState === 4 && request.status === 200) {
			var sc1 = document.getElementById("player_score");
			sc1.innerHTML = /Vous : [0-9]{1,}/.exec(request.responseText);

			var sc2 = document.getElementById("bot_score");
			sc2.innerHTML = /Bot : [0-9]{1,}<\/h2>/.exec(request.responseText);

			var div = document.getElementById("res");
			div.innerHTML = /<h2>[a-zé<>, :[\]à\-.]{1,}!/i.exec(request.responseText);
		}
	};
	var bot_choice = Math.floor(Math.random() * 3) + 1;
	request.open("GET", "res.php?player_choice=" + player_choice + "&bot_choice=" + bot_choice + "&player_score=" + player_score + "&bot_score=" + bot_score);
	request.send();
}

function Up(id) {
    
   // var button = new XMLHttpRequest;
    
    var button = document.getElementById(id);
   // button.innerHTML = <td class='td-up'><a class='btn btn-success disabled' onclick='Up(mine)'>UPi</a></td>;
    console.log = button;
}


function add(pseudo, object) {
	var a = document.getElementById('add');
	var b = document.getElementById('results');
	a.innerHTML = '<label for="text">Destinataire </label>\r\n<input type="text" name="receiver" id="search" value="'+pseudo+'">';
	b.innerHTML = '';
	if(object != undefined) {
		var c = document.getElementById('object');
		c.innerHTML = '<label for="text">Objet</label>\r\n<input name="object" type="text" class="form-control" value="Re : '+object+'">';
	}
}

function notif() {
	var a = document.getElementById('notif');
	a.innerHTML = '<a href="message.php"><span class="fa fa-envelope" style="color: red;"></span> Messages</a>';
}