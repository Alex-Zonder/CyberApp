var transition = function (div,time_ms) {
	var tr_div = document.getElementById(div);
	if (tr_div.style.transition == "") {
		tr_div.style.transition = time_ms/1000 + "s";
		setTimeout (function () {
			var tr_div = document.getElementById(div);
			tr_div.style.transition = "";
		}, time_ms, div);
	}
}



var menuData = {
	enabled : true,
	opened : false,
	width : 130
}

function resizeWidth() {
	//   Correcting leftMenu & content Width   //
	var siteWidth = getSiteWidth();
	if (menuData['enabled'] && siteWidth > 560) {
		menuOpen();
	}
	else {
		menuClose();
	}
}

window.addEventListener('DOMContentLoaded', function() {resizeWidth ();});
window.addEventListener('resize', function() {resizeWidth ();});



function menuOpen() {
	let sw = getSiteWidth();
	siteContent.style.width = sw > 560 ? (sw - menuData['width']) + 'px' : sw + 'px';
	siteContent.style.marginLeft = menuData['width'] + 'px';
	menuData['opened'] = true;
}
function menuClose() {
	siteContent.style.width = getSiteWidth() + 'px';
	siteContent.style.marginLeft = 0 + 'px';
	menuData['opened'] = false;
}
function changeMenu() {
	transition('siteContent', 300);
	if (menuData['opened']) menuClose();
	else menuOpen();
}
