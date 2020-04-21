 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
     <?= $this->session->flashdata('message'); ?>
     <div class="row">
         <table class="table table-hover">
             <thead>
                 <tr>
                     <th scope="col">#</th>
                     <th scope="col">Name Task</th>
                     <th scope="col">File</th>
                     <th scope="col">Priority</th>
                     <th scope="col">Duration</th>
                     <th scope="col">Assign</th>
                     <th scope="col">Information</th>
                     <th scope="col">Progress</th>
                     <th scope="col">Action</th>
                 </tr>
             </thead>
             <tbody>
                 <?php $i = 1; ?>
                 <?php foreach ($kerjaan as $t) : ?>

                     <tr>
                         <td width="50">
                             <?= $i; ?>
                         </td>
                         <td width="150">
                             <?= $t->name; ?>
                         </td>

                         <td>
                             <a href="<?= base_url('./assets/img/file/' . $t->attach) ?>" width="64">Show</a>
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
                             <a href="<?= base_url('user/editTask/' . $t->id) ?>" class="btn btn-small"><i class="fas fa-edit"></i> Update</a>

                         </td>
                     </tr>
                     <?php $i++; ?>
                 <?php endforeach; ?>

         </table>

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->