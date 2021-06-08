
<?php
echo $this->session->flashdata('message');

$queryTransaksi = $this->db->get('tb_transaksi')->result_array();

$now = date("Y-m-d",time());
foreach ($queryTransaksi as $tq ) {
    $dateCreatedTransaksi = strtotime($tq['date_created']);
    $idtq = $tq['id'];
    for ($i=0; $i <= 70; $i++) { 
        $daysTransaksi = strtotime('+'.$i.' Days',$dateCreatedTransaksi);
        $dateTransaksi = date("Y-m-d",$daysTransaksi);
        $pembeli[$dateTransaksi][$idtq]['id'] = $tq['id'];
    }
}?>
<div class="row">
    <?php foreach ($pembeli[$now] as $p ):?>
    <?php
        $idp = $p['id'];
        $queryTransaksiById = $this->db->query("SELECT * FROM tb_transaksi INNER JOIN tb_rumah ON tb_rumah.id_rumah = tb_transaksi.id_rumah INNER JOIN tb_plan ON tb_plan.id_plan = tb_transaksi.id_plan WHERE tb_transaksi.id = $idp")->result_array();
        foreach ($queryTransaksiById as $qtbi ) :
            $queryPengerjaan = $this->db->query("SELECT * FROM tb_pengerjaan WHERE id_transaksi = $idp AND date_now = '$now'")->row_array();
    ?>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Info Pembangunan
                <?php 
                if (empty($queryPengerjaan)) {
                    echo '<span class="badge badge-primary">Menunggu</span>';
                }else{
                    echo '<span class="badge badge-success">Dikerjakan</span>';                    
                }
                ?>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="id_transaksi" class="form-label">No Transaksi <a data-toggle="modal"
                            data-target="#Detail<?= $qtbi['id']?>" href="#" class="badge badge-info badge-pill"><i
                                class="fas fa-eye"></i></a></label>
                    <input type="text" class="form-control" value="<?= $qtbi['id_transaksi']?>" readonly>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="Detail<?= $qtbi['id']?>" tabindex="-1"
                    aria-labelledby="Detail<?= $qtbi['id']?>Label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="Detail<?= $qtbi['id']?>Label">Detail Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">No Transaksi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id=""
                                            value="<?= $qtbi['id_transaksi']?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Atas Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id=""
                                            value="<?= $qtbi['nama_pembeli']?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Plan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" value="<?= $qtbi['nama_plan']?>"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Unit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" value="<?= $qtbi['unit']?>"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Type Rumah</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="" value="<?= $qtbi['type_rumah']?>"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Tanggal Pembelian</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id=""
                                            value="<?= $qtbi['date_created']?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Pengerjaan</label>
                                    <div class="col-sm-10">
                                        <?php
                                            $dateFirst = date("Y-m-d", strtotime($now));
                                            $dateLast = date("Y-m-d", strtotime("+10 Weeks", strtotime($qtbi['date_created'])));
                                            $strDateMin = new DateTime($dateFirst);
                                            $strDateMax = new DateTime($dateLast);
                                            $selsihTanggal = $strDateMax->diff($strDateMin)->days;
                                            $persenPengerjaan = $selsihTanggal / 70 * 100;
                                        ?>
                                        <div class="progress mt-2">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: <?= $persenPengerjaan?>%;"
                                                aria-valuenow="<?= $persenPengerjaan?>" aria-valuemin="0"
                                                aria-valuemax="100"><?= $persenPengerjaan?>%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $idRumah = $qtbi['id_rumah'];
                    $queryAnggaran = $this->db->query("SELECT * FROM tb_anggaran INNER JOIN tb_bahan ON tb_bahan.id_bahan = tb_anggaran.id_bahan WHERE tb_anggaran.id_rumah = $idRumah")->result_array();
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Bahan</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($queryAnggaran as $qa):?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $qa['nama_bahan']; ?></td>
                            <td><?= $qa['jumlah'].' '.$qa['satuan']; ?></td>
                            <td><?php 
                            if ($qa['stok'] - $qa['jumlah'] <= 0) {
                                echo 'Bahan Kurang';
                                $status[$no]['nama_bahan'] = $qa['nama_bahan'];
                                $status[$no]['status'] = 'Bahan Kurang';
                            }else{
                                echo 'Bahan Cukup';
                            }?></td>
                        </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if ($status = null || empty($queryPengerjaan)):?>
            <form action="<?= base_url('admin/pengerjaan')?>" method="post">
                <input type="hidden" name="id" value="<?= $qtbi['id']?>">
                <input type="hidden" name="date" value="<?= $now?>">
                <input type="hidden" name="status" value="1">
                <input type="hidden" name="rumah" value="<?= $qtbi['id_rumah']?>">
                <button type="submit" class="btn btn-primary btn-block">Kerjakan</button>
            </form>
            <?php endif?>
        </div>
    </div>
    <?php endforeach;?>
    <?php endforeach?>
</div>