$(".step-con").css({

});
$("#wizard a").on("click",function(e){
	e.preventDefault();
	return false;
});
	var selected = $("#wizard .selected").attr("href");
	$(selected).css({
		"display":"block"
	});


setInterval(function(){
	getVoting();
},2000);
getVoting();
function getVoting(){
	$.ajax({
		url:url+"voting/getVoting/",
		type:"post",
		success:function(e){
			var json = $.parseJSON(e);
			$(".wizard_steps").html(json.steps);
			$(".step-container").html(json.container);
			console.log(json.container);
			$(".par-cou").html(json.count);
			$(".cat-title").html(json.titles);
			var selected = $("#wizard .selected").attr("href");
			$(selected).css({
				"display":"block"
			});
		}
	});
}
var id = 0;
$(document).on("click",".vote-box",function(e){
	e.preventDefault();
	$("#vote-box").modal("show");

	id = $(this).attr("data-record");

	$.ajax({
		url:url+"voting/getInfo/"+id,
		type:"post",
		success:function(e){
			$(".info-box").html(e);
		}
	});
	return false;
});


$(document).on("click",".submit-vote",function(){
	var ind = 0;
	var content = "";
	$(".vote-form input").each(function(){
		if($(this).val() == ""){
			$(this).css({
				'border':"1px solid red"
			});

			ind++;
		}else{
			var min = $(this).attr("min");
			var max = $(this).attr("max");
			if(Number($(this).val()) < min || Number($(this).val()) > max){
				$(this).css({
					'border':"1px solid red"
				});

				ind++;
			}else{
				$(this).css({
					'border':"1px solid #ccc"
				});

				content += $(this).attr("name")+"|"+$(this).val()+";";
			}
			
		}
	});

	if(ind == 0){
		
		$.ajax({
			url:url+"voting/submitVote/"+id,
			type:"post",
			data:{"data":content},
			success:function(e){

				$.gritter.add({
						title:	'Voting Success',
						text:	'Preparing for next competitor',
						class_name: 'gritter-success',
						sticky: false
					});

				$("#vote-box").modal("hide");

				
			}
		});
	}

});

var dts = 0;
$(document).on("click",".result",function(){
	dts = $(this).attr("data-record");
	$("#vote-result").modal("show");

	getResult();
});

function getResult(){
	$.ajax({
		url:url+"voting/getResult/"+dts,
		type:"post",
		success:function(e){
			$(".result-box").html(e);
		}
	});
}
var sid
$(document).on("click",".edit-score",function(){
	sid = $(this).attr("data-record");
	var min = $(this).attr("data-min");
	var max = $(this).attr("data-max");
	var score = $(this).attr("data-score");

	$(".edit-box").html('<div class="form-group">'+
          '<input class="form-control" name="edited_score" max="'+max+'" min="'+min+'">'+
        '</div>');

	$("input[name='edited_score']").val(score);
	$("#edit-score").modal("show");
});

$(document).on("click",".submit-edit",function(){
	var ind = 0;
	var content = "";
	$(".edit-box input").each(function(){
		if($(this).val() == ""){
			$(this).css({
				'border':"1px solid red"
			});

			ind++;
		}else{
			var min = $(this).attr("min");
			var max = $(this).attr("max");
			if(Number($(this).val()) < min || Number($(this).val()) > max){
				$(this).css({
					'border':"1px solid red"
				});

				ind++;
			}else{
				$(this).css({
					'border':"1px solid #ccc"
				});
			}
			
		}
	});
	if(ind == 0){
		
		$.ajax({
			url:url+"voting/editVote/"+sid,
			type:"post",
			data:$(".edit-box input").serialize(),
			success:function(e){

				$.gritter.add({
						title:	'Success',
						text:	'Update the score successfully',
						class_name: 'gritter-success',
						sticky: false
					});

				$("#edit-score").modal("hide");

				getResult();
			}
		});
	}
});