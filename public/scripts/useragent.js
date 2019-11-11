var userOs = false;
(function(){
	if (navigator.userAgent.match(/iPhone|iPad|iPod/i)) userOs = "iOS";
	else if (navigator.userAgent.match(/Android/i)) userOs = "Android";
	else if (navigator.userAgent.match(/Windows Phone/i)) userOs = "Windows Phone";
	else  userOs = "PC";

	if (userOs == "iOS" || userOs == "Android" || userOs == "Windows Phone") {
		var viewPortTag = document.createElement('meta');
		viewPortTag.id = "viewport";
		viewPortTag.name = "viewport";
		viewPortTag.content = "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0";
		document.getElementsByTagName('head')[0].appendChild(viewPortTag);
	}
}())
