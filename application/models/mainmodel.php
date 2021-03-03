<?php
class mainmodel extends CI_model
{

public function encpassword($pass)
	{	
		$encpass=md5($pass);
		return $encpass;
	}




public function register($a,$b)

{

	
	$this->db->insert("login",$b);
	$logid=$this->db->insert_id();
	$a['log_id']=$logid;
	$this->db->insert("register",$a);
	
}

	/*email validation ajax*/
	function is_email_available($email)  
      {  
           $this->db->where('email', $email);  
           $query = $this->db->get("login");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      } 

     /*ajax validation of mobileno*/
      public function is_phno_available($phno)  
      {  
           $this->db->where('mob', $phno);  
           $query = $this->db->get("login");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }
      public function is_uname_available($uname)
       {  
           $this->db->where('uname', $uname);  
           $query = $this->db->get("login");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }
  

/****login starts***************/

public function slctpass($uname,$pass)
{
	$this->db->select('password');
	
	$this->db->where("uname",$uname);
	$this->db->or_where("email",$uname);
	$this->db->or_where("mob",$uname);
	$this->db->from("login");
	$qry=$this->db->get()->row('password');
	return $this->verfypass($pass,$qry);

}

 public function verfypass($pass,$qry)
 {
 	$m=md5($pass);
 	if($qry==$m)
 	{
 		return true;
 	}
 	else
 	{
 		return false;
 	}
 	

 }

  public function getusrid($uname)
  {
	 $this->db->select('id');
	 $this->db->where("uname",$uname);
	$this->db->or_where("email",$uname);
	$this->db->or_where("mob",$uname);
	$this->db->from("login");
	return $this->db->get()->row('id');
  }
  public function getusr($id)
  {
  	$this->db->select('*');
	$this->db->from("login");
	$this->db->where("id",$id);
	return $this->db->get()->row();
  }

  /******************approve and reject*************/
  	public function statustable()
	{
		$this->db->select('*');
		$this->db->join('register','register.log_id=login.id','inner');
		$qry=$this->db->where('u_type','1');
		$qry=$this->db->get("login");
		return $qry;

	}

	public function approvedetails($id)
	{
	 $this->db->set('status','1');
     $qry=$this->db->where('id',$id);
     $qry=$this->db->update("login");
     return $qry;

	}

	public function rejectdetails($id)
	{
	$this->db->set('status','2');
	$qry=$this->db->where('id',$id);
	$qry=$this->db->update("login");
     return $qry;

	}

	public function deleteuser($id)
	{
		$this->db->join('register','register.log_id=login.id','inner');
		$this->db->where("log_id",$id);
		$this->db->delete("register");
		$this->db->where("id",$id);
		$this->db->delete("login");
	}

	/**********updation of user profile********/



	public function	view_fn($id)
	{
		$this->db->select('*');
		$qry=$this->db->join('register','register.log_id=login.id','inner');
		$qry=$this->db->where("register.log_id",$id);
		$qry=$this->db->get('login');
		return	$qry;
	}

	public function update_model($x,$y,$id)
	{
		$this->db->select('*');
		$qry=$this->db->where("register.log_id",$id);
		$qry=$this->db->join('register','register.log_id=login.id','inner');
		$qry=$this->db->update("register",$x);
		$qry=$this->db->where("login.id",$id);
		$qry=$this->db->update("login",$y);
		return $qry;
	}



}
?>