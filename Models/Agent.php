<?php

//namespace Users;

require '../Includes/db.inc.php';
// session_start();

class Agent
{
  private $db;

  public function __construct($conn)
  {
    $this->db = $conn;
  }



  public function getAgents()
  {
    $sql = "SELECT * FROM agents";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt;
  }




  public function deleteProduct($productid)
  {
    $deletesql = "DELETE FROM agents WHERE id=:product LIMIT 1 ";
    $stmt = $this->db->prepare($deletesql);
    $stmt->bindParam(":product", $productid);
    if ($stmt->execute()) {
      return true;
      //  echo 'product deleted';
    } else {
      return false;
      // echo 'product cant be deleted';
    }
  }

  //get all the agents that has been approved
  public function getApprovedAgents()
  {
    try {
      $status = 'approved';
      $reg_status = "complete";
      $sql = "SELECT * FROM agents WHERE status=:status AND reg_status=:reg_status";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(":status", $status);
      $stmt->bindParam(":reg_status", $reg_status);
      $stmt->execute();
      return $stmt;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

   //get all the agents whose request is still pending
   public function getPendingAgents()
   {
     try {
       $status = 'pending';
       $reg_status = "complete";
       $sql = "SELECT * FROM agents WHERE status=:status AND reg_status=:reg_status";
       $stmt = $this->db->prepare($sql);
       $stmt->bindParam(":status", $status);
       $stmt->bindParam(":reg_status", $reg_status);
       $stmt->execute();
       return $stmt;
     } catch (PDOException $e) {
       echo $e->getMessage();
     }
   }

   //get all the agents whose request has been declined
   public function getDeclinedAgents()
   {
     try {
       $status = 'declined';
       $reg_status = "complete";
       $sql = "SELECT * FROM agents WHERE status=:status AND reg_status=:reg_status";
       $stmt = $this->db->prepare($sql);
       $stmt->bindParam(":status", $status);
       $stmt->bindParam(":reg_status", $reg_status);
       $stmt->execute();
       return $stmt;
     } catch (PDOException $e) {
       echo $e->getMessage();
     }
   }

   public function approveThisAgent($agentid)
   {
     $query="UPDATE agents SET Status='approved' WHERE id=:agentid ";
     $stmt=$this->db->prepare($query);
     $stmt->bindParam(':agentid',$agentid );
     if($stmt->execute()){
       return true;
     }else{
       return false;
     }
   }

   public function declineThisAgent($agentid)
   {
     $query="UPDATE agents SET Status='declined' WHERE id=:agentid ";
     $stmt=$this->db->prepare($query);
     $stmt->bindParam(':agentid',$agentid );
     if($stmt->execute()){
       return true;
     }else{
       return false;
     }
   }





}
