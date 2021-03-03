<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

/* Super Class
 *
 * @package    
 * @subpackage  
 * @category    
 * @author      Kavya
 * @link        http://localhost/login_reg_system/
 */
	
	public function index()
	{
		$this->load->view('index');
	}



	public function register()
{
	$this->load->view('register');
}

public function registration()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("fname","fname",'required');
		$this->form_validation->set_rules("lname","lname",'required');

		$this->form_validation->set_rules("email","email",'required');
		$this->form_validation->set_rules("mob","mobile",'required');
		$this->form_validation->set_rules("dob","dob",'required');

		$this->form_validation->set_rules("address","address",'required');
		$this->form_validation->set_rules("district","district",'required');
		$this->form_validation->set_rules("pin","Pin",'required');
		
		$this->form_validation->set_rules("uname","username",'required');
		$this->form_validation->set_rules("password","password",'required');
		
		
		if($this->form_validation->run())
		{
			$this->load->model('mainmodel');
			$pass=$this->input->post("password");
			$encpass=$this->mainmodel->encpassword($pass);
		$a=array("fname"=>$this->input->post("fname"),
			"lname"=>$this->input->post("lname"),
			"dob"=>$this->input->post("dob"),
			"address"=>$this->input->post("address"),
			"district"=>$this->input->post("district"),
			"pin"=>$this->input->post("pin"));
		$b=array("email"=>$this->input->post("email"),
				"mob"=>$this->input->post("mob"),
				"uname"=>$this->input->post("uname"),
			"password"=>$encpass,'u_type'=>'1');
		
		$this->mainmodel->register($a,$b);
		redirect(base_url().'main/register');

	    }

}

/*email validation*/
 
      function check_email_avalibility()  
      {  
           if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  
           {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';  
           }  
           else  
           {  
                $this->load->model("mainmodel");  
                if($this->mainmodel->is_email_available($_POST["email"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Email Available</label>';  
                }  
           }  
      }  

    /*mob $ username validation:ajax*/
   public function phno_availability()
      {

                $this->load->model("mainmodel");  
                if($this->mainmodel->is_phno_available($_POST["phno"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Phone number Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }
           
      public function uname_availability()
      {

                $this->load->model("mainmodel");  
                if($this->mainmodel->is_uname_available($_POST["uname"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> user name Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }

     /*ajax ends*/  

 

/********************login starts*******************/

public function login()
{
$this->load->view('login');
}
	public function new_login()
	{
	$this->load->library('form_validation');
	$this->form_validation->set_rules("uname","username",'required');
	$this->form_validation->set_rules("password","password",'required');
	if($this->form_validation->run())
	{
	$this->load->model('mainmodel');
	$uname=$this->input->post("uname");
	$pass=$this->input->post("password");
	$rslt=$this->mainmodel->slctpass($uname,$pass);

	if ($rslt)
	{
	$id=$this->mainmodel->getusrid($uname);
	$user=$this->mainmodel->getusr($id);

	$this->load->library(array('session'));
	$this->session->set_userdata(array('id'=>(int)$user->id,'utype'=>$user->u_type,'logged_in'=>(bool)true ,'status'=>$user->status));

	if($_SESSION['logged_in']==true && $_SESSION['utype']=='0')
	{
	redirect(base_url().'main/admin');
	}

	elseif ($_SESSION['utype']=='1' && $_SESSION['status']=='1')
	{
	redirect(base_url().'main/user');
	}

	elseif ($_SESSION['utype']=='1' && $_SESSION['status']=='2' ||$_SESSION['status']=='0')
	{
		 echo "waiting for approval";
	}



	    }
	    else
	    {
	    echo "invalid user";
	    }
	}
	else
	{
	redirect('main/login','refresh');
	}
	}



/******************login ends*********************/

	/**************admin home****************/
	public function admin()
	{

		if($_SESSION['logged_in']==true && $_SESSION['utype']=='0')
		{
		$this->load->view('admin');
		}
		else
		{
		redirect('main/login','refresh');
		}

	}

	//***
	//approve and reject
	//***
		public function aprv_rjct()
		{
			if($_SESSION['logged_in']==true && $_SESSION['utype']=='0')
			{

				$this->load->model('mainmodel');
				$data['n']=$this->mainmodel->statustable();
				$this->load->view('aprv_rjct',$data);	
			}
			else
			{
			 redirect('main/login','refresh');
			}
		}

		public function approvedetails()
		{
			if($_SESSION['logged_in']==true && $_SESSION['utype']=='0')
			{

		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->approvedetails($id);
		redirect('main/aprv_rjct','refresh');
		}
		else
			{
			 redirect('main/login','refresh');
			}
		
		}

		public function rejectdetails()
	{

		if($_SESSION['logged_in']==true && $_SESSION['utype']=='0')
		{

		$this->load-> model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->rejectdetails($id);
		redirect('main/aprv_rjct','refresh');

		}
		else
			{
			 redirect('main/login','refresh');
			}

	}

	/*delete user*/
	public function deleteuser()
	{

		if($_SESSION['logged_in']==true && $_SESSION['utype']=='0')
		{

		$this->load-> model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->deleteuser($id);
		redirect('main/aprv_rjct','refresh');
		}
		else
			{
			 redirect('main/login','refresh');
			}

	}



	/**************user home starts*****************/
	public function user()

	{
		if($_SESSION['logged_in']==true && $_SESSION['utype']=='1')
			{
			$this->load->view('user');
			}
			else
			{
			 redirect('main/login','refresh');
			}
	}
	//***
	//**prifile updation
	//***

	public function profile()
	{
		if($_SESSION['logged_in']==true && $_SESSION['utype']=='1')
		{
	$this->load->model('mainmodel');
	$id=$this->session->id;
	$data['userdata']=$this->mainmodel->view_fn($id);
	$this->load->view('profile',$data);
		}
			else
			{
			 redirect('main/login','refresh');
			}

	}


	public function update_action()
	{
		$x=array("fname"=>$this->input->post("fname"),
					"lname"=>$this->input->post("lname"),
					"address"=>$this->input->post("address"),
					"dob"=>$this->input->post("dob"),
					"district"=>$this->input->post("district"),
					"pin"=>$this->input->post("pin"));

		$y=array("email"=>$this->input->post("email"),"mob"=>$this->input->post("mob"),"uname"=>$this->input->post("uname"));


		$this->load->model('mainmodel');
		

		if($this->input->post("update"))
		{
			$id=$this->session->id;
			$this->mainmodel->update_model($x,$y,$id);

			redirect('main/profile','refresh');
		}
	}

/************logout*************/
public function logout()
    {
        $data=new stdClass();
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']===true)
        {
            foreach ($_SESSION as $key => $value)
            {
               unset($_SESSION[$key]);
            }
            $this->session->set_flashdata('logout_notification','logged_out');
            redirect('/','refresh');
        }
        else{
            redirect('/','refresh');
        }
    }


    /*forgot password*/

   

}