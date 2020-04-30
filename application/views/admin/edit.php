<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= form_open('admin/edit'); ?>

    <?php foreach ($editgh as $edt) : ?>
        <div class=" form-group">
            <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= $user['name']; ?>">
            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= $user['email']; ?>">
            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="password" name="password" placeholder="Password Address" value="<?= $user['password']; ?>">
            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <input type="hidden" name="id" value="<?= $edt->id; ?>" />
        <button type="submit" class="btn btn-primary btn-user ">
            Edit
        </button>
    <?php endforeach; ?>
    <?= form_close(); ?>

</div>
<!-- /.container-fluid -->