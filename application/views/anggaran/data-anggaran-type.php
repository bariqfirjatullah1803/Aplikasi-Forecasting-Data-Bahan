<script>
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 &&
        (charCode < 48 || charCode > 57))
        return false;

    return true;
}
</script>
<?= $this->session->flashdata('message');
?>
<?php
    $t = $type['id_rumah'];
    $qmin = $this->db->query("SELECT MIN(id_bahan) as id_bahan FROM tb_anggaran WHERE id_rumah = $t")->row_array();
    $qmax = $this->db->query("SELECT MAX(id_bahan) as id_bahan FROM tb_anggaran WHERE id_rumah = $t")->row_array();
    $idmin = $qmin['id_bahan'];
    $idmax = $qmax['id_bahan'];
    $data_bahan = $this->db->query("SELECT * FROM tb_bahan WHERE id_bahan NOT BETWEEN $idmin AND $idmax")->result_array();
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
            <form action="<?= base_url('anggaran/save')?>" method="post">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="type_rumah" value="<?= $type['type_rumah']?>">
                    <input type="hidden" class="form-control" name="id_rumah" value="<?= $type['id_rumah']?>">
                    <div class="form-group">
                        <label for="inputBahan">Bahan</label>
                        <select id="inputBahan" class="form-control" name="id_bahan" required>
                            <option value="" selected>Pilih Bahan</option>
                            <?php foreach($data_bahan as $db):?>
                            <option value="<?= $db['id_bahan']?>"><?= $db['nama_bahan']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputJumlah">Jumlah Bahan</label>
                        <input type="text" class="form-control" name="jumlah" onkeypress="return isNumberKey(event)"
                            required>
                    </div>
                </div>
                <div class=" modal-footer">
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
                    <th>Bahan</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Persatuan</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $jumlah = 0; $total = 0;$no = 1;foreach($data_anggaran as $da):?>
                <?php
                    $total = floatval($da['jumlah']) * $da['harga'];
                    $rtotal = round($total);
                    
                ?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$da['type_rumah']?></td>
                    <td><?=$da['nama_bahan']?></td>
                    <td><?=$da['jumlah']?></td>
                    <td><?=$da['satuan']?></td>
                    <td><?="Rp " . number_format($da['harga'],2,',','.');?></td>
                    <td><?= "Rp " . number_format($rtotal,2,',','.'); ?></td>
                    <td>
                        <a href="" class="btn btn-sm btn-warning" data-toggle="modal"
                            data-target="#edit<?= $da['id_anggaran']?>">Edit</a>
                        <a href="<?= base_url('anggaran/delete/').$da['id_anggaran']?>"
                            onclick="return confirm('Apakah anda yakin menghapus data ?');"
                            class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="edit<?= $da['id_anggaran']?>" tabindex="-1" aria-labelledby="editLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editLabel">Edit Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('anggaran/edit/')?>" method="post">
                                <div class="modal-body">
                                    <input type="hidden" value="<?= $da['id_anggaran']?>" name="id_anggaran">
                                    <input type="hidden" value="<?= $da['id_bahan']?>" name="id_bahan">
                                    <input type="hidden" value="<?= $da['id_rumah']?>" name="id_rumah">
                                    <div class="form-group">
                                        <label for="bahan">Bahan</label>
                                        <input type="text" class="form-control" id="bahan" name="bahan" required
                                            value="<?=$da['nama_bahan']?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputJumlah">Jumlah Bahan</label>
                                        <input type="text" class="form-control" name="jumlah"
                                            onkeypress="return isNumberKey(event)" required value=<?= $da['jumlah']?>>
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

                <?php $jumlah += $rtotal;$no++;endforeach;?>
                <tr>
                    <td style="display : none">1000</td>
                    <td style="display : none"></td>
                    <td style="display : none"></td>
                    <td style="display : none"></td>
                    <td style="display : none"></td>
                    <td colspan="6">Jumlah</td>
                    <td colspan="2"><?=  "Rp " . number_format($jumlah,2,',','.');  ?></td>
                    <td style="display : none"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>