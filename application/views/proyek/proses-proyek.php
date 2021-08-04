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
    <?php if(empty($pembeli[$now])){
	$pembeli[$now] = 0;
}
if ($pembeli[$now] != 0):
?>

    <?php foreach ($pembeli[$now] as $p ):?>
    <?php
        $idp = $p['id'];
        $queryTransaksiById = $this->db->query("SELECT * FROM tb_transaksi INNER JOIN tb_rumah ON tb_rumah.id_rumah = tb_transaksi.id_rumah INNER JOIN tb_plan ON tb_plan.id_plan = tb_transaksi.id_plan WHERE tb_transaksi.id = $idp")->result_array();
        foreach ($queryTransaksiById as $qtbi ) :
            $queryPengerjaan = $this->db->query("SELECT * FROM tb_pengerjaan WHERE id_transaksi = $idp AND date_now = '$now'")->row_array();
			$querySpk = $this->db->query("SELECT * FROM tb_spk WHERE id_transaksi = $idp AND date_created = '$now'")->row_array();
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
                    <label for="id_transaksi" class="form-label">Atas Nama <a data-toggle="modal"
                            data-target="#Detail<?= $qtbi['id']?>" href="#" class="badge badge-info badge-pill"><i
                                class="fas fa-eye"></i></a></label>
                    <input type="text" class="form-control" value="<?= $qtbi['nama_pembeli']?>" readonly>
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
                                <!-- <div class="form-group row">
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
                                </div> -->
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
                <table class="table table-striped" id="pengerjaan">
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
                            <td><?= ceil($qa['jumlah']).' '.$qa['satuan']; ?></td>
                            <td><?php 
                            if ($qa['stok'] - $qa['jumlah'] <= 0) {
                                echo '<span class="badge badge-danger">Bahan Kurang</span>';
                                $status[$no]['nama_bahan'] = $qa['nama_bahan'];
                                $status[$no]['status'] = 'Bahan Kurang';
                            }else{
                                echo '<span class="badge badge-success">Bahan Cukup</span>';
                            }?></td>
                        </tr>
                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if(empty($queryPengerjaan)):?>
            <!-- <form action="<?= base_url('admin/pengerjaan')?>" method="post">
                <input type="hidden" name="id" value="<?= $qtbi['id']?>">
                <input type="hidden" name="date" value="<?= $now?>">
                <input type="hidden" name="status" value="1">
                <input type="hidden" name="rumah" value="<?= $qtbi['id_rumah']?>">
                <button type="submit" class="btn btn-primary btn-block"
                    <?php if (!empty($status)){echo 'disabled';}?>>Kerjakan</button>
            </form> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Kerjakan
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Pengerjaan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('admin/pengerjaan')?>" method="post">
                                <input type="hidden" name="id" value="<?= $qtbi['id']?>">
                                <input type="hidden" name="status" value="1">
                                <input type="hidden" name="rumah" value="<?= $qtbi['id_rumah']?>">
                                <div class="form-group">
                                    <label for="">Pembangunan Atas Nama</label>
                                    <input type="text" name="atasnama" class="form-control" required
                                        value="<?= $qtbi['nama_pembeli']?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Pemilik</label>
                                    <input type="text" name="pemilik" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Jabatan</label>
                                    <input type="text" name="jabatanpemilik" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Pelaksana</label>
                                    <input type="text" name="pelaksana" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jabatan</label>
                                    <input type="text" name="jabatanpelaksana" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat Pelaksana</label>
                                    <input type="text" name="alamatpelaksana" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pengerjaan</label>
                                    <input type="date" name="date" value="<?= $now?>" class="form-control" readonly>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Lanjutkan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php else:?>
            <form action="<?= base_url('admin/pembatalan')?>" method="post">
                <input type="hidden" name="id_pengerjaan" value="<?= $queryPengerjaan['id_pengerjaan']?>">
                <input type="hidden" name="id_spk" value="<?= $querySpk['id_spk']?>">
                <input type="hidden" name="id" value="<?= $qtbi['id']?>">
                <input type="hidden" name="date" value="<?= $now?>">
                <input type="hidden" name="status" value="1">
                <input type="hidden" name="rumah" value="<?= $qtbi['id_rumah']?>">
                <button type="submit" class="btn btn-danger btn-block">Batalkan</button>
            </form>
            <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#spk">
                Surat Perintah Kerja
            </button>
            <div class="modal fade" id="spk" tabindex="-1" aria-labelledby="spk" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Surat Perintah Kerja</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="kop-surat">
                                    <img src="<?= base_url('assets/img/')?>logopt.jpeg" alt="" srcset="">
                                    <br><b>PT TANIYA MULTI PROPERTI</b>
                                    <h5>JL.RAYA CURUNGREJO KEC.KEPANJEN KAB.MALANG</h5>
                                    <h5>NO. HP 081358695449</h5>
                                    <hr>
                                </div>
                                <div class="container">

                                    <div class="info-surat">
                                        <div class="title"><b><u>Surat Perintah</u></b></div>
                                        <p>Nama : <?= $querySpk['nama_pemilik']?></p>
                                        <p>Jabatan : <?= $querySpk['jabatan_pemilik']?></p>
                                    </div>
                                    <div class="isi-surat">
                                        <div class="title"><b><u>Memerintahkan</u></b></div>
                                        <p>Kepada,</p>
                                        <dl>
                                            <dd>Nama : <?= $querySpk['nama_pekerja']?></dd>
                                            <dd>Jabatan : <?= $querySpk['jabatan_pekerja']?></dd>
                                            <dd>Alamat : <?= $querySpk['alamat_pekerja']?></dd>
                                            <dd>Tanggal Pelaksanaan : <?= $querySpk['date_created']?></dd>
                                    </div>
                                    <p>Untuk,</p>
                                    <div class="info">
                                        <ol>
                                            <li>Memproses pengerjaan lahan di desa Pidek RT/RW 009/003 Pkisaji -
                                                Kab.Malang</li>
                                            <li>Proses pembangunan sebanyak 1 unit.</li>
                                            <li>Pembangunan dilakukan pada blok berikut :
                                                <ul>
                                                    <li>Kavling <?= $qtbi['unit']?> (<?= $qtbi['nama_plan']?>) type rumah <?= $qtbi['type_rumah']?> A.n <?= $qtbi['nama_pembeli']?></li>
                                                </ul>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="ttd">
                                    <div class="tgl">Malang, <?= $now?></div>
                                    <div class="nama"><?= $querySpk['nama_pemilik']?></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a target="_blank" href="<?= base_url('admin/cetakspk/').$querySpk['id_spk']?>" class="btn btn-primary"><i class="fas fa-print"></i >Cetak Surat Perintah Kerja</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif?>
        </div>
    </div>
    <?php endforeach;?>
    <?php endforeach;?>
</div>
<?php else:?>
</div>
<div class="alert alert-info" role="alert">
    Tidak ada pembangunan !
</div>
<?php endif?>
