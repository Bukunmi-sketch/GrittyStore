<?php
//namespace Users;
require '../Includes/db.inc.php';
 // session_start();

   class Account{
        private $db;
       
        public function __construct($conn)
        {
            $this->db= $conn;
        }
    //    register($userid, $username, $email, $mobileno, $country, $accountStatus, $otp, $usertoken, $password, $date))
        //register new users
        public function registerEmail($userid, $firstname, $lastname, $email,  $country, $state, $status, $otp, $password, $date){  
               try{
                   //hash the password;
                   $user_hashed_password = password_hash($password, PASSWORD_DEFAULT );
   
                   $sql="INSERT INTO users(userid, firstname, lastname, email, country, state, accountStatus, otp, password, reg_date)VALUES(:userid, :firstname, :lastname, :email, :country, :state, :status, :otp, :password, :reg_date)";
                   $stmt= $this->db->prepare($sql);
                   $result=  $stmt->execute([
                        ":userid"=>$userid,
                        ":firstname"=>$firstname,
                        ":lastname"=>$lastname,
                        ":email" =>$email,
                        ":status" => $status,
                        ":otp" => $otp,
                        ":country" =>$country,
                        ":state" =>$state,
                        ":password" => $user_hashed_password,
                        ":reg_date" =>$date
                   ]);
   
                   if($result){
                     return true;
                //return the users data and email will be the unique key here                         
                    /*    return [
                        'email' => $email,  
                        'firstname'=>  $firstname,  
                        'lastname' =>  $lastname  
                            ];
                            */
                       }else{
                    //   echo "error while inserting";
                    return false;
                   }
               } catch(PDOException $e){
                   echo  $e->getMessage(); 
               }
           }   //register()


           public function registerMobile($userid, $firstname, $lastname,  $mobile, $country, $state, $status, $otp, $password, $date){  
            try{
                //hash the password;
                $user_hashed_password = password_hash($password, PASSWORD_DEFAULT );

                $sql="INSERT INTO users(userid, firstname, lastname, mobile, country, state, accountStatus, otp, password, reg_date)VALUES(:userid, :firstname, :lastname,  :mobile, :country, :state, :status, :otp, :password, :reg_date)";
                $stmt= $this->db->prepare($sql);
                $result=  $stmt->execute([
                     ":userid"=>$userid,
                     ":firstname"=>$firstname,
                     ":lastname"=>$lastname,
                     ":mobile" =>$mobile,
                     ":status" => $status,
                     ":otp" => $otp,
                     ":country" =>$country,
                     ":state" =>$state,
                     ":password" => $user_hashed_password,
                     ":reg_date" =>$date
                ]);

                if($result){
                  return true;
             //return the users data and email will be the unique key here                         
                 /*    return [
                     'email' => $email,  
                     'firstname'=>  $firstname,  
                     'lastname' =>  $lastname  
                         ];
                         */
                    }else{
                 //   echo "error while inserting";
                 return false;
                }
            } catch(PDOException $e){
                echo  $e->getMessage(); 
            }
        }   //register()


                               //if email already exist  //auth
public function registerCheckEmail($email){
    try{
    
      $sql="SELECT * FROM users WHERE email =:email";
      $stmt= $this->db->prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      // Check if row is actually returned
      if($stmt->rowCount() > 0 ){
        //  echo "email has been used";
          return false;
       } else{   
          //   echo 'continue to sign up';
             return true;
         }
    }catch(PDOException $e){
           echo  $e->getMessage(); 
       }
    }

    public function registerCheckMobile($mobile){
      try{
      
        $sql="SELECT * FROM users WHERE mobile =:mobile";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->execute();
        // Check if row is actually returned
        if($stmt->rowCount() > 0 ){
          //  echo "mobile has been used";
            return false;
         } else{   
            //   echo 'continue to sign up';
               return true;
           }
      }catch(PDOException $e){
             echo  $e->getMessage(); 
         }
      }


        public function getUsersOtpData($userid)
        {             
          try{
            $sql="SELECT * FROM users WHERE userid =:userid";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(':userid', $userid);
            $stmt->execute();
            $returned_row =$stmt->fetch(pdo::FETCH_ASSOC);
            return [
               'id' => $returned_row['id'],
              'email' =>         $returned_row['email'],
              'firstname'=>   $returned_row['firstname'],  
              'lastname' =>   $returned_row['lastname'],
              'date' =>      $returned_row['reg_date'],
              'otp'=> $returned_row['otp'],
              'usertoken' => $returned_row['usertoken']
              ];
        }catch(PDOException $e){
          echo $e->getMessage();
        }
        }



    public function fectchRegistedDetails($email){
      try{
         
           $sql="SELECT * FROM users WHERE email =:email";
           $stmt= $this->db->prepare($sql);
           $stmt->bindParam(':email', $email);
           $stmt->execute();
           if($stmt->rowCount() > 0 ){
               
               $returned_row= $stmt->fetch(PDO::FETCH_ASSOC);      
                  return [
                     'id' =>        $returned_row['id'],
                     'firstname'=>  $returned_row['firstname'], 
                     'email' =>     $returned_row['email'],
                     'lastname' =>  $returned_row['lastname'],
                     'date' =>      $returned_row['reg_date'],
                     'password'=>   $returned_row['password']
                  ];
                    } else{
         
             return false;
          }
      }catch(PDOException $e){
          echo  $e->getMessage(); 
      }
    }  

    public function registerCheckUsername($username){
      try{
      
        $sql="SELECT * FROM users WHERE username =:username";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        // Check if row is actually returned
        if($stmt->rowCount() > 0 ){
          //  echo "username has been used";
            return false;
         } else{   
            //   echo 'continue to sign up';
               return true;
           }
      }catch(PDOException $e){
             echo  $e->getMessage(); 
         }
    }

    public function registerUsername($username,$userid,$country){
        $sql="UPDATE users SET username=:username,Country=:country WHERE id=:userid";   
        $stmtupdate=$this->db->prepare($sql);
        $stmtupdate->bindParam(":userid", $userid);
        $stmtupdate->bindParam(":username", $username);
        $stmtupdate->bindParam(":country", $country);
        if( $stmtupdate->execute()){
          return true;
        }else{
            return false;
        }
    }

    public function interestAndWeb($interest,$userid,$website){
        $sql="UPDATE users SET interest=:interest,website=:website WHERE id=:userid";   
        $stmtupdate=$this->db->prepare($sql);
        $stmtupdate->bindParam(":userid", $userid);
        $stmtupdate->bindParam(":interest", $interest);
        $stmtupdate->bindParam(":website", $website);
        if( $stmtupdate->execute()){
          return true;
        }else{
            return false;
        }
    }

    
    public function securityQuestion($question,$userid,$answer){
      $sql="UPDATE users SET forget_question=:question, forget_answer=:answer WHERE id=:userid";   
      $stmtupdate=$this->db->prepare($sql);
      $stmtupdate->bindParam(":userid", $userid);
      $stmtupdate->bindParam(":question", $question);
      $stmtupdate->bindParam(":answer", $answer);
      if( $stmtupdate->execute()){
        return true;
      }else{
          return false;
      }
  }

    
public function createSignupNotification($sessionid, $getid, $type,$status, $reg_date, $time){
  //	  UPDATING WAS SUCCESSFUL CREATE A NOTIFICATION TO THE AFFECTED USER AND SELECTED POST
  $sql="INSERT INTO notifications(senderid,receiverid,type,status,date,time)VALUES(:sender, :receiver, :type, :status, :date, :time )";
  $stmt=$this->db->prepare($sql);
  $stmt->bindParam(":sender", $sessionid);
  $stmt->bindParam(":receiver", $getid);
  $stmt->bindParam(":type", $type);
  $stmt->bindParam(":status", $status);
  $stmt->bindParam(":date", $reg_date);
  $stmt->bindParam(":time", $time);

  if($stmt->execute()){
      return true;
   // echo 'notification created successfully';
  }else{
    return false;
  //  echo 'notification cannot be created and sent';
  }
    
}
public function deleteSignNotification($sessionid, $getid, $type,$status, $reference ){
  $sql="DELETE FROM notifications WHERE senderid=:sender AND receiverid=:receiver AND status=:status AND type=:type AND reference=:reference";
  $stmt=$this->db->prepare($sql);
  $stmt->bindParam(":sender", $sessionid);
  $stmt->bindParam(":receiver", $getid);
  $stmt->bindParam(":type", $type);
  $stmt->bindParam(":status", $status);
  $stmt->bindParam(":reference", $reference);
  if($stmt->execute()){
      return true;
   //echo 'notification delete successfully';
  }else{
    return false;
  //  echo 'notification cannot be created and sent';
  }
    
}
 
    
    
    
  }  //login









?>