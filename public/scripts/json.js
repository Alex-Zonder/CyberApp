//			J S O N			//
function toJson (data) {return JSON.stringify(data);}
function fromJson (data) {return JSON.parse(data);}
function isJson(str) {
	// Check for NUMBER //
	let regexp = /^[0-9]+$/;
	if (str.match(regexp)) return false;

	// Check for JSON //
	try {
		JSON.parse(str);
	} catch (e) {
		return false;
	}
	return true;
}
