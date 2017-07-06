window.onload = function () {

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


	$('#reset_but').on('click', function() {
		reset_all();
	});


}

