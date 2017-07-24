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

	// alert($('#tablink1').hasClass('activee'));
	//alert($(this).hasClass('button_tab'));


	/* Make the navigation bars sticks to the top of the screen. */
	$(window).scroll(function(){
		var dist = $(window).scrollTop();
		if (dist >= 200) {
			$('.tab').addClass('sticky');
			$('.tabcontent').css('margin-top', 65);
		} else {
			// alert('huhuhuhu ' + dist);
			$('.tab').removeClass('sticky');
			$('.tabcontent').css('margin-top', 0);
		}
	});


	/*
	$('.glyphicon-chevron-up').click(function(){
		alert('test2');
		if ($(this).parent().attr('aria-expanded') == 'true') {
			// $(this).parent().attr('aria-expanded', 'true');
			alert('helo2');
			$(this).removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		}
	});


	$('.glyphicon-chevron-down').click(function(){
		alert('test1');
		if ($(this).parent().attr('aria-expanded') == 'false') {
			// $(this).parent().attr('aria-expanded', 'true');
			alert('helo1');
			$(this).removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		}
	}); */

	$('[href]').click(function() {
		var num = parseInt($(this).attr('href'));
		// alert('1');
		// alert($(this).attr('aria-expanded') == undefined)
		if ($(this).attr('aria-expanded') == 'false' ||  $(this).attr('aria-expanded') == undefined) {
			// alert('2');
			$('a > span:eq('.num.')').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		} else if ($(this).attr('aria-expanded') == 'true') {
			$('a > span:eq('.num.')').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		}
	});


}