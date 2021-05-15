<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">

                    <div class="form-group">
                        <label for="nama_pembeli">Nama Pembeli</label>
                        <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli">
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="unit[]">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fa fa-plus" id="btnAdd"></i>
                                </button>
                            </div>
                        </div>
                        <div class="inputAdd">
                        </div>
                    </div>
                    <button id="btnRemove">hapus</button>

                </form>
            </div>
        </div>
    </div>
</div>