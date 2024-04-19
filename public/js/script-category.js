$(document).on("click",".new-level",function(){
  $("#newLevel").modal("show");
});


$(document).on("click",".new-candidate",function(){
  $("#newCandidate").modal("show");
});

$(document).on("click",".new-judge",function(){
  $("#newJudge").modal("show");
});

$(document).on("click",".new-category",function(){
  $("#newCategory").modal("show");
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
    getAll("getLevels","level-container","");
  }
});
$(document).on("click",".submit-category",function(){
  var form = $(this).attr("data-form");
  var check = checker(form);  
  if(check == 1){
    prepareAjax("newCategory","Category","category",form);
    getAll("getCategory","category-container","");
  }

  field_counter = 0;
});

$(document).on("click",".submit-judge",function(){
  var form = $(this).attr("data-form");
  var check = checker(form);  
  if(check == 1){
    prepareAjax("newJudge","Judge","judge",form);
    getAll("getJudge","judge-container","");
  }

  field_counter = 0;
});

$(document).on("click",".submit-candidate",function(){
  var form = $(this).attr("data-form");
  var check = checker(form);  
  if(check == 1){
    prepareAjax("newCandidate","Candidate","candidate",form);
    getAll("getCandidate","candidateM-container","Male");
    getAll("getCandidate","candidateF-container","Female");
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






