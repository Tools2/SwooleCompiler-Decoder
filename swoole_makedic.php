<?php
//r8d 32位
$ht = makeTable(__DIR__."/dic.txt");
$content = '<?php $swoole_dic = '.var_export($ht,true);

file_put_contents(__DIR__."/swoole_dic.php",$content);
function makeTable($filename){
    $ht   = array();
    $file = file($filename);
    foreach($file as &$line){
        $key = trim($line);
        $ht[getFunName($key)] = $key;
    }
    return $ht;
}
function getFunName($name){
    $r8 = 0x1505;
    for( $i=0; $i < strlen($name) ; $i++){
        $r8 = ord($name[$i]) + $r8 * 0x21;
        $r8 =  $r8 & 0xFFFFFFFF;
    }
    $encode_str2 = sprintf("_%u",$r8);
    $r8 = 0x1505;
    for( $i=0; $i < strlen($encode_str2) ; $i++){
        $r8 = ord($encode_str2[$i]) + $r8 * 0x21;
        $r8 =  $r8 & 0xFFFFFFFF;
    }
    $result = sprintf("_%u",$r8);
    return $result;
}