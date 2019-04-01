<?php 
require_once 'connexion.php';

INSERT INTO `uploaded_files` (`file_path`, `client_id`) VALUES ( 'mouette/mouette.txt', '$last_id_client');

function uploadFiles(){

    if (isset($_FILES["fileToUpload"])){
        $target_dir = './upload/' ; 
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);  
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
        


        $file_path=$target_file;

$stmt = connectionBase()->prepare("INSERT INTO `uploaded_files` (`file_path`) VALUES ( :file_path);");



$stmt->bindParam(':file_path', $file_path);

$stmt->execute();

$file_to_download = ('<a href="' . $file_path . '" download>' . base64_encode($file_path) . '</a>');
    }
}

