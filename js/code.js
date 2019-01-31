function update(a) {
	var time_value;
	$.ajax({
		type : 'get',
		url : 'update.php',
		data : 'a='+a,
		success : function(data) {
			$("#ressource_display").html(data);
		}
	});
	if(a) {
		setTimeout('update(1)', 1000);
	}
}


function notif() {
	$.ajax({
		url : 'notif.php',
		success : function(data) {
			if(data) {
				$('#notif').html("<a href='mail.php'><span class='fa fa-envelope' style='color: red;'></span> Messages</a>");
			}
		}
	});
	setTimeout("notif()", 1000);
}


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
			//div.innerHTML = request.responseText;

		}
	};
	if(player_choice != undefined) {
		var bot_choice = Math.floor(Math.random() * 3) + 1; //permet de générer un chiffre aléatoire entre 1 et 3 compris
	}
	request.open("GET", "res.php?player_choice=" + player_choice + "&bot_choice=" + bot_choice + "&player_score=" + player_score + "&bot_score=" + bot_score);
	request.send();
	if(player_choice == undefined) {
		setTimeout("pfc_game()", 1000);
	}
}


function Up(id) {
    
   // var button = new XMLHttpRequest;
    
    var button = document.getElementById(id);
    button.innerHTML = "<td class='td-up'><a class='btn btn-success disabled' onclick='Up(mine)'>UPi</a></td>";
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


function tchat(p) {
	$('#message').keyup( function(a) {
		if(a.keyCode == 13) {
			$.ajax({
				type : 'GET',
				url : 'send_message.php',
				data : 'message='+$(this).val()+'&p='+p,
				success : function(data) {
					$('#box_message').html(data);
					$("#message").val('');
					$('#box_message').scrollTop(999999999);
				}
			});
		}
	});
}


function receive(a, p) {
	$.ajax({
		type : 'GET',
		url : 'send_message.php',
		data : 'p='+p,
		success : function(data) {
			$('#box_message').html(data);
		}
	});
	if(a == 0) {
		setTimeout("receive(1, "+p+")", 1000);
	}else{
		if(a == 1) {
			$('#box_message').scrollTop(999999999);
			setTimeout("receive(2, "+p+")", 1000);
		}else{
			setTimeout("receive(2, "+p+")", 1000);
		}
	}
}


function connected(p) {
	$.ajax({
		type : 'get',
		url : 'connected.php',
		data : 'p='+p,
		success : function(data) {
			$('#connected').html(data);
		}
	});
	setTimeout("connected("+p+")", 1000);
}


function scroll() {
	$('#box_message').scrollTop(999999999);
}


function delete_(a) {
	if(confirm("Attention ! Etes-vous sûr de vouloir supprimer votre compte ? Cette action seta définitive !")) {
		$.ajax({
			type : "post",
			url : "delete_option.php",
			data : "suppr"+a,
			success : function() {
			}
		});
	}
}


function build(category, id) {
	if(id != undefined) {
		$.ajax({
			type : 'get',
			url : 'up.php',
			data : 'id='+id,
			success : function(data) {
			}
		});
	}else{
		$.ajax({
			type : 'get',
			url : 'up.php',
			data : 'category='+category,
			success : function(data) {
				$('.building_display').html(data);
				console.log(data);
			}
		});
		setTimeout("build("+category+")", 1000);
	}
}


function search1(id) {
	if(id != undefined) {
		$.ajax({
			type : 'get',
			url : 'upResearch.php',
			data : 'id='+id,
			success : function(data) {
			}
		});
	}else{
		$.ajax({
			url : 'upResearch.php',
			success : function(data) {
				$('#research_display').html(data);
				console.log(data);
			}
		});
		setTimeout("search1()", 1000);
	}
}
