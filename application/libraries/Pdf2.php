<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter PDF Library
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			Muhanz
 * @license			MIT License
 * @link			https://github.com/hanzzame/ci3-pdf-generator-library
 *
 */

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

class Pdf2
{
	public function create($html,$filename)
    {   
	    $dompdf = new Dompdf();
	    $dompdf->loadHtml($html);
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->set_paper('A4', 'landscape');
	    $dompdf->render();
	    $dompdf->stream($filename.'.pdf');
  }
}