function pop_up(id) {
	if(document.getElementById(id).style.visibility=="hidden") {
        document.getElementById(id).style.visibility="visible";
    }else{
        document.getElementById(id).style.visibility="hidden";
    }
    return true;
}

