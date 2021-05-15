<a href="" class="btn btn-primary " data-toggle="modal" data-target="#tambah">Tambah Data</a>
<?= $this->session->flashdata('message');
?>
<!-- Modal Tambah-->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/add_transaksi')?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Type Rumah</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="type_rumah">
                            <?php foreach($type as $t):?>
                            <option value="<?= $t['type_rumah']?>"><?= $t['type_rumah']?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Tambah">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./ -->
<div class="row">
    <div class="col-6">
        <div class="card mt-3">
            <div class="card-header">
                <h6>Data Transaksi Penjualan</h6>
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type Rumah</th>
                            <th>Jumlah Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;foreach($penjualan as $p):?>
                        <tr>
                            <td><?=$no?></td>
                            <td><?= $p['type_rumah']?></td>
                            <td><?= $p['jumlah_penjualan']?></td>
                        </tr>
                        <?php $no++; endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card mt-3">
            <div class="card-header">
                <h6>History Pembayaran</h6>
            </div>
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type Rumah</th>
                            <th>Tanggal Penjualan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;foreach($history as $h):?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $h['type_rumah']?></td>
                            <td><?= $h['date_created']?></td>
                            <td><a href="<?= base_url('admin/delete_transaksi/').$h['id_transaksi']?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin menghapus data ?');">Hapus</a></td>
                        </tr>
                        <?php $no++; endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>