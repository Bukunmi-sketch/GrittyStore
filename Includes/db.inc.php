<?php

   $servername="localhost";
   $username="root";
   $password="";
   $dbname="gritty"; 


   //  $servername="sql204.infinityfree.com";
   //  $username="if0_34533092";
   //  $password="RwGDsxLWH9F";
   //  $dbname="if0_34533092_grittystore_db"; 


    /*
   $servername="afrimamafarms.com";
   $dbname="afrimama_afrimama";
   $username="afrimama_mama_afri";
   $password="afrimummy2022";
   */
  
/*
   $servername="fdb1034.awardspace.net";
   $username="4043945_afri";
   $password="--19computer";
   $dbname="4043945_afri";
*/

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
