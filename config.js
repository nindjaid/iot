document.title = "CRUD Ktupad";
conf.host='http://localhost/ninja/';
conf.model='database.php';
conf.home='modules/iot/controller.js?iot/view';
if(conf.isSc==0){conf.sc(conf.home);}


var url_string = window.location.href
var url = new URL(url_string);
var c = url.searchParams.get("c");

conf.sc(c)
console.log(c);
