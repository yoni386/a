/*  id1 */
 $(document).ready(function(){
    $("#user_input2").datepicker({
        minDate: "-4D",
        maxDate: "0",
        numberOfMonths: 1,
        dateFormat: 'm/dd/yy',
        onSelect: function(selected) {
          $("#user_input2").datepicker("option","minDate", selected)
        }
    });
 });
 
/*  id2 */ 
 $(document).ready(function(){
		$.ajaxSetup({timeout: 0});
		$("#form_restore_vm_id1").validate({
			debug: false,
			rules: {
				user_input1: "required",
				user_input2: {
							required: true,				
						
															
				}
			},
			messages: {
				user_input1: "Please enter vm name.",
				user_input2: "Please enter a date.",
			},
			submitHandler: function(form) {	
			$.ajaxSetup({timeout: 0});
			// do other stuff for a valid form
				window.pollingFlag = true;
				$.post('restore_ps1.php',
						$("#form_restore_vm_id1").serialize(), 
						function(data) {
							if (data == "Script is busy, try again in 10 secs!")
								window.pollingFlag = false;
							$('#results').html(data);
							}
						);
				if (window.pollingFlag == true)
					waitForMsg();
			}
		});
	});

/*  id3 */ 

var timestamp=null;
function waitForMsg(){
$.ajaxSetup({timeout: 0});
$.ajax({
		type: "GET",
		url: "getdata.php?timestamp="+timestamp,
		async: true,
		cache: false,
		
		success: function(data){
			var continuePolling = true;
			//console.log('('+data+ ')');
			var json=eval('('+data+ ')');
			if (json['msg'] !="") {
				//alert( json['msg'] );
				//Display message here
				
				$("#msgold").empty();
				$("#msgold").append(json['msg'] +"<hr>").slideDown("slow");
	
				if (json['msg'] == 	"File is gone!" || json['msg'] == "Process Is Completed.")
					continuePolling = false;
				
				}
			timestamp =json["timestamp"];
			if (continuePolling ==true)
                setTimeout("waitForMsg()",1000);
		},
		error: function(XMLHttpRequest,textStatus,errorThrown) {
	//	 alert("error: "+textStatus + "  "+ errorThrown  );
		setTimeout("waitForMsg()",15000);
		}
	  });
	}
	
	$(document).ready(
	 function() 
	 {	
		 $('.jclock').jclock();
		 //waitForMsg(); 

	 
	 });