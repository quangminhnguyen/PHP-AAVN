window.onload = function () {
	
	/* Unenroll all students. */
	var html = [
    '<div>',
        '<a class="btn btn-danger" id="signup-yes"> Yes </a>',
        '<a class="btn btn-primary" id="signup-no"> No </a>',
    '</div>'].join('\n');

    $('#submit_election_btn').popover({
    	placement: 'top',
    	title:'Are you sure?',
    	html: true,
    	content: html
    });

    
    /* Attach new events for the buttons when the */
    $('#submit_election_btn').on('shown.bs.popover', function() {
    	$('#signup-yes').click(function() {
    		alert('yes');
    		$('#submit_election_btn').popover('hide');
    	});

    	$('#signup-no').click(function() {
    		alert('no');
    		$('#submit_election_btn').popover('hide');
    	});

    });


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
		var tab_to_show = 'student_tab' + tab_num;
		$('#'+tab_to_show).show();
	});

	/* By default makes the tab 'elective assignment' active. */
	$('#student_tab_link1').click();


	/* Close popover when click outside. */
	$('html').on('mouseup', function(e) {
    if(!$(e.target).closest('.popover').length) {
        	$('.popover').each(function(){
            	$(this.previousSibling).popover('hide');
        	});
    	}
	});


	$('#submit_election_btn').on('hidden.bs.popover', function (e) {
    	$(e.target).data("bs.popover").inState.click = false;
	});

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

	function reset_radio(name, opinion_x, opinion_y) {
		$(name).each(function() {
			/* Clean up before disabling. */
			

			if ($(this).val() == opinion_x || $(this).val() == opinion_y) {
				$(this).prop('checked', false);
				$(this).prop('disabled', true);
			} else {
				$(this).prop('disabled', false);
			}
		});
	}


	function reset_all() {
		$('input[type="radio"]').prop('checked', false);
		$('input[type="radio"]').prop('disabled', false);
	}


	$('input[name=opinion1]').on('change', function() {
		var opinion1 = $('input[name=opinion1]:checked').val();
		var opinion2 = $('input[name=opinion2]:checked').val();
		var opinion3 = $('input[name=opinion3]:checked').val();

		reset_radio("input[name=opinion2]", opinion1, opinion3);
		reset_radio("input[name=opinion3]", opinion1, opinion2);
	});



	$('input[name=opinion2]').on('change', function() {
		var opinion1 = $('input[name=opinion1]:checked').val();
		var opinion2 = $('input[name=opinion2]:checked').val();
		var opinion3 = $('input[name=opinion3]:checked').val();

		reset_radio("input[name=opinion1]", opinion2, opinion3);
		reset_radio("input[name=opinion3]", opinion1, opinion2);
	});



	$('input[name=opinion3]').on('change', function() {
		var opinion1 = $('input[name=opinion1]:checked').val();
		var opinion2 = $('input[name=opinion2]:checked').val();
		var opinion3 = $('input[name=opinion3]:checked').val();

		reset_radio("input[name=opinion1]", opinion2, opinion3);
		reset_radio("input[name=opinion2]", opinion1, opinion3);
	});


	$('#erease_selection_btn').on('click', function() {
		reset_all();
	});
}

