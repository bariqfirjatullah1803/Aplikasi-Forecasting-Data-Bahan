<?= $this->session->flashdata('message');?>
<!-- Table Bahan -->

<div class="card mt-3">
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambah">
            Tambah Data <?php if(validation_errors()){ echo '<i class="fa fa-exclamation-circle"></i>';}?>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('bahan')?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama Bahan</label>
                                <input type="text"
                                    class="form-control text-capitalize <?php if(form_error('nama')){ echo 'is-invalid';}?>" id="nama"
                                    name="nama">
                                <?= form_error('nama','<div class="invalid-feedback">','</div>')?>
                            </div>
                            <div class="form-group">
                                <label for="satuan">Satuan Bahan</label>
                                <input type="text"
                                    class="form-control text-capitalize <?php if(form_error('satuan')){ echo 'is-invalid';}?>"
                                    id="satuan" name="satuan">
                                <?= form_error('satuan','<div class="invalid-feedback">','</div>')?>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga Bahan</label>
                                <input type="number" min="0"
                                    class="form-control text-capitalize <?php if(form_error('harga')){ echo 'is-invalid';}?>" id="harga"
                                    name="harga" value="<?= set_value('harga')?>"
                                    oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                                <?= form_error('harga','<div class="invalid-feedback">','</div>')?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="sumbit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Bahan</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($data_bahan as $db):?>
                <tr>
                    <td><?= $no?></td>
                    <td><?= $db['nama_bahan']?></td>
                    <td><?= $db['satuan']?></td>
                    <td><?= $db['harga']?></td>
                    <td><?= $db['stok']?></td>
                    <td>
                        <button data-toggle="modal" data-target="#modalEdit<?= $db['id_bahan']?>"
                            class="btn btn-sm btn-warning">Edit</button>
                        <a href="<?= base_url('bahan/delete/').$db['id_bahan']?>"
                            class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="modalEdit<?= $db['id_bahan']?>" tabindex="-1" aria-labelledby="modalEditLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel">Edit Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('bahan/edit/')?>" method="POST">
                                <div class="modal-body">
                                <input type="hidden" value="<?= $db['id_bahan']?>" name="id_bahan">
                                    <div class="form-group">
                                        <label for="nama">Nama Bahan</label>
                                        <input type="text"
                                            class="form-control text-capitalize <?php if(form_error('nama')){ echo 'is-invalid';}?>"
                                            id="nama" name="nama" value="<?= $db['nama_bahan']?>">
                                        <?= form_error('nama','<div class="invalid-feedback">','</div>')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="satuan">Satuan Bahan</label>
                                        <input type="text"
                                            class="form-control text-capitalize <?php if(form_error('satuan')){ echo 'is-invalid';}?>"
                                            id="satuan" name="satuan" value="<?= $db['satuan']?>">
                                        <?= form_error('satuan','<div class="invalid-feedback">','</div>')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga Bahan</label>
                                        <input type="number" min="0"
                                            class="form-control text-capitalize <?php if(form_error('harga')){ echo 'is-invalid';}?>"
                                            id="harga" name="harga" value="<?= $db['harga']?>"
                                            oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                                        <?= form_error('harga','<div class="invalid-feedback">','</div>')?>
                                    </div>
                                    <div class="form-group">
                                        <label for="stok">Stok Bahan</label>
                                        <input type="number" min="0"
                                            class="form-control text-capitalize <?php if(form_error('stok')){ echo 'is-invalid';}?>"
                                            id="stok" name="stok" value="<?= $db['stok']?>"
                                            oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null">
                                        <?= form_error('stok','<div class="invalid-feedback">','</div>')?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="sumbit" class="btn btn-primary">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php $no++; endforeach?>
            </tbody>
        </table>
    </div>
</div>