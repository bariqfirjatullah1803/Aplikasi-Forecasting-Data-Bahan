<div class="card">
    <div class="card-body">
        <form action="<?= base_url('admin/change/').$user['id_user']?>" method="post">
            <div class="form-group">
                <label class="form-label" for="password">Password Baru</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>