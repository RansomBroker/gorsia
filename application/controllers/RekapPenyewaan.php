<?php 
include 'timezone.php';
 
class RekapPenyewaan extends CI_Controller{
 
	function __construct(){
		parent::__construct();
        #memuat pengenalan database
        $this->load->database();

        #memuat pengenalan helper url
       	$this->load->helper(array('form','url'));

        #memuat pengenalan model
		    $this->load->model('M_rekap_penyewaan');

        #cek kondisi sesion login
		    if($this->session->userdata('status') != "login"){
			     redirect(site_url()."?/login");
		    }
	}


	#menampilkan halaman utama controller
	public function index()
    {
        // Cek hak akses user
        $rows = $this->db->query("SELECT * FROM user where username='".$this->session->username."'")->row_array();
        $hak_akses = $rows['hak_akses'];

        // Cek akses menu
        $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses where hak_akses='".$hak_akses."'")->row_array();
        $status_menu = $rows_hakpengguna['menu_master'];

        // Jika user memiliki hak akses dan menu aktif
        if($hak_akses != NULL && $status_menu == "Aktif") {
            // Ambil filter bulan dan tahun dari GET, default ke bulan dan tahun berjalan jika tidak ada
            $bulan = $this->input->get('bulan') ? $this->input->get('bulan') : date('n'); // Bulan saat ini sebagai default
            $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y'); // Tahun saat ini sebagai default

            // Kirim parameter filter ke model
            $data = array(
                'get_all_rekap_penyewaan' => $this->M_rekap_penyewaan->get_all_rekap_penyewaan($bulan, $tahun),
                'get_all_kategori'        => $this->M_rekap_penyewaan->get_all_kategori(),
                'selected_bulan'          => $bulan,
                'selected_tahun'          => $tahun
            );
            
            $this->load->view('v_rekap_penyewaan', $data);
        } else {
            redirect(site_url()."?/Login");
        }
    }


  

    #function hapus data
    public function delete_data()
    {
      $id_transaksi = $this->uri->segment('4');
      $this->M_rekap_penyewaan->delete_data($id_transaksi);
    }





}

?>