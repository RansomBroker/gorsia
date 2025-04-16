<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth_lib
{
    protected $CI;

    public function __construct()
    {
        // Dapatkan instance CodeIgniter
        $this->CI = &get_instance();
        // Pastikan database dan session sudah di-load
        $this->CI->load->database();
        $this->CI->load->library('session');
    }

    /**
     * Fungsi untuk mendapatkan hak akses user berdasarkan username yang tersimpan di session
     *
     * @return mixed | string|null
     */
    public function getHakAkses()
    {
        $username = $this->CI->session->userdata('username');
        if (!$username) {
            return null;
        }
        $query = $this->CI->db->query('SELECT hak_akses FROM user WHERE username = ?', [$username]);
        $row = $query->row_array();
        return isset($row['hak_akses']) ? $row['hak_akses'] : null;
    }

    /**
     * Fungsi untuk cek status menu master dari hak akses user
     *
     * @return mixed|null | string
     */
    public function getMenuStatus()
    {
        $hak_akses = $this->getHakAkses();
        if (!$hak_akses) {
            return null;
        }
        $query = $this->CI->db->query('SELECT menu_master FROM hak_akses WHERE hak_akses = ?', [$hak_akses]);
        $row = $query->row_array();
        return isset($row['menu_master']) ? $row['menu_master'] : null;
    }
}
