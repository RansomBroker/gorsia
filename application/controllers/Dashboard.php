<?php 
 
class Dashboard extends CI_Controller{
 
	function __construct(){
		parent::__construct();


        $this->load->database();

        $this->load->model('M_dashboard');
	

        #memuat helper url
        $this->load->helper('url'); #sebagai redirect
	
		if($this->session->userdata('status') != "login"){
			redirect(site_url()."?/login");
		}
	}
 
	function index(){

//$data = array('get_all_minimum_stok' => $this->M_dashboard->get_all_minimum_stok());
	
 	#untuk mengambil data hak akses
	$rows = $this->db->query("SELECT * FROM user where username='".$this->session->username."'")->row_array();
	$hak_akses=$rows['hak_akses'];
	$status=$rows['status'];

	if($hak_akses<>"" && $status=="Aktif") {
 		$this->load->view('v_dashboard');
	}

	else{
    redirect(site_url()."?/Login");
	}


	}#end function
}

?>