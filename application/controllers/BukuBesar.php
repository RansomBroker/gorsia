<?php 
include 'timezone.php';
 
class BukuBesar extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form','url'));
        $this->load->model('M_buku_besar');
        if($this->session->userdata('status') != "login"){
            redirect(site_url()."?/login");
        }
    }

    // Menampilkan halaman utama dengan filter default (periode dan tahun berjalan)
    public function index(){
        $rows = $this->db->query("SELECT * FROM user WHERE username='".$this->session->username."'")->row_array();
        $hak_akses = $rows['hak_akses'];
        $rows_hakpengguna = $this->db->query("SELECT * FROM hak_akses WHERE hak_akses='".$hak_akses."'")->row_array();
        $status_menu = $rows_hakpengguna['menu_master'] == 'Aktif' || $rows_hakpengguna['menu_akuntansi'] == 'Aktif';

        if($hak_akses != NULL && $status_menu) {
            // Default filter: periode dan tahun berjalan
            $periode = date('m');
            $tahun = date('Y');
            $data = [
                'get_all_data_akun' => $this->M_buku_besar->get_all_data_akun(),
                'get_all_buku_besar' => $this->M_buku_besar->get_all_data_buku_by_month_year(['all'], $periode, $tahun),
                'periode' => $periode,
                'tahun' => $tahun,
                'param_id_akun' => ['all']
            ];
            $this->load->view('v_buku_besar_new',$data);
        } else {
            redirect(site_url()."?/Login");
        }
    }

    // Fungsi filter pencarian: menangkap parameter GET dan meneruskan ke model
    public function filterpencarian(){
        $param_id_akun = $this->input->get('txt_id_akun');
        // Jika parameter akun kosong, set default ke ['all']
        if(empty($param_id_akun)){
            $param_id_akun = ['all'];
        }
        $periode = $this->input->get('periode');
        $tahun = $this->input->get('tahun');
        $data = [
            'get_all_data_akun' => $this->M_buku_besar->get_all_data_akun(),
            'get_all_buku_besar'=> $this->M_buku_besar->get_all_data_buku_by_month_year($param_id_akun, $periode, $tahun),
            'param_id_akun' => $param_id_akun,
            'periode' => $periode,
            'tahun' => $tahun,
        ];
        $this->load->view('v_buku_besar_new',$data);
    }
}
?>
