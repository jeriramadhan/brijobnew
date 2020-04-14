 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <div class="progress">
         <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
     </div>
     <br>
     <form class="updateTask" method="post" action="<?= base_url('user/updateTask'); ?>">
         <div class="form-group row">
             <label for="progress" class="col-sm-2 col-form-label">Precentase</label>
             <div class="col-sm-10">
                 <input type="text" class="form-control" id="progress" name="progress" value="<?= set_value('progress'); ?>">
                 <?= form_error('progress', '<small class="text-danger pl-3">', '</small>'); ?>
             </div>
         </div>

         <div class="form-group row">
             <div class="col-sm-2">Status</div>
             <div class="col-sm-10">
                 <select class="form-control" id="status" name="status">
                     <option value="">--- Select Status ---</option>
                     <option value="pending">Pending</option>
                     <option value="progress">Progress</option>
                     <option value="done">Done</option>
                 </select>
                 <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
             </div>
         </div>

         <button class="btn btn-primary" type="submit">Submit</button>
     </form>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->