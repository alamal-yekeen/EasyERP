//this is the javascript that will select the active navigation bar

val url = window.location;

$('ul.nav a').filter(fuction(){
	return this.href == url;
}).parent().addClass('active');