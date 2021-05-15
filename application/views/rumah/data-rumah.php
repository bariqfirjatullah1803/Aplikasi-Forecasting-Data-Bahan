<?= $this->session->flashdata('message');
?>
<!-- Modal Tambah-->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('rumah/save')?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type_rumah">Type Rumah </label>
                        <input type="text" class="form-control" id="type_rumah" name="type_rumah" autofocus required>
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

<div class="card mt-3">

    <div class="card-body">
        <a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambah">Tambah Data</a>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type Rumah</th>
                    <th>Action</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;foreach($data_rumah as $dr):?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$dr['type_rumah']?></td>
                    <td>
                        <a href="" class="btn btn-sm btn-warning" data-toggle="modal"
                            data-target="#edit<?= $dr['id_rumah']?>">Edit</a>
                        <a href="<?= base_url('rumah/delete/').$dr['id_rumah']?>"
                            onclick="return confirm('Apakah anda yakin menghapus data ?');"
                            class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="edit<?= $dr['id_rumah']?>" tabindex="-1" aria-labelledby="editLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editLabel">Edit Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('rumah/edit/')?>" method="post">
                                <div class="modal-body">
                                    <input type="hidden" value="<?= $dr['id_rumah']?>" name="id_rumah">
                                    <div class="form-group">
                                        <label for="type_rumah">Type Rumah </label>
                                        <input type="text" class="form-control" id="type_rumah" name="type_rumah"
                                            autofocus required value="<?=$dr['type_rumah']?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <input type="submit" class="btn btn-primary" value="Edit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ./ -->

                <?php $no++;endforeach;?>
            </tbody>
        </table>
    </div>
</div>