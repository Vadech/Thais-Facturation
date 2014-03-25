<?php 
require_once('../config/init.php') ;
require_once('../biblio/fn_dates.php') ;

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$idFacture = $_GET['idFacture'];
$facture = new Facture($idFacture);
$hotel = new Hotel($facture->getIdHotel());

$email = $hotel->getEmail_hotel();
$file_name = $facture->getUrl_PDF();
$subject = "Thaïs-Soft: Facturation";
$message = "Vous trouverez ci-joint votre facture du ".FraDate($facture->getDate_deb_facture())." au ".FraDate($facture->getDate_fin_facture());

$boundary = "_".md5 (uniqid (rand()));

$attached_file = file_get_contents($file_name); //file name ie: ./image.jpg
$attached_file = chunk_split(base64_encode($attached_file));

$attached = "\n\n". "--" .$boundary . "\nContent-Type: application; name=\"$file_name\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment; filename=\"$file_name\"\r\n\n".$attached_file . "--" . $boundary . "--";

$headers ="From: contact@thais-soft.com \r\n";
$headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

$body = "--". $boundary ."\nContent-Type: text/plain; charset=ISO-8859-1\r\n\n".$message . $attached;

@mail("aurel.vionnet@gmail.com",$subject,$body,$headers);
@mail($email,$subject,$body,$headers);

?>