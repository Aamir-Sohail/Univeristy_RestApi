
<div class="container mt-5">
    <form class="d-flex flex-column" method="POST" action="<?= base_url('/login') ?>">
        <!-- Login Errors Message -->
        <?php if (session()->getFlashdata('error') != null) : ?>
        <div class="alert alert-danger">
            <p><?= session()->getFlashdata('error'); ?></p>
        </div>
        <?php endif; ?>

        <?= csrf_field(); ?>
        <div class="form-group mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="<?= old('email'); ?>" id="email"
                    placeholder="Email">
            </div>
        </div>
        <div class="form-group mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" value="<?= old('password'); ?>"
                    id="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </div>
    </form>
</div>