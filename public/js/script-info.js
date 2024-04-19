$(document).on("click",".new-level",function(){
  $("#newLevel").modal("show");
  transType = "newLevel";
  $.ajax({
    url:url+"events/getLevelSource",
    type:"post",
    success:function(e){
      $("#source").html(e);
    }
  });
});


// View Judge Votes
$(document).on("click",".viewVotes",function(){
    $("#viewVotes").modal("show");
    var id = $(this).attr("data-record");
    viewVotes(id);
});

function viewVotes(id){
  $.ajax({
      url:url+"events/getJudgeScores/"+id,
      type:"post",
      success:function(e){
        $(".judge-votes").html(e);
      }
    });
}


$(document).on("click",".remove-judge-votes",function(){
  var v_id = $(this).attr("data-record");
  if(confirm("Are you sure want to delete this score?")){
    $.ajax({
      url:url+"events/deleteScore/"+v_id,
      type:"post",
      success:function(e){
         $("#viewVotes").modal("hide");
      }
    });
  }
});


var transType = "";
$(document).on("click",".new-candidate",function(){
  $("#newCandidate").modal("show");
  transType = "newCandidate";
});

$(document).on("click",".new-judge",function(){
  $("#newJudge").modal("show");
  transType = "newJudge";
});

$(document).on("click",".new-sponsor",function(){
  $("#newSponsor").modal("show");
  transType = "newSponsor"
});


$(document).on("click",".new-category",function(){
  $("#newCategory").modal("show");
  transType = "newCategory";
  $.ajax({
    url:url+"events/getCatLevels/",
    type:"post",
    success:function(e){
      $("select[name='cat_level']").html(e);
    }
  });
});

$(document).on("click",".submit-level",function(){
  var form = $(this).attr("data-form");
  var check = checker(form);  
  if(check == 1){
    prepareAjax("newLevel","Level","level",form);
  }
});
$(document).on("click",".submit-category",function(){
  var form = $(this).attr("data-form");
  var check = checker(form);  
  if(check == 1){
    prepareAjax("newCategory","Category","category",form);
    
  }
  field_counter = 0;
});

$(document).on("click",".submit-judge",function(){
  var form = $(this).attr("data-form");
  var check = checker(form);  
  if(check == 1){
    prepareAjax("newJudge","Judge","judge",form);
    
  }

  field_counter = 0;
});

$(document).on("click",".submit-sponsor",function(){
  var form = $(this).attr("data-form");
  var check = checker(form);  
  if(check == 1){
    prepareAjax("newSponsor","Sponsor","sponsor",form);
  }

  field_counter = 0;
});

$(document).on("click",".submit-candidate",function(){
  var form = $(this).attr("data-form");
  var check = checker(form);  
  if(check == 1){
    prepareAjax("newCandidate","Candidate","candidate",form);
  }

  can_field_counter = 0;
});
var field_counter = 0;

$(document).on("click",".field-button",function(){
  field_counter++;
  var html = '<tr id="field'+field_counter+'">'+
                '<td><input type="text" class="form-control required" name="sub_cat_name[]"></td>'+
                '<td><input type="number" class="form-control required" name="sub_cat_min[]"></td>'+
                '<td><input type="number" class="form-control required" name="sub_cat_max[]"></td>'+
                '<td><input type="number" class="form-control required" name="sub_cat_per[]"></td>'+
                '<td><button type="button" class="btn btn-danger remove-field" data-record="#field'+field_counter+'"><i class="fa fa-remove"></i></button></td>'+
              '</tr>';
  $(".new-field").append(html); 
});

$(document).on("click",".spo-field-button",function(){
  field_counter++;
  var html = '<tr id="spo_field'+field_counter+'">'+
                '<td><input type="text" class="form-control required" name="name[]"></td>'+
                '<td><input type="file" class="form-control required" name="spo_img[]"></td>'+
                '<td><button type="button" class="btn btn-danger remove-field" data-record="#spo_field'+field_counter+'"><i class="fa fa-remove"></i></button></td>'+
              '</tr>';
  $(".spo-new-field").append(html); 
});

$(document).on("click",".jud-field-button",function(){
  field_counter++;
  var html = '<tr id="jud_field'+field_counter+'">'+
                '<td><br><input type="text" class="form-control required" name="jud_nam[]"></td>'+
                '<td><textarea type="text" class="form-control required" name="jud_inf[]"></textarea></td>'+
                '<td><button type="button" class="btn btn-danger remove-field" data-record="#jud_field'+field_counter+'"><i class="fa fa-remove"></i></button></td>'+
              '</tr>';
  $(".jud-new-field").append(html); 
});

$(document).on("click",".level_button",function(){
  var id = $(this).attr("data-record");
  $.ajax({
    url:url+"events/getSample/",
    data:{"sample":id},
    type:"post",
    success:function(e){
      $("#sample-container").html(e);
    }
  });
});

var can_field_counter = 0;
$(document).on("click",".can-field-button",function(){
  can_field_counter++;
  var html = '<tr id="can_field'+can_field_counter+'">'+
                '<td><input type="number" class="form-control required" name="can_num[]"></td>'+
                '<td><input type="text" class="form-control required" name="can_nam[]"></td>'+
                '<td><input type="text" class="form-control required" name="can_tag[]"></td>'+
                '<td><input type="text" class="form-control required" name="can_ins[]"></td>'+
                '<td>'+
                '  <select class="form-control required" name="can_gen[]">'+
                '    <option value="Male">Male</option>'+
                '    <option value="Female">Female</option>'+
                '  </select>'+
                '</td>'+

                '<td><input type="file" class="form-control required" name="can_img[]"></td>'+
                '<td><button type="button" class="btn btn-danger can-remove-field" data-record="#can_field'+can_field_counter+'"><i class="fa fa-remove"></i></button></td>'+
              '</tr>';
  $(".can-new-field").append(html); 
});
$(document).on("click",".remove-field",function(){
  var id = $(this).attr("data-record");
  $(id).remove();
});

$(document).on("click",".can-remove-field",function(){
  var id = $(this).attr("data-record");
  $(id).remove();
});

function prepareAjax(address,bSend,succ,form){
  $.ajax({
      url:url+"events/"+address,
      type: "POST",
      dataType: "JSON",
      data: new FormData($('.'+form)[0]),
      processData: false,
      contentType: false,
      beforeSend:function(){
        prepare(bSend);
      },
      success:function(e){
        if(e == 1){
          successGrit(succ);
          $("."+form+" .form-control").each(function(){
            $(this).val("");
          });
          $("#"+address).modal("hide");

          if(transType == "newCandidate"){
            getAll("getCandidate","candidateM-container","Male");
            getAll("getCandidate","candidateF-container","Female");
          }

          if(transType == "newLevel"){
            getAll("getLevels","level-container","");
          }

          if(transType == "newCategory"){
            getAll("getCategory","category-container","");
          }

          if(transType == "newJudge"){
            getAll("getJudge","judge-container","");
          }

          if(transType == "newSponsor"){
            getAll("getSponsor","sponsor-container","");
          }

        }else{
          errorGrit();
        }
        
      }
    }); 
}
function prepare(x){
  $.gritter.add({
          title:  'Creating New '+x,
          text: 'Please Wait...',
          class_name: 'gritter-normal',
          time: '2s',
          sticky: false
        });
}

function successGrit(x){
$.gritter.add({
            title:  'Success',
            text: 'New '+x+' added on the list',
            class_name: 'gritter-success',
            sticky: false
          });
}

function errorGrit(){
  $.gritter.add({
          title:  'Something went wrong',
          text: 'Please check your inputs.',
          class_name: 'gritter-failed',
          sticky: false
        }); 
}
function checker(form){
  var ind = 0;
  $("."+form+" .required").each(function(){
    if($(this).val() == ""){
      $(this).css({
        "border":"1px solid red"
      });
      ind++;
    }else{
      $(this).css({
        "border":"1px solid #ccc"
      });
    }
  });

  if(ind == 0){
    return 1;
  }else{
    $.gritter.add({
          title:  'Something went wrong',
          text: 'All inputs are required.',
          class_name: 'gritter-failed',
          sticky: false
        }); 

    return 0;
  }
}

getAll("getLevels","level-container","");
getAll("getCategory","category-container","");
getAll("getJudge","judge-container","");
getAll("getSponsor","sponsor-container","");
getAll("getCandidate","candidateM-container",'Male');
getAll("getCandidate","candidateF-container",'Female');


function getAll(func,cont,other){

  if(other == ""){
    $.ajax({
      url:url+"events/"+func,
      type:"post",
      beforeSend:function(){
        getBefPre();
      },
      success:function(e){
        $("."+cont).html(e);
      }
    });
  }else{
    // var path = url+"events/"+func+"/"+other;
   // alert(path);
    $.ajax({
      url:url+"events/"+func+"/"+other,
      type:"post",
      beforeSend:function(){
        getBefPre();
      },
      success:function(e){
           $("."+cont).html(e);
        
      }
    });
  }
  
}


function getBefPre(){
  $.gritter.add({
        title:  'Fetching Records',
        text: 'Please Wait...',
        class_name: 'gritter-normal',
        time: '2s',
        sticky: false
      });
}






// levels
$(document).on("click",".activate",function(){
  var act = $(this).attr("data-record");
  $.ajax({
    url:url+"status/updateLevelsStatus/"+act+"/act",
    type:"post",
    success:function(e){
      getAll("getLevels","level-container","");
      getAll("getCategory","category-container","");
    }
  });
});

$(document).on("click",".deactivate",function(){
  var dact = $(this).attr("data-record");
  $.ajax({
    url:url+"status/updateLevelsStatus/"+dact+"/deact",
    type:"post",
    success:function(e){
      getAll("getLevels","level-container","");
      getAll("getCategory","category-container","");
    }
  });
});

$(document).on("click",".done",function(){
  var done = $(this).attr("data-record");
  $.ajax({
    url:url+"status/updateLevelsStatus/"+done+"/done",
    type:"post",
    success:function(e){
      getAll("getLevels","level-container","");
      getAll("getCategory","category-container","");
    }
  });
});

//edit Judge
var judgeID
$(document).on("click",".editJudge",function(){
   judgeID = $(this).attr("data-record");
  $("#edit_judge").modal("show");
  $.ajax({
    url:url+"events/getEditJudge/"+judgeID,
    type:"post",
    success:function(e){
      $(".edit-judge").html(e);
    }
  });
});

$(document).on("click",".submit-editJudge",function(){
  $.ajax({
    url:url+"events/updateEditJudge/"+judgeID,
    type:"post",
    data:$("#editJudge").serialize(),
    success:function(e){
      $("#edit_judge").modal("hide");
      getAll("getJudge","judge-container","");
    }
  });
});

//edit Candidate
var candidateID
$(document).on("click",".editCandidate",function(){
  candidateID = $(this).attr("data-record");
  $("#edit_candidate").modal("show");
  $.ajax({
    url:url+"events/getEditCandidate/"+candidateID,
    type:"post",
    success:function(e){
      $(".edit-candidate").html(e);
    }
  });
});

$(document).on("click",".submit-editCandidate",function(){
  $.ajax({
    url:url+"events/updateEditCandidate/"+candidateID,
    type:"post",
    data:$("#editCandidate").serialize(),
    success:function(e){
      $("#edit_candidate").modal("hide");
      getAll("getCandidate","candidateM-container",'Male');
      getAll("getCandidate","candidateF-container",'Female');
    }
  });
});

//edit event
$(document).on("click",".editEvent",function(){
  $("#edit_event").modal("show");
  $.ajax({
    url:url+"status/getEditEvent",
    type:"post",
    success:function(e){
      $(".edit-event").html(e);
    }
  });
});

//category

$(document).on("click",".categoryActivate",function(){
  var catAct = $(this).attr("data-record");
    $.ajax({
      url:url+"events/updateCategory/"+catAct+"/catActiv",
      type:"post",
      success:function(){
        getAll("getCategory","category-container","");
      }
    });
});

$(document).on("click",".categoryDeactivate",function(){
  var catDeact = $(this).attr("data-record");
    $.ajax({
      url:url+"events/updateCategory/"+catDeact+"/catDeactiv",
      type:"post",
      success:function(){
        getAll("getCategory","category-container","");
      }
    });
});

$(document).on("click",".categoryDone",function(){
  var catDone = $(this).attr("data-record");
    $.ajax({
      url:url+"events/updateCategory/"+catDone+"/categoryDone",
      type:"post",
      success:function(){
        getAll("getCategory","category-container","");
      }
    });
});


// Edit & Delete for Sponsor
var dataSponsor
$(document).on("click",".editSponsor",function(){
  dataSponsor = $(this).attr("data-record");
  $("#edit_sponsor").modal("show");
  $.ajax({
    url:url+"events/getEditSponsor/"+dataSponsor,
    type:"post",
    success:function(e){
      $(".edit-sponsor").html(e);
    }
  });
});

$(document).on("click",".submit-editSponsor",function(){
  $.ajax({
    url:url+"events/updateEditSponsor/"+dataSponsor,
    type:"post",
    data:$("#editSponsor").serialize(),
    success:function(e){
      $("#edit_sponsor").modal("hide");
      getAll("getSponsor","sponsor-container","");
    }
  });
});


var dataSponsorDelete
$(document).on("click",".deleteSponsor",function(){
  dataSponsorDelete = $(this).attr('data-record');
  $.ajax({
    url:url+"events/deleteSponsor/"+dataSponsorDelete,
    type:"post",
    success:function(e){
      getAll("getSponsor","sponsor-container","");
    }
  });
});


$(document).on("click",".apply-manual",function(){
  $("#apply_popularity").modal("show");
  var sub_cat = $(this).attr("data-sub");
  $.ajax({
    url:url+"events/getPopularity/"+sub_cat,
    type:"post",
    success:function(e){
      $(".pop").html(e);
    }
  });
});

$(document).on("click",".submit-manual",function(){
  var ind = 0;
  var manual = "";
  $("#popularity input[name='scores[]']").each(function(){
    var val = $(this).val();

    if(val == ""){
      $(this).css({
        "border":"1px solid red"
      });
      ind++;
    }else{
        var can = $(this).attr("data-candidate");
        var jud = $(this).attr("data-judge");
        var cat = $(this).attr("data-category");
        manual += cat+"-"+can+"-"+jud+"-"+val+",";
    }
  });
  var overall = "";
  $(".manual-table tbody tr").each(function(){
    var cn_number = $(this).find(".cn_number").html();
    var cn_name = $(this).find(".cn_name").html();
    var cn_score = cn_number + " | " + cn_name;

    $(this).find(".cn_score").each(function(){
      var cn_raw = $(this).find("input").val();
      cn_score += " | " + cn_raw;
    });

    overall += cn_score+"\n";
    
  });

  alert(overall);


  if(ind == 0){
    if(confirm("Are you sure you want to apply popularity scores to candidates?")){
      $.ajax({
        url:url+"events/popularity",
        data:{"manual":manual},
        type:"post",
        success:function(e){
          alert("Success!");
          $("#apply_popularity").modal("show");
        }
      });
    }
  }
});


$(document).on("click",".apply-all",function(){
  var score = prompt("Enter score");
  
  var owned = $(this).attr("data-owned");
  $("."+owned).each(function(){
    $(this).val(+score);
  });
});

$(document).on("click",".smaller",function(){
    $("div[data-record='change-this']").attr("class","modal-dialog modal-sm");
});

$(document).on("click",".xlarge",function(){
    $("div[data-record='change-this']").attr("class","modal-dialog modal-xl");
});