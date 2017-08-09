window.onload = function () {
	
	/* Unenroll all students. */
	var html = [
    '<div>',
        '<button class="btn btn-danger" id="unenroll-yes"> Yes </button>',
        '<button class="btn btn-primary" id="unenroll-no"> No </button>',
    '</div>'].join('\n');

    $('#submit_election_btn').popover({
    	placement: 'top',
    	title:'Are you sure?',
    	html: true,
    	content: html
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

