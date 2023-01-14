<?php
  session_start();  
  ob_start();

  $sessionid=$_SESSION['id'];  
 
  include '../Includes/inc.php';
  include './auth/redirect.php';

  
    $userInfo=$userInstance->getuserinfo($sessionid);
    $email =$userInfo['email'];
    $firstname=$userInfo['firstname'];
    $lastname= $userInfo['lastname'];
    $registered_date=$userInfo['date'];


   
  
  

   
   // include './components/activity.php';
//ob_end_clean(); 
?>
<!doctype html>
<html lang="en">
<head>
    <title>Declined Agents</title>
    <?php include '../Includes/metatags.php' ; ?>

    <link rel="stylesheet" type="text/css" href="../Resources/css/left.css"> 
              <link rel="stylesheet" type="text/css" href="../Resources/css/app.css">
              <link rel="stylesheet" type="text/css" href="../Resources/css/dropdown.css">
              <link rel="stylesheet" type="text/css" href="../Resources/css/agent.css">
              <link rel="stylesheet" type="text/css" href="../Resources/css/modal.css">
              <link rel="stylesheet" type="text/css" href="../Resources/css/email.css">
              <link rel="stylesheet" type="text/css" href="../Resources/css/table.css">
</head>
<body>
   <?php include './components/header.php' ; ?>
    <main>
        <div class="container">
        <?php include './components/left.php' ; ?>
       
        <div class="middle">
      <div class="follow-unfollow">          
         <button type="submit" class="justbtn" > Declined Agents </button>     
      </div>

      <?php 
          $getStmt= $agentInstance->getDeclinedAgents();
          $agentsData=$getStmt->fetchAll(PDO::FETCH_ASSOC);
      ?>
        
        <?php  if($getStmt->rowCount() > 0 ): ?>
          
              <div class="userbox">
               <!---------------------each agentss -----------------> 
               <div class="userContainer">
                 <?php foreach($agentsData as $itemdata): ?>
                 <div class="each-user" id="eachagent<?php echo  "{$itemdata['id']}" ; ?>">
                           <img src=" <?php echo $agentsignupdirfile; ?><?php echo $itemdata["display_pic"]; ?>" alt=""  class="image"> 
                         
                           <div class="productname"> <b><?php echo  ucfirst("{$itemdata['firstname']} {$itemdata['lastname']}") ; ?> </b> </div>
                          
                           <div id="followers-count"  > Referral Code: <?php echo  "{$itemdata['referralcodes']}" ; ?> </div>                           
                           <div id="followers-count">Email : <?php echo  "{$itemdata['email']}" ; ?> </div>
                           <div id="followers-count"> Mobile : <?php echo  "{$itemdata['Mobile']}" ; ?></div>  
                           <div id="followers-count"> State : <?php echo  "{$itemdata['state']}" ; ?></div>  
                           <div id="followers-count">Last Seen Date: <?php echo  date("D,F j Y",  strtotime("{$itemdata['LastActiveDate']}")) ; ?></div>  
                           <div id="followers-count">Last Seen Time: <?php echo  "{$itemdata['LastActiveTime']}" ; ?></div>  
                      <div class="follow-unfollow">     
                           <form action="" class="agent-modify">

                              <button data-agentidentity="<?php echo  "{$itemdata['id']}" ; ?>" id="eachapprove<?php echo  "{$itemdata['id']}" ; ?>" class="approvebtn" >    Approve </button>            
                              <button data-id="<?php echo  "{$itemdata['id']}" ; ?>" data-email="<?php echo  "{$itemdata['email']}" ; ?>" data-mobile="<?php echo  "{$itemdata['Mobile']}" ; ?>" data-state="<?php echo  "{$itemdata['state']}" ; ?>" data-directory="<?php echo $agentsignupdirfile; ?>" data-agentname="<?php echo  "{$itemdata['firstname']} {$itemdata['lastname']}" ; ?>" data-description="<?php echo  "{$itemdata['reason']}" ; ?>" data-picture="<?php echo  "{$itemdata['display_pic']}" ; ?>" data-referral="<?php echo  "{$itemdata['referralcodes']}" ; ?>" data-available="<?php echo  "{$itemdata['LastActiveDate']}" ; ?>" data-identity_pic="<?php echo  "{$itemdata['identity_pic']}" ; ?>" data-date="<?php echo  date("D,F j Y",  strtotime("{$itemdata['reg_date']}")) ; ?>" data-identity-directory="<?php echo  $agentidentitydirfile; ?>" class="justbtn" > view details </button>  
                             
                            </form>   
                        </div>
                 </div>    
                 
 
                
                <?php endforeach ?>

                  <!---------------------each of each products ----------------->  
                </div>  
 
        
             </div> <!-- end of userbox --->
           
       <?php else: ?>
       <h4 style="font-family:'poppins', sans-serif; text-align:center; margin-top:300px; font-weight:500;">
         <i class="fa fa-info-circle" aria-hidden="true"></i>
            No agent request has been declined at the moment
        </h4>
       <?php endif ?>
   </div> <!---- end of middle --->

                                    <!--------------------------------------- MODAL UPDATE ------------------------------------------>
<div class="modal" id="eachmodal<?php echo  "{$itemdata['id']}" ; ?>" style=" display: none;">
   <div class="details-content" >
                         <div class="modal-header" style=" background-color:#000;">
                            <span><h4 id="detailsheading">  </h4></span>
                            <span class="close" >&times</span>
                         </div>   
                         
                         
<div class="min-sub-container"   >
 <?php
   /* $getProductid= $_GET['id'];
    $getProductid=$itemdata['id'];
    $productInfo= $productInstance->getProductInfo($getProductid);

    $productid = $productInfo['id'];
    $product_name = $productInfo['product_name'];
    $description=   $productInfo['description'];  
    $category =   $productInfo['category'];
    $price =      $productInfo['price'];
    $product_picture = $productInfo['product_picture'];
    $available = $productInfo['available'];

    */
     ?>
    

     <form class="create" action="#"  enctype="multipart/form-data">

         <div class="images">
             <label for="productImage">Product Image</label>
             <div id="upload" >
                 <img src="" class="editimage" id="profileDisplay" >
             
             </div>

             <label for="identiyCard"> Identity card </label>
                            <div id="uploadb">
                                <img src=""  id="profileDisplayb" class="editimageb">
                            </div>
          </div>


           <div class="inputbox-details">
               <label> <i class="fa fa-user-circle" aria-hidden="true"></i> Agent Name:</label>
               <input type="text" id="name"  readonly >
           </div>

           <div class="inputbox-details">
             <label for="" style="text-decoration:underline; color:red;"> <b> <i class="fa fa-envelope" aria-hidden="true"></i> Email </b></label>
              <input type="text" id="email"  readonly style="border:1px solid transparent;">
           </div>


          <div class="inputbox-details">
             <label for=""> <i class="fa fa-address-card" aria-hidden="true"></i> Referral   </label>
             <input type="text" id="referral" readonly  >
          </div>

          <div class="inputbox-details">
             <label for=""> <i class="fa fa-phone-square" aria-hidden="true"></i> Mobile:  </label>
             <input type="text" id="mobile" readonly  >
          </div>

          <div class="inputbox-details">
             <label for=""> <i class="fa fa-comment" aria-hidden="true"></i> Goals & Aims:  </label>
              <textarea id="desc"   class="description"   readonly> </textarea>
          </div>

          <div class="inputbox-details">
             <label for=""> <i class="fa fa-location-arrow" aria-hidden="true"></i> State :  </label>
             <input type="text" id="state" readonly >
          </div>

          <div class="inputbox-details">
             <label for=""> <i class="fa fa-calendar" aria-hidden="true"></i> Date Joined: </label>
             <input type="text" id="joined" readonly >
          </div>

  </form>

</div>
</div>
           </div>
           </div>
   <!-------------------------------------- END OF MODAL UPDATE ----------------------------------------------------->
            

  


        </div> <!--- end of container -->
   </main>

           <script src="../Resources/js/app.js"></script>
           <script src="../Resources/js/sidebar.js"></script>
           <script src="../Resources/js/approve.js"></script>
           <script src="../Resources/js/del-agent.js"></script>
     </body>

</html>
