$(document).ready(function() {

	$('#login').submit(function(e){
		e.preventDefault();

		var email = $('#email').val();
		var password = $('#password').val();
		$('#account-setup').parent().removeClass('has-error has-feedback');
		$('#search-error .col').text('').fadeOut();

		$.ajax({
			url: "/api/login.php",
			type: "POST",
			data: {'email': email, 'password': password},
			async: false,
			dataType: "json",
			success: function(data){
				if(data.success){
					$(location).attr('href', '/home.php');
				}else{
					$.each(data.errors, function(type, msg){
						switch(type){
							case "empty":
								$('#search-error .col').text('Input. Need input. More input.').fadeIn();
							break;
							case "fail":
								$('#search-error .col').fadeIn().text('Your email or password were incorrect. Try again?');
							break
						}
					});
				}
			}
		});
		return false;	
	});

	$('#register').submit(function(e){
		e.preventDefault();

		var email = $('#email').val();
		var password = $('#password').val();
		var username = $('#nickname').val();
		$('#account-setup').parent().removeClass('has-error has-feedback');
		$('#search-error .col').text('').fadeOut();

		$.ajax({
			url: "/api/create-user.php",
			type: "POST",
			data: {'username': username, 'password': password, 'email': email},
			async: false,
			dataType: "json",
			success: function(data){
				if(data.success){
					$(location).attr('href', '/home.php');
				}else{
					$.each(data.errors, function(type, msg){
						switch(type){
							case "empty":
								$('#flight-input').parent().addClass('has-error has-feedback');
								$('#search-error .col').text(data.errors.empty[0]).fadeIn();
							break
						}
					});
				}
			}
		});
		return false;	
	});

	$('#forgot-pw').submit(function(e){
		e.preventDefault();

		var email = $('#email').val();
		$('#account-setup').parent().removeClass('has-error has-feedback');
		$('#search-error .col').text('').fadeOut();

		$.ajax({
			url: "/api/trigger-pw-reset.php",
			type: "POST",
			data: {'email': email},
			async: false,
			dataType: "json",
			success: function(data){
				if(data.success){
					// $(location).attr('href', '/search');
					$('#search-error .col').fadeIn().html('Password reset link send to your email. Check your spam just in case.');
				}else{
					$.each(data.errors, function(type, msg){
						switch(type){
							case "empty":
								$('#search-error .col').text('Input. Need input. More input.').fadeIn();
							break;
							case "nouser":
								$('#search-error .col').fadeIn().text('Your email was incorrect. Try again?');
							break
						}
					});
				}
			}
		});
		return false;	
	});

	$('#reset-pw').submit(function(e){
		e.preventDefault();

		var email = $('#password').data('email');
		var hash = $('#password').data('hash');
		$('#account-setup').parent().removeClass('has-error has-feedback');
		$('#search-error .col').text('').fadeOut();

		$.ajax({
			url: "/api/set-new-pw.php",
			type: "POST",
			data: {'email': email, 'hash': hash, 'password': $('#password').val()},
			async: false,
			dataType: "json",
			success: function(data){
				if(data.success){
					// $(location).attr('href', '/search');
					$('#search-error .col').html('Success! <a href="/login">Go log in with your new password.</a>').fadeIn();
				}else{
					$.each(data.errors, function(type, msg){
						switch(type){
							case "empty":
								$('#search-error .col').text('Input. Need input. More input.').fadeIn();
							break;
							case "badhash":
								$('#search-error .col').fadeIn().html('That reset link is invalid. <a href="/forgot-password">Create a new one.</a>');
							break
						}
					});
				}
			}
		});
		return false;	
	});
});