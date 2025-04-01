<?php

class Login extends CI_Controller{
 
	function __construct(){
		parent::__construct();	
		
		# load Session Library
        $this->load->library('session');
         
        # load url helper
        $this->load->helper('url');

        # load model	
		$this->load->model('M_login');

 
	}
 
	public function index(){

		# apabila sudah login, maka
		if($this->session->userdata('username') != ""){
            # untuk mengambil data hak akses
            $rows = $this->db->query("SELECT * FROM user where username='".$this->session->username."'")->row_array();
            $hak_akses=$rows['hak_akses'];

            # jika hak akses
            if ($hak_akses<>""){
            redirect(site_url()."?/Dashboard");
            }

            else{
            redirect(site_url()."?/Login");
            }




		}

		# apabila belum login
		if($this->session->userdata('username') == ""){
			$this->load->view('v_login');
		}

		
	}
 
	function aksi_login(){

		$username = $this->input->post('txt_username');
		$password = $this->input->post('txt_password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);

		$cek = $this->M_login->cek_login("user",$where)->num_rows();

		if($cek > 0){
 
			$data_session = array(
				'username' => $username,
				'password' => $password,
				'status' => "login"
				);
			
 			#menbuat set data session
			$this->session->set_userdata($data_session);

			#untuk mengambil data hak akses
			$rows = $this->db->query("SELECT * FROM user where username='".$this->session->username."'")->row_array();
			$hak_akses=$rows['hak_akses'];
			$status=$rows['status'];

			 if ($hak_akses<>"" && $status=="Aktif"){
            redirect(site_url()."?/Dashboard");
            }

            else{
            redirect(site_url()."?/Login");
            }

		}else{

			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <h4>Login Gagal</h4>
                    <p>Username atau password salah !</p>
                </div>');


			echo "<script>javascript:history.go(-1);</script>";

		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect(site_url());
	}
}

?>