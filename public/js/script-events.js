// $('.date-picker').datepicker();
getEvents();
$(document).on("click",".newEvent",function(){
  $("#newEvent").modal("show");
});

$(document).on("click",".submit",function(){
  var ind = 0;
  $("form .form-control").each(function(){
    var value = $(this).val();
    if(value == ""){
      ind++;
      $(this).css({
        "border":"1px solid red"
      });
    }else{
      $(this).css({
        "border":"1px solid #ccc"
      });
    }
  });
  if(ind == 0){
    $.ajax({
      url:url+"events/newEvent/",
      type: "POST",
      dataType: "JSON",
      data: new FormData($('form')[0]),
      processData: false,
      contentType: false,
      beforeSend:function(){
        $.gritter.add({
          title:  'Creating New Event',
          text: 'Please Wait...',
          class_name: 'gritter-normal',
          time: '2s',
          sticky: false
        });
      },
      success:function(e){
        if(e == 1){
          $.gritter.add({
            title:  'Success',
            text: 'New event added on the list',
            class_name: 'gritter-success',
            sticky: false
          });
          $("form .form-control").val("");
          $("#newEvent").modal("hide");
          getEvents();
        }
      }
    });
  }else{
     $.gritter.add({
          title:  'Something went wrong',
          text: 'All inputs are required.',
          class_name: 'gritter-failed',
          sticky: false
        }); 
  }
});


function getEvents(){
  $.ajax({
    url:url+"events/getEvents",
    type:"post",
    dataType:'JSON',
    beforeSend:function(){
      $.gritter.add({
        title:  'Fetching Records',
        text: 'Please Wait...',
        class_name: 'gritter-normal',
        time: '2s',
        sticky: false
      });
    },
    success:function(e){
      var html = ''
      $(e).each(function(k,v){
        html +=''+
        		'<li>'+
            '     <div class="block ">'+
            '       <div class="tags">'+
            '            <i class="fa fa-calendar" style="font-size:70pt;"></i>'+
            '       </div>'+
            '       <div class="block_content">'+
            '         <h2 class="title">'+
            '                         <a>'+v.event_name+'</a>'+
            '                     </h2>'+
            '         <div class="byline">'+
            '           <span class="label label-default">'+v.date+'</span>'+
            '           <span class="label label-warning">Organizer: '+v.organizer+'</span>'+
            '           <span class="label label-info">Host: '+v.host+'</span>'+
            '           <span class="label label-success">Location: '+v.location+'</span>'+
            '         </div>'+
            '         <p class="excerpt">'+v.about+''+
            '         </p>'+
            '        <a href="../events/info/'+v.id+'" class="btn btn-default"><i class="fa fa-gear"></i> Settings</a>'+
            '        </div>'+
            '      </div>'+
            '    </li>'
      })
      $(".timeline").html(html);
    }
  });
}