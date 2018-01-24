
<div class="col-lg-12">
    <form action="" method="post">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="userLogin">User login</label>
                <input type="text" class="form-control" name="login" title="login" value="<?= (isset($data['login']) ? $data['login'] : '') ?>" placeholder="login" id="userLogin">
            </div>
            <div class="form-group col-md-4">
                <label for="userEmail">User email</label>
                <input type="email" class="form-control" name="email" title="email" value="<?= (isset($data['email']) ? $data['email'] : '') ?>" placeholder="email" id="userEmail">
            </div>
            <div class="form-group col-md-4">
                <label for="userRole">User role</label>
                <input type="text" class="form-control" name="role" title="role"
                       value="<?= (isset($data['role']) ? $data['role'] : '') ?>"
                       placeholder="role" id="userRole">
                <input type="hidden" class="form-control" name="password"
                       value="<?= (isset($data['password']) ? $data['password'] : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <input type="checkbox" value="1" id="active"
                   name="active" <?= ($data['active'] ? '' : 'checked') ?>>
        </div>
        <button type="submit" class="btn btn-primary">сохранить</button>
        <button type="reset" class="btn btn-secondary">сбросить</button>
    </form>
</div>