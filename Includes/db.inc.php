<?php

   $servername="localhost";
   $username="root";
   $password="";
   $dbname="gritty"; 


    // $servername="sql204.infinityfree.com";
    // $username="if0_34533092";
    // $password="RwGDsxLWH9F";
    // $dbname="if0_34533092_grittystore_db"; 


   
  

  //  $servername="fdb1030.awardspace.net";
  //  $username="4340363_grittystore";
  //  $password="Computer19";
  //  $dbname="4340363_grittystore";


   try{
    $conn= new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if($conn){
      //  echo "connected succesfully";
       // echo "<br>";
    }
    else{
     //   echo "can't connect";
    }

  }
   catch(PDOException $e){
       echo "error while connecting to the database" .  $e->getMessage() ;
   }
