<?=$this->session->flashdata('message');
?>
<?php
	$tanggalAwal = $this->db->query("SELECT MIN(DATE(date_created)) as dateMin FROM tb_transaksi")->row_array();
	$tanggalAkhir = $this->db->query("SELECT MAX(DATE(date_created)) as dateMax FROM tb_transaksi")->row_array();
	if ($minDate) {
	}else {
		$minDate  = $tanggalAwal['dateMin'];
	}
	if ($maxDate) {
		$maxDate ;
	}else {
		$maxDate = $tanggalAkhir['dateMax'];
	}
	if ($minDate<=$maxDate) {
		$transaksi = $this->db->query("SELECT * FROM tb_transaksi WHERE date_created BETWEEN '$minDate' AND '$maxDate' ORDER BY date_created ASC")->result_array();
		$pesan = null;
	}else {
		$transaksi = $this->db->get('tb_transaksi')->result_array();
		$pesan = 'Filter gagal !';
	}
?>
<div class="row">
    <div class="col-5">
        <div class="card">
            <div class="card-body">
                <form action="<?=base_url('transaksi/save');?>" method="post">

                    <div class="form-group">
                        <label for="nama_pembeli">Nama Pembeli</label>
                        <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" required>
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <div class="input-group mb-3">
                            <input type="number" min="0" max="99" class="form-control" name="unit[]" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="btnAdd">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="inputAdd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Plan</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="plan" required>
                            <?php
foreach ($plan as $p) {
    echo '<option  value="' . $p['id_plan'] . '">' . $p['nama_plan'] . '</option>';
}
?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jenis</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="rumah" required>
                            <option value="" selected>Tanah</option>
                            <?php
foreach ($type_rumah as $tp) {
    echo '<option  value="' . $tp['id_rumah'] . '">Rumah type ' . $tp['type_rumah'] . '</option>';
}
?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control uang" name="harga" required>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Save">
                    <!-- <button id="btnRemove">hapus</button> -->

                </form>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card">
            <div class="card-header">
                Transaksi
				<form action="<?= base_url('laporan/transaksi')?>" target="_blank" style="float:right" method="post">
					<input type="hidden" name="tanggalAwal" value="<?= $minDate?>">
					<input type="hidden" name="tanggalAkhir" value="<?= $maxDate?>">
					<button class="btn btn-sm btn-danger" ><i class="fas fa-print"></i> Cetak Laporan</button>
				</form>
            </div> 
            <div class="card-body">
                <form action="<?= base_url('Transaksi')?>" method="post" class="mb-5">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggalAwal">Mulai</label>
                                <input type="date" name="tanggalAwal" id="tanggalAwal" class="form-control"
                                    value="<?= $minDate?>" min="<?= $tanggalAwal['dateMin']?>"
                                    max="<?= $tanggalAkhir['dateMax']?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggalAkhir">Akhir</label>
                                <input type="date" name="tanggalAkhir" id="tanggalAkhir" class="form-control"
                                    value="<?= $maxDate?>" min="<?= $tanggalAwal['dateMin']?>"
                                    max="<?= $tanggalAkhir['dateMax']?>">
                            </div>
                        </div>
                        <button type="submit" class="mx-3 btn btn-block btn-primary">Tampilkan</button>
                    </div>
                </form>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
				<?php
					if ($pesan != null) {
						echo '<div class="alert alert-info" role="alert">'.$pesan.'</div>';
					}
				?>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pembeli</th>
                            <th>Unit</th>
                            <th>Harga</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$no = 1;
foreach ($transaksi as $t) {
    echo '<tr>';
    echo '<td>' . $no . '</td>';
    echo '<td>' . $t['nama_pembeli'] . '</td>';
    echo '<td>' . $t['unit'] . '</td>';
    echo '<td>' . $t['biaya'] . '</td>';
    echo '<td>' . $t['date_created'] . '</td>';
    echo '<td>
							<a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit' . $t['id'] . '">Edit</a>
							<a href="' . base_url('transaksi/delete/') . $t['id'] . '" onclick="return confirm(`Apakah anda yakin akan menghapus data ini ?`);" class="btn btn-danger btn-sm">Delete</a>
							</td>';
    echo '</tr>';
    echo '<div class="modal fade" id="edit' . $t['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<form action="' . base_url('transaksi/edit/') . $t['id'] . '" method="post">
									<div class="modal-content">
										<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<label for="nama" class="form-label">Nama Pembeli</label>
												<input name="nama" type="text" class="form-control" value="' . $t['nama_pembeli'] . '">
											</div>
											<div class="form-group">
												<label for="unit" class="form-label">Unit</label>
												<input name="unit" type="text" class="form-control" value="' . $t['unit'] . '">
											</div>
											<div class="form-group">
												<label for="exampleFormControlSelect1">Plan</label>
												<select class="form-control" id="exampleFormControlSelect1" name="plan" required>
													';
    foreach ($plan as $p) {
        echo '<option  value="' . $p['id_plan'] . '"';
        if ($p['id_plan'] == $t['id_plan']) {
            echo 'selected';
        }

        echo '>Rumah type ' . $p['nama_plan'] . '</option>';
    }
    echo '
												</select>
											</div>
											<div class="form-group">
												<label for="exampleFormControlSelect1">Jenis</label>
												<select class="form-control" id="exampleFormControlSelect1" name="rumah" required>
													<option value="">Tanah</option>';

    foreach ($type_rumah as $tp) {
        echo '<option  value="' . $tp['id_rumah'] . '"';
        if ($tp['id_rumah'] == $t['id_rumah']) {
            echo 'selected';
        }

        echo '>Rumah type ' . $tp['type_rumah'] . '</option>';
    }
    echo '
												</select>
											</div>
											<div class="form-group">
												<label for="harga" class="form-label">Harga</label>
												<input name="biaya" type="text" class="form-control uang" value="' . $t['biaya'] . '">
											</div>
											<div class="form-group">
												<label for="tanggal" class="form-label">Tanggal</label>
												<input name="date" type="date" class="form-control" value="' . $t['date_created'] . '">
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Save changes</button>
										</div>
									</div>
								</form>
							</div>
						  </div>';
    $no++;
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    // Format mata uang.
    $('.uang').mask('0.000.000.000', {
        reverse: true
    });
})
</script>
