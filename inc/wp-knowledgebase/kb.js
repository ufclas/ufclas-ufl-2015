var ajax = new XMLHttpRequest();
ajax.open("GET", "http://test-alpha.local/clas-it/wp-json/wp/v2/kb/?per_page=100", true);
ajax.onload = function() {
	var list = JSON.parse(ajax.responseText).map(function(i) { return i.title.rendered; });
	new Awesomplete(document.querySelector("#s"),{ list: list });
};
ajax.send();
