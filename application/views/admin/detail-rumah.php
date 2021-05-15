<?= $this->session->flashdata('message');
?>
<div class="card mt-3">
    <div class="card-header">
        <h6>Data Anggaran Type <?= $type?></h6>
    </div>
    <div class="card-body">
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah">Tambah Bahan</a>

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahLabel">Tambah Bahan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('admin/add_bahan')?>" method="post">
                        <div class="modal-body">
                            <input type="hidden" value="<?= $type?>" name="type_rumah">
                            <div class="form-group">
                                <label for="namaBarang">Nama Bahan</label>
                                <input type="text" class="form-control" id="namaBarang" name="namaBarang" autofocus
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="jumlahBarang">Jumlah Bahan</label>
                                <input type="text" class="form-control" id="jumlahBarang" name="jumlahBarang" required>
                            </div>
                            <div class="form-group">
                                <label for="satuanBarang">Satuan Bahan</label>
                                <input type="text" class="form-control" id="satuanBarang" name="satuanBarang" required>
                            </div>
                            <div class="form-group">
                                <label for="persatuanBarang">Persatuan Bahan</label>
                                <input type="text" class="form-control" id="persatuanBarang" name="persatuanBarang"
                                    required>
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
        <!-- /. -->

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Persatuan</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($anggaran as $a):?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $a['nama_barang']?></td>
                    <td><?= $a['jumlah']?></td>
                    <td><?= $a['satuan']?></td>
                    <td><?= $a['persatuan']?></td>
                    <td><?= $a['total']?></td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#edit<?= $a['id_anggaran']?>" class="btn btn-sm btn-warning">Edit</a>

                        <!-- Modal Tambah -->
                        <div class="modal fade" id="edit<?= $a['id_anggaran']?>" tabindex="-1" aria-labelledby="tambahLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahLabel">Edit Bahan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= base_url('admin/edit_bahan/').$a['id_anggaran']?>" method="post">
                                        <div class="modal-body">
                                            <input type="hidden" value="<?= $type?>" name="type_rumah">
                                            <div class="form-group">
                                                <label for="namaBarang">Nama Bahan</label>
                                                <input type="text" class="form-control" id="namaBarang"
                                                    name="namaBarang" value="<?= $a['nama_barang']?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlahBarang">Jumlah Bahan</label>
                                                <input type="text" class="form-control" id="jumlahBarang"
                                                    name="jumlahBarang" value="<?= $a['jumlah']?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="satuanBarang">Satuan Bahan</label>
                                                <input type="text" class="form-control" id="satuanBarang"
                                                    name="satuanBarang" value="<?= $a['satuan']?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="persatuanBarang">Persatuan Bahan</label>
                                                <input type="text" class="form-control" id="persatuanBarang"
                                                    name="persatuanBarang" value="<?= $a['persatuan']?>" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <input type="submit" class="btn btn-primary" value="Tambah">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /. -->


                        <a href="<?= base_url('admin/delete_bahan/').$a['id_anggaran'].'/'.$type?>" onclick="return confirm('Apakah anda yakin menghapus data ?');" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php $no++; endforeach;?>
            </tbody>
        </table>
    </div>
</div>