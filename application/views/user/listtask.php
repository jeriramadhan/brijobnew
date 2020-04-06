 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
     <div class="row">
         <div class="col-md-6 mb-3">
             <a href="<?= base_url('user/createtask'); ?>" class="btn btn-primary">Add New</a>
         </div>
         <table class="table table-hover">
             <thead>
                 <tr>
                     <th scope="col">#</th>
                     <th scope="col">Name Task</th>
                     <th scope="col">Detik Task</th>
                     <th scope="col">File</th>
                     <th scope="col">Priority</th>
                     <th scope="col">Duration</th>
                     <th scope="col">Assign to</th>
                     <th scope="col">Information</th>
                     <th scope="col">Action</th>
                 </tr>
             </thead>
             <!-- <tbody>

                 <?php foreach ($user as $t) : ?>
                     <tr>
                         <td width="150">
                             <?= $t->createTask->name; ?>
                         </td>
                         <td class="small">
                             <?= substr($t->detik, 0, 120) ?>...</td>
                         <td>
                             <img src="<?= base_url('./assets/img/file/' . $t->attach) ?>" width="64" />
                         </td>
                         <td width="150">
                             <?= $t->priority ?>
                         </td>
                         <td width="150">
                             <?= $t->duration ?>
                         </td>
                         <td width="150">
                             <?= $t->assign ?>
                         </td>
                         <td class="small">
                             <?= substr($t->info, 0, 120) ?>...</td>
                         <td width="250">
                             <a href="<?= base_url('user/edittask' . $t->id) ?>" class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
                             <a onclick="deleteConfirm('<?= base_url('user/deletetask/' . $t->id) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                         </td>
                     </tr>
                 <?php endforeach; ?>

             </tbody> -->
         </table>

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->