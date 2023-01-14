$("form.agent-modify").on("submit",function(event){
    event.preventDefault();
});

/*
$('.deletebtn').click(function(){ 

    var orderid=$(this).data("identity");
    $post=$(this);
    
    $.ajax({  
    url:"../Controllers/deleteOrderController.php",
    method:"POST",
    data:{orderid:orderid},
    success:function(data){
          $("#eachorder"+orderid).css("display","none");             
		      					}
  		  });
    });  

*/
$('.declinebtn').click(function(){ 

    var agentid=$(this).data("agentidentity");
    $post=$(this);
    
    $.ajax({  
    url:"../Controllers/declineController.php",
    method:"POST",
    data:{agentid:agentid},
    success:function(data){
         $("#eachdecline"+agentid).html(data);
         $("#eachapprove"+agentid).css("display","none");  
      //   $("#eachdecline"+agentid).html('declined');
          console.log(data);                
                    }
        });
    });  
 

    $('.approvebtn').click(function(){ 

      var agentid=$(this).data("agentidentity");
      $post=$(this);
      
      $.ajax({  
      url:"../Controllers/approveController.php",
      method:"POST",
      data:{agentid:agentid},
      success:function(data){
            $("#eachapprove"+agentid).html(data);
            $("#eachdecline"+agentid).css("display","none");  
         //  $("#eachapprove"+agentid).html('approved');
            console.log(data);                
                      }
          });
      });  
   
