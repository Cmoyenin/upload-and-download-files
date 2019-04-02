<?php 
require_once 'connexion.php';


function uploadFiles(){

    if (isset($_FILES["fileToUpload"])){
        
        
        $filename_uploaded = explode('.', basename($_FILES["fileToUpload"]["name"])) ;
        $filename_tmp = basename($_FILES["fileToUpload"]["tmp_name"] .'.'.$filename_uploaded[1]);

        $target_dir = './upload/' ; 
        //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);  
        $target_file = $target_dir . $filename_tmp;  

        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);

        $file_nom=$_FILES['fileToUpload']['name'];
        $tmp_name=$_FILES['fileToUpload']['tmp_name'];
        
        $stmt = connectionBase()->prepare("INSERT INTO `uploaded_files` (`file_nom` , `tmp_name`) VALUES ( :file_nom , :tmp_name);");
        $stmt->bindParam(':file_nom', $file_nom);
        $stmt->bindParam(':tmp_name', $tmp_name);
        $stmt->execute();


/*
faudrait que lorsque je click sur le lien, je reconvertisse le fichier en "vrai" nom
*/


        $file_to_download = ('<a href="upload/' . $filename_tmp . '" download="' . $file_nom .'">' . $_FILES["fileToUpload"]["name"] . '</a>');
        echo($file_to_download);


    }
}

