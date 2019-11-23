class Sizes {
	checkType (elem) {
		if (typeof elem === 'string')
			elem = document.getElementById(elem);
		return typeof elem === 'string' ? document.getElementById(elem) : elem;
	}

	getOffset (el) {
		el = this.checkType(el);
		var _x = 0;
		var _y = 0;
		while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
			_x += el.offsetLeft - el.scrollLeft;
			_y += el.offsetTop - el.scrollTop;
			el = el.offsetParent;
		}
		return { top: _y, left: _x };
	}

	divSize (elem, width = false, height = false) {
		elem = this.checkType(elem);
		if (width)
			elem.style.width = width;
		if (height);
			elem.style.width = height;
		return {
			x : elem.clientWidth,
			y : elem.clientHeight,
		}
	}
}
var sizes = new Sizes();
