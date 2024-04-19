
// $(document).on("keyup","input[name='judge-code']",function(e){
// 	if(e.keyCode == 13){
// 		e.preventDefault();


// 		return false;
// 	}
// });
$(document).on("click",".submit-auth",function(e){
	e.preventDefault();
	var ind = 0;
	$("form input").each(function(){
		var value = $(this).val();
		var type = $(this).attr("name");

		if(value == ""){
			ind++;
			if(type == "judge-code"){
				$.gritter.add({
					title:	'Invalid Judge Code',
					text:	'Please check your login credentials.',
					class_name: 'gritter-failed',
					sticky: false
				});	
			}

		}
	});

	if(ind == 0){
		$.ajax({
			url:url+"authentication/judgeAuth/",
			type:"post",
			data:{'judge-code':$("input[name='judge-code']").val()},
			beforeSend:function(){
					$.gritter.add({
						title:	'Please wait...',
						text:	'Checking login credential',
						class_name: 'gritter-normal',
						time: '2s',
						sticky: false
					});

					$("form input[name='judge-code']").val("");
			},
			success:function(e){
				if(e == 1){
					$.gritter.add({
						title:	'Authentication Success',
						text:	'Redirecting...',
						class_name: 'gritter-success',
						sticky: false
					});

					window.location = url+"voting/dashboard";
				}else{
					$.gritter.add({
						title:	'Authentication Failed',
						text:	'Unregistered Judge Code',
						class_name: 'gritter-failed',
						sticky: false
					});
				}
			}
		});
	}





	return false;
});