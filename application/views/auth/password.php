<?= $this->session->flashdata('message');
 ?>
<form action="<?= base_url('auth/passwrod')?>" method="POST">
    <div class="card col-6">
        <div class="card-body">
            <div class="form-group">
                <label for="Password" class="form-label">New Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <input style="float:right" type="submit" class="btn btn-primary" value="Change">
        </div>
    </div>
</form>
