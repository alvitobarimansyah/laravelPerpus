<?php
$nama = 'Alvito Barimansyah';
$matpel = 'Phyton';
$nilai = 90;
$ket = ($nilai >= 60) ? 'Lulus' : 'Gagal';
if($nilai >= 85 && $nilai <= 100) $grade = 'A';
        else if($nilai >= 75 && $nilai <= 85) $grade = 'B';
        else if($nilai >= 60 && $nilai <= 75) $grade = 'C';
        else if($nilai >= 30 && $nilai <= 60) $grade = 'D';
        else if($nilai >= 0 && $nilai <= 30) $grade = 'E';
        else $grade = '';

        switch ($grade) {
            case 'A': $predikat = 'Istimewa'; break;
            case 'B': $predikat = 'Baik'; break;
            case 'C': $predikat = 'Cukup'; break;
            case 'D': $predikat = 'Kurang'; break;
            case 'E': $predikat = 'Buruk'; break;
            default: $predikat = '';
        }
?>

Nama : <?= $nama ?>
<br>Mata Pelajaran : <?= $matpel ?>
<br>Nilai : <?= $nilai ?>
<br>Keterangan : <?= $ket ?>
<br>Grade : <?= $grade ?>
<br>Predikat : <?= $predikat ?>