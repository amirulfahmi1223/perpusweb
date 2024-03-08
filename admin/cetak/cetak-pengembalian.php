<?php
session_start();
require_once 'dompdf/autoload.inc.php';
if (!isset($_SESSION["status_login"])) {
  echo '<script>window.location="../login.php"</script>';
}
ob_start();
include "hal.php";
$html = ob_get_clean();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream('pesan.pdf', array('Attachment' => 0)); //display pdf