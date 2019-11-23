"use strict";

function getSiteWidth() {
	return document.querySelector('.site_width').clientWidth;
}

function calcMiddleHeight() {
	let mhOffset = sizes.getOffset('middleHolder')['top'];
	let ftOffset = sizes.getOffset('siteFooter')['top'];
	return ftOffset - mhOffset;
}

function resizeHeight() {
	var mh = document.getElementById('siteContent');
	mh.style.height = calcMiddleHeight() + 'px';
}

window.addEventListener('DOMContentLoaded', function() {resizeHeight ();});
window.addEventListener('resize', () => {resizeHeight ();});
window.addEventListener('scroll', function() {resizeHeight ();});


// try to scrool body on siteContent scroll //
/*window.addEventListener('DOMContentLoaded', function() {
	document.getElementById('siteContent').addEventListener('scroll', () => {onSiteContentScroll();});
});
function onSiteContentScroll() {
	document.documentElement.scrollTo(0, document.getElementById('siteContent').scrollTop);
}*/
