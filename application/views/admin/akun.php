 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <div class="row">
         <div class="col-lg-8">
             <div class="text-center">
                 <h1 class="h4 text-gray-900 mb-4">Group Head</h1>
             </div>
             <form class="user" method="post" action="<?= base_url('admin/addGh'); ?>">
                 <div class=" form-group">
                     <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>">
                     <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                 </div>
                 <div class="form-group">
                     <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                     <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                 </div>
                 <button type="submit" class="btn btn-primary btn-user btn-block">
                     Register Account
                 </button>
             </form>

             <table class="table table-hover">
                 <thead>
                     <tr>
                         <th scope="col">#</th>
                         <th scope="col">Name</th>
                         <th scope="col">Email</th>
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $i = 1; ?>
                     <?php foreach ($user as $gh) : ?>

                         <tr>
                             <td width="50">
                                 <?= $i; ?>
                             </td>
                             <td width="150">
                                 <?= $gh->name; ?>
                             </td>
                             <td width="150">
                                 <?= $gh->email; ?>
                             </td>
                             <td width="250">
                                 <a href="<?= base_url('admin/edit/' . $gh->id) ?>" class="btn btn-small"><i class="fas fa-edit"></i>Edit</a>
                                 <a onclick="deleteConfirm('<?= base_url('admin/delete/' . $gh->id) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                                 <!-- <a href="< ?= base_url("task/update"); ?>" class="btn btn-small text-warning"><i class="fas fa-fw fa-edit"></i> Update</a>
                             <a onclick="deleteConfirm('< ?= base_url('task/deletetask/' . $t->id) ?>')" href="#!" class="btn btn-small text-success"><i class="fas fa-fw fa-check-circle"></i> Done</a> -->
                             </td>
                         </tr>
                         <?php $i++; ?>
                     <?php endforeach; ?>

                 </tbody>
             </table>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->