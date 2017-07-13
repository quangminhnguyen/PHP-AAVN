window.onload = function () {


	$('.tab > button').click(function() {

		/* Hide all tabs */
		$('.tabcontent').each(function(index) {
			$(this).hide();
		});

		/* Make all buttons inactive */
		$('.tab > button').each(function(index){
			$(this).removeClass('activee');
		});

		/* Shows this tab and make its button active.*/
		$(this).addClass('activee');


		var id = $(this).attr('id');
		var tab_num = parseInt(id.substr(id.length - 1));
		var tab_to_show = 'tab' + tab_num;
		$('#'+tab_to_show).show();
	});

	/* By default makes the tab 'elective assignment' active. */
	$('#tablink1').click();

	alert($('#tablink1').hasClass('activee'));
	//alert($(this).hasClass('button_tab'));
}