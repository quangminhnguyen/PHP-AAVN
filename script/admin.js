

window.onload = function () {

	/* Opt-in popover function. */
	$("[data-toggle=popover]").popover();


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

	$('[href]').click(function() {
		var href = $(this).attr('href');
		// var num = str.substr(str.length - 1);
		// num = parseInt(num);
		// alert(num);
		// alert('1');
		// alert($(this).attr('aria-expanded') == undefined)
		if ($(this).attr('aria-expanded') == 'false' ||  $(this).attr('aria-expanded') == undefined) {
			// alert('2');
			$('a > span').each(function(index) {
				if ($(this).parent().attr('href') == href) {
					$(this).removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
				}
			});



			
		} else if ($(this).attr('aria-expanded') == 'true') {
			$('a > span').each(function(index) {
				if ($(this).parent().attr('href') == href) {
					$(this).removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
				}
			});
		}
	});


}