 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <?= form_open('user/updateTask'); ?>

     <?php foreach ($progress as $task) : ?>
         <div class="progress">
             <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">...%</div>
         </div>
         <br>
         <!-- <form class="update" method="post" action="< ?= base_url('task/update'); ?>"> -->

         <!-- <div class="form-group row">
             <label for="name" class="col-sm-2 col-form-label">Name</label>
             <div class="col-sm-10">
                 <input type="text" class="form-control" id="name" name="name" value="< ?= $user['name']; ?>" readonly>
                 < ?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
             </div>
         </div> -->
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
                     <option value="">Pending</option>
                     <option value="">Progress</option>
                     <option value="">Done</option>
                 </select>
                 <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
             </div>
         </div>

         <div class="form-group row">
             <label for="info" class="col-sm-2 col-form-label">Information</label>
             <div class="col-sm-10">
                 <textarea type="text" class="form-control" id="info" name="info"></textarea>
                 <?= form_error('info', '<small class="text-danger pl-3">', '</small>'); ?>
             </div>
         </div>


         <input type="hidden" name="id" value="<?= $task->id; ?>" />
         <button class="btn btn-primary" type="submit">Submit</button>
         <!-- </form> -->
     <?php endforeach; ?>
     <?= form_close(); ?>

 </div>
 <!-- /.container-fluid -->