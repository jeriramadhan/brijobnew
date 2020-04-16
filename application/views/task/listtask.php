 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
     <?= $this->session->flashdata('message'); ?>
     <div class="row">
         <div class="col-md-6 mb-3">
             <a href="<?= base_url('task/createtask'); ?>" class="btn btn-primary">Add New</a>
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
                     <th scope="col">Progress</th>
                     <th scope="col">Action</th>
                 </tr>
             </thead>
             <tbody>
                 <?php $i = 1; ?>
                 <?php foreach ($task as $t) : ?>

                     <tr>
                         <td width="50">
                             <?= $i; ?>
                         </td>
                         <td width="150">
                             <?= $t->name; ?>
                         </td>
                         <td class="150">
                             <?= substr($t->detik, 0, 120) ?></td>
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
                         <td class="150">
                             <?= substr($t->info, 0, 120) ?>
                         </td>
                         <td width="150">
                             <?= $t->progress; ?>
                         </td>
                         <td width="250">
                             <a href="<?= base_url('task/edittask/' . $t->id) ?>" class="btn btn-small"><i class="fas fa-edit"></i> Update</a>
                             <a onclick="deleteConfirm('<?= base_url('task/delete/' . $t->id) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                             <!-- <a href="< ?= base_url("task/update"); ?>" class="btn btn-small text-warning"><i class="fas fa-fw fa-edit"></i> Update</a>
                             <a onclick="deleteConfirm('< ?= base_url('task/deletetask/' . $t->id) ?>')" href="#!" class="btn btn-small text-success"><i class="fas fa-fw fa-check-circle"></i> Done</a> -->
                         </td>
                     </tr>
                     <?php $i++; ?>
                 <?php endforeach; ?>

             </tbody>
         </table>

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->