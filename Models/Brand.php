<?php

//namespace Users;

require '../Includes/db.inc.php';

   class Brand{
        private $db;
       
        public function __construct($conn)
        {
            $this->db= $conn;
        }

        //create new category
        public function createBrand($name, $creator, $created_at,$creator_id){  
               try{
                
                   $sql="INSERT INTO brands(name, created_by, created_at, creator_id ) VALUES (:category_name, :creator, :created_at, :creator_id )";
                     $stmt= $this->db->prepare($sql);
                      $result=  $stmt->execute([
                        ":category_name"=>$name,
                        ":creator" =>$creator,
                        ":created_at" =>$created_at,
                        ":creator_id" =>$creator_id
                   ]);
   
                   if($result){
                     return true;
                       }else{
                    //   echo "error while creating category";
                    return false;
                   }
               } catch(PDOException $e){
                   echo  $e->getMessage(); 
               }
    }   //create()
   
                                  //if produxtname already exist  //auth
public function IfBrandExisted($brandname){
    try{
    
      $sql="SELECT * FROM brands WHERE name =:brandname";
      $stmt= $this->db->prepare($sql);
      $stmt->bindParam(':brandname', $brandname);
      $stmt->execute();
      // Check if row is actually returned
      if($stmt->rowCount() > 0 ){
        //  echo "brand name already existeds";
          return false;
       } else{   
          //   echo 'continue to create brand';
             return true;
         }
    }catch(PDOException $e){
           echo  $e->getMessage(); 
       }
    }

  
    public function getBrands()
    {             
      $sql="SELECT * FROM brands";
      $stmt=$this->db->prepare($sql);
      $stmt->execute();
      return $stmt;
    }


}
    
    ?>

