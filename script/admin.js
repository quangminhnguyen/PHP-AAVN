

window.onload = function () {
	var html = [
    '<div>',
        '<button class="btn btn-danger" id="unenroll-yes"> Yes </button>',
        '<button class="btn btn-primary" id="unenroll-no"> No </button>',
    '</div>'].join('\n');
    
    
    $('#unenroll-btn').popover({
    	placement: 'top',
    	title:'Are you sure?',
    	html: true,
    	content: html
    });

	$('#unenroll-btn').on('hidden.bs.popover', function (e) {
    	$(e.target).data("bs.popover").inState.click = false;
	});
	// alert(JSON.stringify({action : 'unenroll', student_id: 'all'}));
    $('#unenroll-btn').on('shown.bs.popover', function() {
    	$('#unenroll-yes').click(function() {
    		$.ajax({
    			url: 'users.php',
    			type: 'post',
    			data: {'action':'unenroll', 'student_id':'all'},
    			dataType: 'json',
    			success: function(response) {    				
    				if (response.status == 'success') {
    					$('#tab2 tbody').html('');
    					$('count').html('No students enrolled in the class.')

    					/* Reset all status in the restration table (table 1) */
    					$('#tab1 td:first-child').html('&#10060');
    				}
    			}
    		});
    		$('#unenroll-btn').popover('hide');
    	});

    	$('#unenroll-no').click(function() {
    		$('#unenroll-btn').popover('hide');
    	});
    });
    
    $(window).scroll(function(){
    	$('.popover').prev().popover('hide');
    }); 


   	$('[unenroll_id]').on('hidden.bs.popover', function (e) {
    	$(e.target).data("bs.popover").inState.click = false;
	});


    $('[unenroll_id]').popover({
    	placement: 'right',
    	title: 'Are you sure that you want to unenroll this student?',
    	html: true,
    	content: function() {
			var html = [
		    '<div>',
		        '<button class="btn btn-danger" unenroll_id_yes="'+$(this).attr('unenroll_id')+'" > Yes </button>',
		        '<button class="btn btn-primary" unenroll_id_no="'+$(this).attr('unenroll_id')+'"> No </button>',
		    '</div>'].join('\n');
    		return html;
    	}
    });


 	/* delegated event. */
	$('td').on('click', '[unenroll_id_no]', function() {
		$("[unenroll_id='"+ $(this).attr('unenroll_id_no') + "']").popover('hide');
	});

    /* delegated event. */
	$('td').on('click', '[unenroll_id_yes]', function() {
		// alert($(this).attr('unenroll_id_yes'));
		// $iam.popover('hide');
		// alert('helo');
		var student_id =  $(this).attr('unenroll_id_yes');
		$.ajax({
			url: 'users.php',
			type: 'post',
			data: {'action':'unenroll', 'student_id': student_id},
			dataType:'json',
			success: function(response) {
				if (response.status == 'success') {
					var panel = $("[unenroll_id='"+ student_id + "']").closest('.panel');
					// alert(panel.attr('class'));
					var count_dom = panel.next().find('count') /* Access the count DOM */
					var prev_num = parseInt(count_dom.attr('count'));
					// alert(prev_num);
					var curr_num = prev_num - 1;
					count_dom.attr('count', curr_num);

					var mess = '';
					if (curr_num == 0) {
						mess += 'No students enrolled in this class.';
					} else if (curr_num == 1) {
						mess += 'A student enrolled in this class.';
					} else {
						mess += curr_num + ' students enrolled in this class.';
					}
					// alert(mess);
					count_dom.html(mess);

					/* Removes the row from the information table (table 2) */
					$("[unenroll_id='"+ student_id + "']").closest('tr').remove();

					/* Changes status in the registration table (table 1) */
					// alert(student_id);
					// alert($('#tab1').find("[name='"+ student_id +"']").attr('name'));
					var checkbox = $('#tab1').find("[name='"+ student_id +"']");
					var table_row = checkbox.closest('tr'); /* retrieve the closest table row.*/
					var confirm_col = table_row.children().first(); /* get the first table data. */
					confirm_col.html('&#10060'); /* Reset status to unconfirm. */
					
				} else {
					alert('error: ' + response.status);
				}
			}
		});
		$("[unenroll_id='"+ $(this).attr('unenroll_id_yes') + "']").popover('hide');
	});

    /*
	$('#unenroll-btn').popover({
    	title: 'Test',
    	html: true,
    	content: contentHtml,
    	trigger: 'manual'
		}).on('shown.bs.popover', function () {
    		var $popup = $(this);

    		$(this).next('.popover').find('button.cancel').click(function (e) {
    			alert('1');
        		$popup.popover('hide');
    		});

    		$(this).next('.popover').find('button.save').click(function (e) {
    			alert('2');
        		$popup.popover('hide');
    		});
	});  */


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