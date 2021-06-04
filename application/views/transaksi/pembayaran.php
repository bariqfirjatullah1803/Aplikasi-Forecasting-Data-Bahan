<?= $this->session->flashdata('message');
?>

<div class="row">
    <div class="col-5">
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('transaksi/save'); ?>" method="post">

                    <div class="form-group">
                        <label for="nama_pembeli">Nama Pembeli</label>
                        <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" required>
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="unit[]" required>
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
                            foreach ($plan as $p ) {
                                echo '<option  value="'.$p['id_plan'].'">'.$p['nama_plan'].'</option>';
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jenis</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="rumah" required>
                        <option value="" selected>Tanah</option>
                            <?php
                            foreach ($type_rumah as $tp ) {
                                echo '<option  value="'.$tp['id_rumah'].'">Rumah type '.$tp['type_rumah'].'</option>';
                            }
                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" name="harga" required>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Save">
                    <!-- <button id="btnRemove">hapus</button> -->

                </form>
            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pembeli</th>
                            <th>Unit</th>
                            <th>Harga</th>
                            <th>Tanggal</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($transaksi as $t ) {
                            echo '<tr>';
                            echo '<td>'.$no.'</td>';
                            echo '<td>'.$t['nama_pembeli'].'</td>';
                            echo '<td>'.$t['unit'].'</td>';
                            echo '<td>'.$t['biaya'].'</td>';
                            echo '<td>'.$t['date_created'].'</td>';
                            echo '</tr>';
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>