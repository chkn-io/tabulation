$(document).on("click",".submit-auth",function(e){
	e.preventDefault();
	var ind = 0;
	$("form input").each(function(){
		var value = $(this).val();
		var type = $(this).attr("name");

		if(value == ""){
			ind++;
			if(type == "username"){
				$.gritter.add({
					title:	'Invalid input for Username',
					text:	'Please check your login credentials.',
					class_name: 'gritter-failed',
					sticky: false
				});	
			}

			if(type == "password"){
				$.gritter.add({
					title:	'Invalid input for Password',
					text:	'Please check your login credentials.',
					class_name: 'gritter-failed',
					sticky: false
				});
			}
		}
	});

	if(ind == 0){
		$.ajax({
			url:url+"authentication/adminAuth/",
			type:"post",
			data:$("form").serialize(),
			beforeSend:function(){
					$.gritter.add({
						title:	'Please wait...',
						text:	'Checking login credential',
						class_name: 'gritter-normal',
						time: '2s',
						sticky: false
					});

					$("form input[name='password']").val("");
			},
			success:function(e){
				if(e == 1){
					$.gritter.add({
						title:	'Authentication Success',
						text:	'Redirecting...',
						class_name: 'gritter-success',
						sticky: false
					});

					window.location = url;
				}else{
					$.gritter.add({
						title:	'Authentication Failed',
						text:	'Either Username or Password is incorrect',
						class_name: 'gritter-failed',
						sticky: false
					});
				}
			}
		});
	}





	return false;
});