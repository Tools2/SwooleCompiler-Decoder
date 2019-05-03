<?php 
$filename = "./admin.php";
$body = file_get_contents($filename);
$body = substr($body,112,strlen($body));
$str = sprintf("&(( %d (*&",strlen($body));
$str = str_pad($str,19,"\x00");
$sha1 = sha1($str);
$xor="*&(*^(*@NLwoJL(@*&&)*)35$(&#)*@)(@&guo$)(@*)JLshiJJLKSJD(&)(*)(*)";

$table[] = array();
for ($index = 0,$j_index=0; $j_index < strlen($xor); $j_index++,$index++) {
    if($index == strlen($sha1)  ){
        $index = 0 ;
    }
     $table[$j_index]= $sha1[$index] ^ $xor[$j_index];
}
for ($i=0,$j=0; $j < strlen($body); $j++,$i++) { 
    if($i == 0x40  ){
        $i = 0;
    }
    $body[$j] = $table[$i] ^ $body[$j];
}
file_put_contents($filename.".sw.php",$body);
?>