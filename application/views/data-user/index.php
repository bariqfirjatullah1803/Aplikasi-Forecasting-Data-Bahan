<?= $this->session->flashdata('message');
?>
<div class="card">
    <div class="card-header">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i>
            Tambah data</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($data_user as $du):?>
                <tr>
                    <td><?= $no?></td>
                    <td><?= $du['nama_user']?></td>
                    <td><?= $du['username']?></td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#modal-edit-<?= $du['id_user']?>"
                            class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                        <a href="<?= base_url('data_user/delete/').$du['id_user']?>"
                            onclick="return confirm('Data akan di hapus secara permanen, apakah anda yakin ? ')"
                            class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></a>
                        <a href="" data-toggle="modal" data-target="#modal-change-<?= $du['id_user']?>"
                            class="btn btn-sm btn-secondary" title="Change Password"><i class="fas fa-key"></i></a>
                    </td>
                </tr>
                <div class="modal fade" id="modal-edit-<?= $du['id_user']?>" tabindex="-1" aria-labelledby="modal-edit-<?= $du['id_user']?>Label"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-edit-<?= $du['id_user']?>Label">Edit Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('data_user/edit/').$du['id_user']?>" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label" for="nama">Nama</label>
                                        <input type="text" name="nama" class="form-control" required value="<?= $du['nama_user']?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" name="username" class="form-control" required value="<?= $du['username']?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-change-<?= $du['id_user']?>" tabindex="-1" aria-labelledby="modal-change-<?= $du['id_user']?>Label"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-change-<?= $du['id_user']?>Label">Change Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('data_user/edit_password/').$du['id_user']?>" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="form-label" for="password">Password Baru</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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

<!-- Modal -->
<div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="modal-tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tambahLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('data_user/add')?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>