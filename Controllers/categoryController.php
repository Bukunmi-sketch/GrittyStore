<?php

include '../Models/Category.php';
include '../Models/Auth.php';
include '../Models/Uploadimg.php';

$imgInstance= new Uploadimg($conn);
$categoryInstance=new Category($conn);
$authInstance=new Auth($conn);

$category_name="";
$creator="";
$date="";




if($_SERVER['REQUEST_METHOD']=="POST"){


    $category_name=$authInstance->validate($_POST['category_name']);
    $creator=$_POST['creator_name'];
    $date=date("y-m-d h:ia");
    $creator_id=$_POST['creator_id'];

    $picture=$_FILES['category_image']["name"];
    $dpsize=$_FILES['category_image']['size'];
    $dptemp=$_FILES['category_image']['tmp_name']; 
    $dir="../Images/category-img/";
    $dirfile=$dir.basename($picture);
 

    if(!empty($category_name) && !empty($picture) ){
        if($categoryInstance->IfCategoryExisted($category_name)){ 

            if($imgInstance->imgextension($picture)){
                if($imgInstance->largeImage($dpsize)){
                    if($imgInstance->moveImage($dptemp, $dirfile)){
        
                        if($categoryInstance->createCategory($category_name, $picture, $creator, $date, $creator_id) ){
                            echo "success";
                        }else{
                            echo "an error occurred while adding a category";
                        }    
                    }else{
                        echo "file failed to move";
                    }
                }else{
                    echo "image is too large";
                }     
         }else{
            echo 'file is not an image';
         }
        }else{
            echo "category name already existed";
        }   
     }else{
       echo 'category name cannot be empty';
     }


     




}



?>