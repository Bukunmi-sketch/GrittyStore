<?php
//namespace Users;
require '../Includes/db.inc.php';


class Settings{
  private $db;
  
  public function __construct($conn)
  {
      $this->db= $conn;
  }
  
        //get all the details about the user
  public function getsettinginfo(){
    try{
        $sql="SELECT * FROM settings";
        $stmt=  $this->db->query($sql);
        $stmt->execute();
        $returned_row =$stmt->fetch(pdo::FETCH_ASSOC);
        return [
           'id' => $returned_row['id'],
          'website_name' =>         $returned_row['website_name'],
          'website_url'=>   $returned_row['website_url'],  
          'website_email' =>   $returned_row['website_email'],
          'admin_mail' =>      $returned_row['admin_mail'],
          ];
    }catch(PDOException $e){
      echo $e->getMessage();
    }
  } 



 

}

?>