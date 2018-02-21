$(document).ready(function() {


  var page = 1;
  var current_page = 1;
  var total_page = 0;
  var is_ajax_fire = 0;

  manageData();

  /* manage data list */
  function manageData() {
      $.ajax({
          dataType: 'json',
          url: 'api/getData.php',
          data: {page:page}
      }).done(function(data){
      	total_page = Math.ceil(data.total/10);
      	current_page = page;

      	$('#pagination').twbsPagination({
  	        totalPages: total_page,
  	        visiblePages: current_page,
  	        onPageClick: function (event, pageL) {
  	        	page = pageL;
                  if(is_ajax_fire != 0){
  	        	     getPageData();
                  }
  	        }
  	    });

      	manageRow(data.data);
          is_ajax_fire = 1;

      });

  }

    $("#select").change(function() {
        var select = $(".main-table").find(".selectpicker").val();
        getPageData(select);

    });


  /* Get Page Data*/
  function getPageData(select) {

  	$.ajax({
      	dataType: 'json',
      	url: 'api/getData.php',
      	data: {page:page , selectTotal : select}
  	}).done(function(data){
  		manageRow(data.data);
  	});
  }


    function manageRow(data) {
  	var	rows = '';
  	$.each( data, function( key, value ) {
  	  	rows = rows + '<tr>';
  	  	rows = rows + '<td>'+value.TEXT+'</td>';
  	  	rows = rows + '<td>'+value.IS_SENDED+'</td>';
  	  	rows = rows + '<td data-id="'+value.ID+'">';
          rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
          rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
          rows = rows + '</td>';
  	  	rows = rows + '</tr>';
  	});

  	$("tbody").html(rows);
  }

  //Add new SMS to DB , response smsValue from HTML form
  //to PHP value sms_response in work.php file

  //Click button Send in Modal window
  $("#send_sms").click(function(e) {

    e.preventDefault();

    //Get value from  texarea with ID #sms
    var smsValue = $("#sms").val();

    //Cut spaces and check empty value
    if ($.trim(smsValue) != '') {

      console.log("Good");
      //ajax magic
      $.ajax({
        dataType: 'json',
        type: 'POST',
        url: 'api/work.php',
        data: {
          sms_response: smsValue
        }
      }).done(function(data) {

        console.log("Response :", data);
        $("#create-sms").find("textarea[name='sms-text']").val('');
        getPageData();
        $(".modal").modal('hide');
        toastr.success(data, 'New SMS Created : ', {timeOut: 2000});

      }).fail(function(data) {
        alert("Sorry. Server unavailable. ");
      });
    } else {
      alert('You are missing SMS text.')
    }

  });


  /* Edit Item */
  $("body").on("click",".edit-item",function(){

    var id = $(this).parent("td").data('id');
    var smsText = $(this).parent("td").prev("td").prev("td").text();

      $("#edit-item").find("input[name='sms-edit']").val(smsText);
      $("#edit-item").find(".edit-id").val(id);

  });


  /* Updated new Item */
  $("#saveEdit").click(function(e){

      e.preventDefault();

      var smsText = $("#edit-item").find("input[name='sms-edit']").val();
      var id = $("#edit-item").find(".edit-id").val();

      if(smsText != ''){
          $.ajax({
              dataType: 'json',
              type:'POST',
              url: 'api/update.php',
              data:{text:smsText, id:id}
          }).done(function(data){
              getPageData();
              $(".modal").modal('hide');
              toastr.success('SMS Text Updated Successfully.', 'Success Alert', {timeOut: 2000});
          });
      }else{
          alert('You are missing Sms Text.')
      }

   });


   /* Remove Item */
   $("body").on("click",".remove-item",function(){
       var id = $(this).parent("td").data('id');
       var deleteObj = $(this).parents("tr");
       var smsText = $(this).parent("td").prev("td").prev("td").text();
       $.ajax({
           dataType: 'json',
           type:'POST',
           url: 'api/delete.php',
           data:{id:id}
       }).done(function(data){
           deleteObj.remove();
           toastr.success('SMS Deleted Successfully.', smsText, {timeOut: 2000});
           getPageData();
       });

   });




});
