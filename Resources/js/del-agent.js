$("form.product-modify").on("submit",function(event){
    event.preventDefault();
});

let modal = document.querySelector(".modal");
let span = document.querySelector(".modal-header span.close");
span.onclick =()=>{
 modal.style.display = "none";
}
  

$('.justbtn').click(function(){ 
   
    var productid=$(this).data("id");
    var name=$(this).data("agentname");
    var description=$(this).data("description");
    var picture=$(this).data("picture");
    var identity_pic=$(this).data("identity_pic");
    var referral=$(this).data("referral");
    var mobile=$(this).data("mobile");
    var email=$(this).data("email");
    var state=$(this).data("state");
    var reg_date=$(this).data("date");
    var folder=$(this).data('directory');
    var agent_folder=$(this).data('identity-directory');
    $post=$(this);
 //   $("#eachmodal"+productid).css("display","block"); 

    $('#id').val(productid);
    $('#detailsheading').text(name + "-details"); 
    $('#name').val(name); 
    $('#desc').val(description); 
    $('#referral').val(referral); 
    $('#email').val(email); 
    $('#mobile').val(mobile); 
    $('#state').val(state);
    $('#joined').val(reg_date);
    $('#productid').val(productid); 
    $('.editimage').attr('src', folder + picture); 
    $('.editimageb').attr('src', agent_folder + identity_pic); 
    console.log("#eachmodal",productid);
    console.log("name", name);
    console.log("description", description);
    console.log("folder", folder + picture);
   $('.modal').css("display", "block");

  });  
  

$('.deletebtn').click(function(){ 

    var agentid=$(this).data("agentidentity");
    $post=$(this);
    
    $.ajax({  
    url:"../Controllers/deleteagentController.php",
    method:"POST",
    data:{agentid:agentid},
    success:function(data){
        // $ post.css("display","none"); 
          $("#eachagent"+agentid).css("display","none");        
        //  $(".liked-by"+productid).html(data +" "+"likes");          
		      					}
  		  });
    });  
   

