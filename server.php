<?php

require_once('nusoap-0.9.5/lib/nusoap.php');
$server = new soap_server();

// registrasi method 'search'
$server->register('search');

// detail method 'search' dengan parameter $key
function search($key)
{
     // koneksi ke database
     mysql_connect('localhost', 'satub', 'satub');
     mysql_select_db('satub_3196');

     // query pencarian data mahasiswa
     $query = "SELECT * FROM valuta_asing WHERE id = '$key' OR mata_uang LIKE '%$key%' OR jual LIKE '%$key%' OR beli LIKE '%$key%'";
     $hasil = mysql_query($query);
     while ($data = mysql_fetch_array($hasil))
     {
          // menyimpan data hasil pencarian dalam array
          $result[] = array('mata_uang' => $data['mata_uang'], 'jual' => $data['jual'], 'beli' => $data['beli']);
     }
     // mereturn array hasil pencarian
     return $result;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>