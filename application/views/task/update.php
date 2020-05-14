 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <?= form_open('task/updateTask'); ?>

     <?php foreach ($progress as $task) : ?>
         <div class="progress">
             <div class="progress-bar" role="progressbar" style="width: <?= $task->progress; ?>%;" aria-valuenow="<?= $task->progress; ?>" aria-valuemin="0" aria-valuemax="100"><?= $task->progress; ?>%</div>
         </div>
         <br>

         <div class="form-group row">
             <label for="progress" class="col-sm-2 col-form-label">Precentase (%)</label>
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
             <div class="col-sm-2">Attach File</div>
             <div class="col-sm-10">
                 <div class="row">
                     <div class="col-sm">
                         <div class="custom-file">
                             <input type="file" class="custom-file-input" id="attach" name="attach">
                             <label class="custom-file-label" for="attach">Choose File</label>
                         </div>
                     </div>
                 </div>
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