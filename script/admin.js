window.onload = function () {

	$('.tab > button').on('click', function() {
		/* Hide all tabs */
		$('.tabcontent').each(function(index) {
			$(this).hide();
		});

		var id = $(this).attr('id');
		var tab_num = parseInt(id.substr(id.length - 1));
		var tab_to_show = 'tab' + tab_num;
		$('#'+tab_to_show).show();
		
	});

	




}