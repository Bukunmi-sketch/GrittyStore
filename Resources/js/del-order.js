$("form.order-modify").on("submit",function(event){
    event.preventDefault();
});


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

    $('.markbtn').click(function(){ 

      var orderid=$(this).data("identity");
      $post=$(this);
      
      $.ajax({  
      url:"../Controllers/markController.php",
      method:"POST",
      data:{orderid:orderid},
      success:function(data){
            $("#eachmark"+orderid).html(data);
            console.log(data);                
                      }
          });
      });  
   
