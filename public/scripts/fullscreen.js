var fullscreenEnabled = false;
function openFullscreen(elem) {
	if (typeof elem === 'string')
		elem = document.getElementById(elem);
	if (elem.requestFullscreen) {
		elem.requestFullscreen();
	} else if (elem.mozRequestFullScreen) { /* Firefox */
		elem.mozRequestFullScreen();
	} else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
		elem.webkitRequestFullscreen();
	} else if (elem.msRequestFullscreen) { /* IE/Edge */
		elem.msRequestFullscreen();
	}
	fullscreenEnabled = elem.id;
}
function closeFullscreen() {
	if (document.exitFullscreen) {
		document.exitFullscreen();
	} else if (document.mozCancelFullScreen) { /* Firefox */
		document.mozCancelFullScreen();
	} else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
		document.webkitExitFullscreen();
	} else if (document.msExitFullscreen) { /* IE/Edge */
		document.msExitFullscreen();
	}
	fullscreenEnabled = false;
}
function changeFullscreen(elem) {
	if (typeof elem == 'string')
		elem = document.getElementById(elem);
	if (!fullscreenEnabled) {
		openFullscreen(elem);
	} else {
		closeFullscreen();
	}
}
