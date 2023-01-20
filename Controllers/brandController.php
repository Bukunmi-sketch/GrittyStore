<?php

include '../Models/Brand.php';
include '../Models/Auth.php';


$brandInstance=new Brand($conn);
$authInstance=new Auth($conn);

$Brand_name="";
$creator="";
$date="";


if($_SERVER['REQUEST_METHOD']=="POST"){


    $Brand_name=$authInstance->validate($_POST['Brand_name']);
    $creator=$_POST['creator_name'];
    $date=date("y-m-d h:ia");
    $creator_id=$_POST['creator_id'];
 

    if(!empty($Brand_name)){
        if($brandInstance->IfBrandExisted($Brand_name)){ 
                if($brandInstance->createBrand($Brand_name, $creator, $date, $creator_id) ){
                    echo "success";
                }else{
                    echo "an error occurred while adding a Brand";
                }    
        }else{
            echo "Brand name already existed";
        }   
     }else{
       echo 'Brand name cannot be empty';
     }






}



?>