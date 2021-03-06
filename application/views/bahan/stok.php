<?= $this->session->flashdata('message');
?>
<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('bahan/add_stok')?>" method="post">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Nama Bahan</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="bahan">
                                    <?php foreach($bahan AS $b):?>
                                    <option value="<?= $b['id_bahan']?>"><?= $b['nama_bahan']?></option>
                                    <?php endforeach?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="stok" class="form-label">Jumlah Bahan Datang</label>
                                <input type="number" min="0" name="stok" class="form-control" required>
                            </div>
                            <input style="float:right" type="submit" class="btn btn-primary" value="Tambah">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        Data bahan datang hari ini
						<a href="<?= base_url('laporan/bahanmasuk')?>" target="_blank" class="btn btn-sm btn-danger" style="float: right;"><i class="fas fa-print"></i> Cetak</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bahan</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($bahan_masuk as $bm):?>
                                <tr>
                                    <td><?= $no?></td>
                                    <td><?= $bm['nama_bahan']?></td>
                                    <td><?= ceil($bm['stok']).$bm['satuan']?></td>
                                    <td><a title="Edit" href="" class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#exampleModal<?= $no?>"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" href="<?= base_url('bahan/delete_stok/').$bm['id_stok']?>" onclick="return confirm('Yakin Hapus?')"><i class="fas fa-trash"></i></a>
                                            </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $no?>" tabindex="-1"
                                    aria-labelledby="exampleModal<?= $no?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModal<?= $no?>Label">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('bahan/update_stok/').$bm['id_stok']; ?>" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="namaBahan" class="form-label">Nama Bahan</label>
                                                        <input type="text" class="form-control"
                                                            value="<?= $bm['nama_bahan']?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="stok" class="form-label">Stok</label>
                                                        <input name="stok" type="text" class="form-control" value="<?= $bm['stok']?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php $no++; endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Stok</th>
                            <th>satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($bahan AS $b):?>
                        <tr>
							
                            <td><?= $b['nama_bahan']?></td>
                            <td><?= ceil($b['stok']).' '.$b['satuan']?></td>
                            <td><?= $b['satuan']?></td>
                        </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
