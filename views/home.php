<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<h1>Halo world dari Home</h1>
<?php 
    foreach ($gudang as $d) {
        echo "<p>" . $d['nama_gudang'] . "</p>";
        echo "<p>". $d['lokasi_gudang'] . "</p>";
    }
?>

<?php $this->endSection(); ?>
