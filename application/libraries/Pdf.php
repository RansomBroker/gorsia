<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }



    public function Header() {
        $image_file = "<img src=\"assets/images/logo_sn.png\" width=\"100\" height=\"40\"/>";
  $this->SetY(10);
  $isi_header="<table align=\"left\">
     <tr>
      <td>".$image_file."</td>
     </tr>
    </table>";
  $this->writeHTML($isi_header, true, false, false, false, '');
    }

}
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */