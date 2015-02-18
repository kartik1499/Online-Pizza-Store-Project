/**
 * 
 */



 

$(function(){
	    // building select menu
	    $('<select />').appendTo('nav');
	 
	    // building an option for select menu
	    $('<option />', {
	        'selected': 'selected',
	        'value' : '',
	        'text': 'Choise Page...'
	    }).appendTo('nav select');
	 
	    $('nav ul li a').each(function(){
	        var target = $(this);
	 
	        $('<option />', {
	            'value' : target.attr('href'),
	            'text': target.text()
	        }).appendTo('nav select');
	 
	    });
	 
	    // on clicking on link
	    $('nav select').on('change',function(){
	        window.location = $(this).find('option:selected').val();
	    });
	});
	 
	// show and hide sub menu
	$(function(){
	    $('nav ul li').hover(
        function () {
	            //show its submenu
	            $('ul', this).slideDown(150);
	        },
	        function () {
	            //hide its submenu
	            $('ul', this).slideUp(150);        
	        }
	    );
	});


