/* Author:

*/


(function($) {
	
	$('.data-href-url').on('click', function() 
	{
		if (typeof($(this).attr('data-href')) != "undefined" && $(this).attr('data-href') != "")
		{
			document.location.href = $(this).attr('data-href');
		}
	});
	
	$("form input.jquery-date").datepicker({
		dateFormat: 'dd/mm/yy', 
		firstDay:1
	}).attr("readonly","readonly");
	

})(jQuery);
