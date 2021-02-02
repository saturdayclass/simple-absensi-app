<?php
  include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Export data lembur</title>
</head>
<body>
  <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Lembur.xls");
  ?>

  <table class="table table-striped" id="table-1">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Jam Mulai</th>
        <th>Jam Selesai</th>
        <th>Aktivitas</th>
        <th>Approval Unit</th>
        <th>Approval Cabang</th>
        <th>Approval Final</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $kueri = $conn->prepare("SELECT * FROM tb_lembur ORDER BY tanggal ASC");
      $kueri->execute();
      while($tampil = $kueri->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
          <td><?php echo $no++;?></td>
          <td><?php echo $tampil['nama'];?></td>
          <td><?php echo $tampil['tanggal'];?></td>
          <td><?php echo $tampil['jam_mulai'];?></td>
          <td><?php echo $tampil['jam_selesai'];?></td>
          <td><?php echo $tampil['aktivitas'];?></td>
          <td><?php if($tampil['approval_unit']){ echo "Sudah di setujui";}?></td>
          <td><?php if($tampil['approval_cabang']){ echo "Sudah di setujui";}?></td>
          <td><?php if($tampil['approval_final']){ echo "Sudah di setujui";}?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

</body>
</html>