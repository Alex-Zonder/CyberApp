//$(document).ready(function() {
document.addEventListener("DOMContentLoaded", function() {
	//document.getElementsByTagName('form').submit(function(event) {
	$('form').submit(function(event) {
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cashe: false,
			processData: false,
			success: function(result) {
				alert(result);
			}
		})
	});
});
