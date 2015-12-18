<?php

ini_set('max_execution_time', 300);
error_reporting (E_ALL);
//error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(E_ALL);


// Perhatian PENTING untuk konfigurasi WAKTU dibawah.
// Ubah menjadi 3600 untuk cache 1 jam, ketika semuanya sudah berjalan normal.
// Menggunakan cache berarti tidak perlu membuka koneksi ke klikbca
// setiap kali halaman dibuka << ini PENTING! menghemat waktu, dan mengurangi proses server.
//
$nkurs['cachetime'] = 3600; /* ubah jadi 3600 atau lebih 14400 */
//$nkurs['cachetime'] = 0; /* ubah jadi 3600 atau lebih 14400 */
//
// Hilangkan mata uang yang tidak mau ditampilkan.

$nkurs['curr'] = array ('USD', 'SGD', 'HKD', 'CHF', 'GBP', 'AUD', 'JPY', 'SEK', 'DKK', 'CAD', 'EUR', 'SAR', 'NZD', 'CNY');

// menggunakan CURL, jika file_get_contents tidak bisa dihostingan Anda, baca manual PHP untuk selengkapnya
function curl_get_file_contents($URL) {
	$c = curl_init();
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_URL, $URL);
	$contents = curl_exec($c);
	curl_close($c);
	if ($contents) return $contents;
	else return FALSE;
}

$nkurs["remotelastupdate"] = '';
$nkurs["data"] = array();

$nkurs['scriptpath'] = dirname (__FILE__);
$nkurs['cachefile'] = $nkurs['scriptpath'] . '/cache.txt';
if (!file_exists ($nkurs['cachefile']) || !is_writable ($nkurs['cachefile'])){ die ('File cache.txt belum ada atau belum writable.<br />Buat file: <code>' . $nkurs['cachefile'] . '</code><br />Lalu CHMOD ke 666'); }
if (filemtime ($nkurs['cachefile']) <= ( time () - $nkurs['cachetime'] ) && $handle = file_get_contents("http://www.bca.co.id/id/kurs-sukubunga/kurs_counter_bca/kurs_counter_bca_landing.jsp"))  {
	$handle = explode ('<div style="float:left;margin-left:10px;padding: 10px;width:700px;padding-bottom:40px;min-height:220px;">', $handle);
	if(is_array($handle) && isset($handle[1])) {
		$handle = explode ('</tbody>', $handle[1]);
		$handle_kurs_a = explode('</table>', $handle[0]);
		$handle_remote = extract_unit ($handle[0], '<div align="center">', '</div>');
		$nkurs['remotelastupdate'] = trim($handle_remote);

		$handle_kurs = explode('<td><strong><br/>Mata Uang<br/></strong></td>', $handle_kurs_a[0]);

		$handle_kurs_arr = explode('<tr>', $handle_kurs[1]);

		$nkurs_arr = array ();
		foreach ($handle_kurs_arr as $key => $val) {
			if($key == 0) continue;
			$curr = extract_unit($val, '<td style="text-align:center;">', '</td>');
			$nkurs_arr[] = $curr;
		}

		$handle_jb = $handle[0];
		$handle_jb = explode('<td><strong>Beli</strong></td>', $handle_jb);
		$handle_jb_arr = explode('<tr>', $handle_jb[1]);
		$jual_arr = array();
		$beli_arr = array();
		foreach ($handle_jb_arr as $key => $val) {
			if($key == 0) continue;
			$jb_arr = explode('</td>', $val);
			$jual = trim(str_replace('<td style="text-align:right;">', '', $jb_arr[0]));
			$jual = trim(str_replace('<!-- kolom dua -->', '', $jual));
			$beli = trim(str_replace('<td style="text-align:right;">', '', $jb_arr[1]));
			$beli = trim(str_replace('<!-- kolom dua -->', '', $beli));
			$jual_arr[] = $jual;
			$beli_arr[] = $beli;
		}
		$nkurs['data'] = array();
		$no = 0;
		foreach ($nkurs_arr as $val) {
			$nkurs['data'][$val] = array ($jual_arr[$no], $beli_arr[$no]);
			$no++;
		}

		$tocache = array ();
		foreach ($nkurs['data'] as $key => $val) {
			$tocache[] = $key . '|' . $val[0] . '|' . $val[1];
		}
		// INSERT DB
		// $data_ins_db = array( 'tanggal' => $nkurs['remotelastupdate'], 'isi' => implode ("\n", $tocache));
		// require_once('kurs_simpan_db.php');
		
		// TULIS FILE cache.txt
		$tocache[] = 'remotelastupdate|' . $nkurs['remotelastupdate'];
		$tocache = implode ("\n", $tocache);
		$handle = fopen ($nkurs['cachefile'], 'w');
		fwrite ($handle, $tocache);
		fclose ($handle);
	}
} else {
	$handle = file ($nkurs['cachefile']);
	$nkurs['data'] = array ();
	foreach ($handle as $val) {
		$val = explode ('|', $val);
		if ($val[0] != 'remotelastupdate') {
			$nkurs['data'][$val[0]] = array ($val[1], trim ($val[2]));
		}
		else
		{
			$nkurs['remotelastupdate'] = $val[1];
		}
	}
}
//
// Output
//

//tulis ke db
$con = mysqli_connect('localhost','satub','satub','satub_3196');
mysqli_query($con, "TRUNCATE valuta_asing");
foreach ($nkurs['data'] as $key => $value) {
	mysqli_query($con, "INSERT INTO `satub_3196`.`valuta_asing` (`mata_uang`, `jual`, `beli`,`rec_upd`) VALUES ('$key', '$value[0]', '$value[1]','$val[1]')");
}

/*
$output = "\n";
$margin = '';
$output .= $margin . '<div id="nKurs">' . "\n";
$output .= $margin . '	<table width="100%" border="0" cellspacing="1" cellpadding="0">' . "\n";
$output .= $margin . '		<tr><th>Mata Uang</th><th>Jual</th><th>Beli</th></tr>' . "\n";
$rowclass = 'row1';
if(is_array($nkurs['data']) && isset($nkurs['data'])) {
	foreach ($nkurs['data'] as $key => $val) {
		if (in_array ($key, $nkurs['curr'])) {
			if ($rowclass == 'row1'){ $rowclass = 'row2'; }else{ $rowclass = 'row1'; }
			$output .= $margin . '		<tr><td align="center" class="curr ' .$rowclass . '">' . $key . '</td><td align="right" class="' . $rowclass . '">' . number_format($val[0], 2) . '</td><td align="right" class="' . $rowclass . '">' . number_format($val[1], 2) . '</td></tr>' . "\n";
		}
	}
}
$output .= $margin . '	</table>' . "\n";
$output .= $margin . '	<cite><a href="http://www.klikbca.com/" rel="external" title="Source: KlikBCA">' . $nkurs["remotelastupdate"] . '</a></cite>' . "\n";
$output .= $margin . '</div>' . "\n";
echo $output;
*/

// tambahan fungsi
function extract_unit($string, $start, $end) {
	$pos = stripos($string, $start);
	$str = substr($string, $pos);
	$str_two = substr($str, strlen($start));
	$second_pos = stripos($str_two, $end);
	$str_three = substr($str_two, 0, $second_pos);
	$unit = trim($str_three);
	return $unit;
}
