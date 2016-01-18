
window.onload = init;

var postId;

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function init() {
	postId = parseInt(getParameterByName("id"));
}


window.onkeyup = function(e) {
	var key = e.keyCode ? e.keyCode : e.which;
	if(key == 39) {
		if(postId < 26) {
			postId += 1;
			window.location = "http://localhost:8080/web-temp/index.php?id=" + postId.toString();
		}
	}

	if(key == 37) {
		if(postId > 0) {
			postId -= 1;
			window.location = "http://localhost:8080/web-temp/index.php?id=" + postId.toString();
		}
	}
}
