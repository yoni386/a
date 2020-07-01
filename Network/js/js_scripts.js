;
 
/*  id2 */ 
 $(document).ready(function(){
		$.ajaxSetup({timeout: 0});
	
	
		
			submitHandler: function(form) {	
			$.ajaxSetup({timeout: 0});
			// do other stuff for a valid form
				
				$.post('restore_ps1.php',
						$("#form_find_vm_mac1").serialize()
						
						);
						}
		});


                    

/*  id3 */ 

/*
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
*/