 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
     <?= $this->session->flashdata('message'); ?>
     <div class="row">
         <div class="col-md-6 mb-3">
             <a href="<?= base_url('task/createtask'); ?>" class="btn btn-primary">Add New</a>
             <a href="<?= base_url('task/print'); ?>" class="btn btn-success"><i class=" fas fa-fw fa-print"></i>Print</a>
             <a href="<?= base_url('task/excel'); ?>" class="btn btn-warning"><i class=" fas fa-fw fa-download"></i>Excel</a>
         </div>

         <table id="datatables" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
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
                             <a href="<?= base_url('./assets/img/file/' . $t->attach) ?>" width="64">show</a>
                         </td>
                         <td width="150">
                             <?php if ($t->priority == "High") { ?>
                                 <button type="button" class="btn btn-danger">High</button>
                             <?php } else if ($t->priority == "Medium") { ?>
                                 <button type="button" class="btn btn-warning">Medium</button>
                             <?php } else { ?>
                                 <button type="button" class="btn btn-info">Low</button>
                             <?php } ?>

                         </td>
                         <td width="150">
                             <?= $t->duration ?>
                             <?php if ($t->duration == date('Y-m-d', strtotime(' + 3 days'))) {

                                ?>
                                 <a class="nav-link" data-toggle="modal" data-target="#modal-delete3">
                                     <i class="far fa-bell"><span class="badge badge-warning navbar-badge">3 days</span></i>

                                 </a>
                                 <div class="modal fade" id="modal-delete3">
                                     <div class="modal-dialog">
                                         <div class="alert alert-danger" role="alert">Duration task is still 3 days left!</div>
                                     </div>
                                 </div>
                             <?php
                                }
                                if ($t->duration == date('Y-m-d', strtotime(' + 2 days'))) {
                                ?>
                                 <a class="nav-link" data-toggle="modal" data-target="#modal-delete2">
                                     <i class="far fa-bell"><span class="badge badge-warning navbar-badge">2 days</span></i>

                                 </a>
                                 <div class="modal fade" id="modal-delete2">
                                     <div class="modal-dialog">
                                         <div class="alert alert-danger" role="alert">Duration task is still 2 days left!</div>
                                     </div>
                                 </div>

                             <?php
                                }
                                if ($t->duration == date('Y-m-d', strtotime(' + 1 days'))) {
                                ?>
                                 <a class="nav-link" data-toggle="modal" data-target="#modal-delete1">
                                     <i class="far fa-bell"><span class="badge badge-warning navbar-badge">1 days</span></i>

                                 </a>
                                 <div class="modal fade" id="modal-delete1">
                                     <div class="modal-dialog">
                                         <div class="alert alert-danger" role="alert">Duration task is still 1 days left!</div>
                                     </div>
                                 </div>
                             <?php
                                }
                                if ($t->duration == date('Y-m-d')) {
                                ?>
                                 <a class="nav-link" data-toggle="modal" data-target="#modal-delete">
                                     <i class="far fa-bell"><span class="badge badge-warning navbar-badge">this days</span></i>

                                 </a>
                                 <div class="modal fade" id="modal-delete">
                                     <div class="modal-dialog">
                                         <div class="alert alert-danger" role="alert">Duration task is due date!</div>
                                     </div>
                                 </div>
                             <?php
                                }
                                ?>
                         </td>
                         <td width="150">
                             <?= $t->assign ?>
                         </td>
                         <td class="150">
                             <?= substr($t->info, 0, 120) ?>
                         </td>
                         <td width="150">
                             <?php
                                $getprog = $t->progress;
                                if ($getprog == 0) {
                                    echo "No Progress";
                                } else {
                                    echo "$getprog%";
                                }
                                ?>

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
                 <script>
                     function deleteConfirm(url) {
                         $('#btn-delete').attr('href', url);
                         $('#deleteModal').modal();
                     }
                 </script>

             </tbody>
             <!-- <tfoot>
                 <th>#</th>
                 <th>Name Task</th>
                 <th>Detik Task</th>
                 <th>File</th>
                 <th>Priority</th>
                 <th>Duration</th>
                 <th>Assign to</th>
                 <th>Information</th>
                 <th>Progress</th>
                 <th>Action</th>
             </tfoot> -->
         </table>

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->