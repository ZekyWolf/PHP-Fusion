jQuery(document).ready(function() {


	$('#dropdown_link').click(function() {

		$('#dropdown').css({'display' : 'block'});

  		$('.userpanel_link').toggleClass('userpanel_link_active');
  		$('.loginpanel_link').toggleClass('loginpanel_link_active');

		$('.loginpanel_link').text('Prihlásenie ...');


		$('body').append('<div id="dropdown_mask"></div>');
		$('#dropdown_mask').fadeIn(300);

	});


	$('#dropdown_mask').live('click', function() { 
		$('#dropdown').css({'display' : 'none'});

  		$('.userpanel_link').removeClass('userpanel_link_active');
  		$('.loginpanel_link').removeClass('loginpanel_link_active');
		$('.loginpanel_link').text('Pøihlásit se');

		$('#dropdown_mask').remove();  
	}); 



});

$(document).ready(function() {

	$('a.kontakt').click(function() {

		var loginBox = $(this).attr('href');
		$(loginBox).fadeIn(300);

		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 

		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});

		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);

		return false;
	});

	$('a.close, #mask').live('click', function() { 

	  $('#mask , .popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 

	return false;
	});
});
