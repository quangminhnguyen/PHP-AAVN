

window.onload = function () {

	/* Opt-in popover function. */
	// $("[data-toggle=popover]").popover();



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
    			success: function(response) {
    				// alert(response);
    				if (response == 'success') {

    					location.reload();
    				}
    			}
    		});
    		$('#unenroll-btn').popover('hide');
    	});

    	$('#unenroll-no').click(function() {
    		$('#unenroll-btn').popover('hide');
    	});

    	$(window).scroll(function(){
    		$('#unenroll-btn').popover('hide');
    	});
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