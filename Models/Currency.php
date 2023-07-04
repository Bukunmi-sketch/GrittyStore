<?php

//namespace Users;

require '../Includes/db.inc.php';

   class Currency{
        private $db;
       
        public function __construct($conn)
        {
            $this->db= $conn;
        }

        //create new category
        public function createCurrency($name, $creator, $created_at,$creator_id){  
               try{
                
                   $sql="INSERT INTO currency(name, created_by, created_at, creator_id ) VALUES (:category_name, :creator, :created_at, :creator_id )";
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
public function IfCurrencyExisted($currencyname){
    try{
    
      $sql="SELECT * FROM currency WHERE name =:currencyname";
      $stmt= $this->db->prepare($sql);
      $stmt->bindParam(':currencyname', $currencyname);
      $stmt->execute();
      // Check if row is actually returned
      if($stmt->rowCount() > 0 ){
        //  echo "currency name already existeds";
          return false;
       } else{   
          //   echo 'continue to create currency';
             return true;
         }
    }catch(PDOException $e){
           echo  $e->getMessage(); 
       }
    }

  
    public function getCurrency()
    {             
      $sql="SELECT * FROM currency";
      $stmt=$this->db->prepare($sql);
      $stmt->execute();
      return $stmt;
    }


}
    
    ?>

