/*jslint browser: true, plusplus: true */
(function ($, window, document) {
    'use strict';
    // execute when the DOM is ready
    $(document).ready(function () {
		$('.flash-option').click(function () {    
            $('.flash-option').removeClass('selected');
			$(this).addClass('selected');
        });
	  
		$("input:radio[name=flash_nick]").click(function () {    
            $('#wporg_field').attr('value', $(this).val());
        });
    });
}(jQuery, window, document));