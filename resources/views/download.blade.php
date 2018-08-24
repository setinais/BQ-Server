<?php
$arquivoLocal = '../app-release.apk';
if(isset($arquivoLocal) && file_exists($arquivoLocal)){
    $novoNome = 'espanglish.apk'; 
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="'.$novoNome.'"');
    header('Content-Type: application/octet-stream');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($arquivoLocal));
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Expires: 0');
    readfile($arquivoLocal); // lê o arquivo
    echo "ok";
    exit; // aborta pós-ações   
}else{
    echo 'false';
}
?>