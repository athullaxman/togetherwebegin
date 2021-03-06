<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct() {
        parent::__construct();

		$this->load->helper('url');
        $this->load->library('session');
		$this->load->model('service');
		$this->load->model('user');
    }

	public function index()
	{
		$this->load->view('general/home');
	}

	public function home()
	{
		// $this->load->view('panel/templates/header');
		$this->load->view('general/home');
		// $this->load->view('panel/templates/footer');
		// $this->load->view('panel/templates/footer-general');
	}

	// --------------------------------------------------------------------------------------

	public function signup() {
                if (!is_null($this->session->userdata('user_id'))) {
                    redirect('home', 'location');
                    echo "logged in";
                    return;
                }
		// echo $this->session->userdata('user_id');
		// return;
		// if no input
		if (empty($_POST)) {
			$this->load->view('general/signup');
			return;
		}

		// malicious input
		// else if (!$this->checkUserInput($_POST)) {
			// log as malicious
		// 	$history = array();
		// 	$history['action'] = 'SIGNUP_FAILED';
		// 	$history['details'] = 'Invalid Input';
		// 	$history['date'] = date("Y-m-d H:i:s");
		// 	$history['ip'] = $_SERVER['REMOTE_ADDR'];
		// 	$history['malicious'] = 1;
		// 	$this->history->log($history);
		// 	echo "Sign Up Error";
		// }

		// nothing suspicious
		else {
			// check if email already exists
			if ($this->user->checkEmail($_POST['email'])) {
				// log repeated signup attempt (as malicious)
				echo "Already Registered | Sign Up Error";
				$this->load->view('general/common/verify-timeout');
				return;
			} else {
				$data['username'] = $_POST['username'];
				$data['email'] = $_POST['email'];
				$data['password'] = $_POST['password'];
				$data['type'] = 'USER';
				$data['status'] = 'VERIFIED';
				$data['active_sessions'] = 1;
				$data['joinedon'] = date("Y-m-d H:i:s");
				$data['last_login'] = date("Y-m-d H:i:s");
				$data['last_login_attempts'] = 0;
				$data['malicious'] = 0;

				// update users
				if ($this->user->signup($data)) {
					// log to history
					// $history = array();
					// $history['action'] = 'SIGNUP';
					// $history['user_id'] = $this->session->userdata('user_id');
					// $history['date'] = date("Y-m-d H:i:s");
					// $history['ip'] = $_SERVER['REMOTE_ADDR'];
					// $history['malicious'] = 0;
					// $this->history->log($history);

					// log to logs
					// $this->session->set_userdata($data);
					echo "Sign Up Successful";
					$this->load->view('general/common/verified');
					header('Refresh:3; url= '.base_url().'home'); 
					// redirect('main/home', 'location');
					// $this->verify_email($data['email']);
					// redirect('main/verify?type=email', 'location');
				}
			}
		}
	}

	// --------------------------------------------------------------------------------------

// --------------------------------------------------------------------------------------

	public function login()
	{	
                if (!is_null($this->session->userdata('user_id'))) {
                    redirect('home', 'location');
                    echo "logged in";
                    return;
                }
		// if no input
		if (empty($_POST)) {
			$this->load->view('general/login');
		}
		// malicious input
		// else if (!$this->security->checkUserInput($_POST)) {
		// 	// log to malicious
		// 	echo "Log In Error";
		// }
		// nothing suspicious
		else {
			// $user_input = 
			$data['email'] = $_POST['email'];
			$data['password'] = $_POST['password'];
			$last_login = date("Y-m-d H:i:s");
			// login
			if ($this->user->login($data, $last_login)) {
				// log to history
				// log to logs
				// log to logs
				echo "Log In Successful";
				// echo $this->session->userdata('user_id');
				redirect('home', 'location');
			} else {
				// log to history
				// log to logs
				// log to logs
				echo "Log In Error";
				$a['login'] = "failed";
				$this->session->set_userdata($a);
				redirect('login', 'location');
			}
		}
	}

	// --------------------------------------------------------------------------------------

	public function verify($entity=NULL)
	{	
		if ($entity == "timeout") {
			$this->load->view('general/common/verify-timeout');
			// redirect to dashboard
			// header('Refresh:3; url= '.base_url().'dashboard'); 
			return;
		}

		@$type = $this->input->get()['type'];
		@$key = $this->input->get()['key'];

		if (is_null($key)) {
			if ($type == 'email') {
				$this->verify_email($data['email']);
				// $this->load->view('panel/user/verify-email', $data);
			}
			else if ($type == 'mobile')
				$this->load->view('panel/user/verify-mobile', $data);
			else
				// echo 1;
				redirect('error/404', 'location');
		}
		else {
			//logic for email verification
			if ($key == $this->session->userdata('key')) {
				$this->session->set_userdata('status','VERIFIED');
				$this->user->update_status($data['email']);
				$this->load->view('panel/user/verified');
			}
			else {
				$this->load->view('panel/user/verify-timeout');
			}
		}
	}

	// ==============================================================================
	public function offer_service()
	{	
		if ($this->session->userdata('user_id')) {
			$this->load->view('general/offer_service');
			return;
		}
		redirect('login', 'location');

		// $this->load->view('panel/templates/header');
		
		// $this->load->view('panel/templates/footer');
		// $this->load->view('panel/templates/footer-general');
	}

	public function nearby()
	{
		$data['service'] = $this->service->get_services();
		$this->load->view('general/request_service', $data);
		return;
	}
        
        public function logout()
	{
            $this->session->unset_userdata('user_id');
            redirect('login');
	}
        
        public function contact()
	{
		$this->load->view('general/contact');
		return;
	}

	public function request_service()
	{
		if (empty($_POST)) {
			$data['service'] = $this->service->get_services();
			$this->load->view('general/request_service', $data);
			return;
		}

		$input['district'] = isset($_POST['district']) ? $_POST['district'] : NULL;
		$input['taluk'] = isset($_POST['taluk']) ? $_POST['taluk'] : NULL;
		$input['category'] = isset($_POST['category']) ? $_POST['category'] : NULL;
		$input['subcategory'] = isset($_POST['subcategory']) ? $_POST['subcategory'] : NULL;

		$data['service'] = $this->service->get_services($input);
		$this->load->view('general/request_service', $data);
		return;
	}


	public function add_sp() {	

		$dat['id'] = $this->session->userdata('user_id');
		$dat['company'] = $_POST['company'];
		$dat['name'] = $_POST['fname'].' '.$_POST['lname'];
		$dat['phone'] = $_POST['mobnum'];
		$dat['district'] = $_POST['owndistrict'];
		$dat['address'] = $_POST['permaddr'];

		$dat['created_on'] = date("Y-m-d");
		$dat['updated_on'] = date("Y-m-d");
		$dat['service_count'] = 0;

		if ($this->service->add_sp($dat)) {
			return True;
		}
		else {
			return False;
		}
	}

	public function add_service() {	
		$dat['id'] = $this->session->userdata('user_id');
		$dat['company'] = $_POST['company'];
		$dat['name'] = $_POST['fname'].' '.$_POST['lname'];
		$dat['phone'] = $_POST['mobnum'];
		$dat['district'] = $_POST['owndistrict'];
		$dat['address'] = $_POST['permaddr'];
		$dat['created_on'] = date("Y-m-d");
		$dat['updated_on'] = date("Y-m-d");
		$dat['service_count'] = 0;
                
                $data['name'] = $_POST['fname'].' '.$_POST['lname'];
		$data['company'] = $_POST['company'];
		$data['remark'] = $_POST['remarks'];
		$data['phone'] = $_POST['mobnum'];
		$data['created_on'] = date("Y-m-d");
		$data['district'] = $_POST['district'];
		$data['taluk'] = $_POST['taluk'];
		$data['category'] = $_POST['category'];
		// $data['subcategory'] = $_POST['subcategory'];
		$data['sp_id'] = $this->session->userdata('user_id');
		// echo $this->session->userdata('user_id');
		// var_dump($_POST);
		if ($this->service->add_service($data)) {
			return True;
		}
		else {
			return False;
		}
	}











}





?>