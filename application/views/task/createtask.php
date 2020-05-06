 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
     <div class="row">
         <div class="col-lg-8">
             <?= form_open_multipart('task/createtask'); ?>

             <div class="form-group row">
                 <label for="name" class="col-sm-2 col-form-label">Name Task</label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>">
                     <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                 </div>
             </div>
             <div class="form-group row">
                 <label for="detik" class="col-sm-2 col-form-label">Detik Task</label>
                 <div class="col-sm-10">
                     <textarea type="text" class="form-control" id="detik" name="detik"><?= set_value('detik'); ?></textarea>
                     <?= form_error('detik', '<small class="text-danger pl-3">', '</small>'); ?>
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
                 <div class="col-sm-2">Priority</div>
                 <div class="col-sm-10">
                     <select class="form-control" id="priority" name="priority">
                         <option value="--- Select Priority ---">--- Select Priority ---</option>
                         <option value="3">High</option>
                         <option value="2">Medium</option>
                         <option value="1">Low</option>
                     </select>
                     <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                 </div>
             </div>
             <div class="form-group row">
                 <label for="startdate" class="col-sm-2 col-form-label">Start Date</label>
                 <div class="col-sm-10">
                     <input class="form-control-date <?= form_error('startdate') ? 'is-invalid' : '' ?>" type="date" href="#" id="startdate" name="startdate">

                 </div>
                 <?= form_error('duration', '<small class="text-danger pl-3">', '</small>'); ?>
             </div>
             <div class="form-group row">
                 <label for="duration" class="col-sm-2 col-form-label">End Date</label>
                 <div class="col-sm-10">
                     <input class="form-control-date <?= form_error('duration') ? 'is-invalid' : '' ?>" type="date" href="#" id="duration" name="duration">

                 </div>
                 <?= form_error('duration', '<small class="text-danger pl-3">', '</small>'); ?>
             </div>
             <div class="form-group row">
                 <div class="col-sm-2">Assign</div>
                 <div class="col-sm-10">
                     <select class="form-control" id="assign" name="assign">
                         <?php foreach ($getUser as $row) {
                                echo '<option value="' . $row->name . '">' . $row->name . '</option>'; //nampilin kodenya disini
                            }
                            ?>
                     </select>
                     <!-- <input type="text" class="form-control" id="assign" name="assign"> -->
                     <?= form_error('assign', '<small class="text-danger pl-3">', '</small>'); ?>
                 </div>
             </div>
             <!-- <div class="form-group row">
                 <label for="info" class="col-sm-2 col-form-label">Information</label>
                 <div class="col-sm-10">
                     <textarea type="text" class="form-control" id="info" name="info"><?= set_value('info'); ?></textarea>
                     < ?= form_error('info', '<small class="text-danger pl-3">', '</small>'); ?>
                 </div>
             </div> -->
             <!-- <div class="form-group row">
                 <label for="progress" class="col-sm-2 col-form-label">Progress</label>
                 <div class="col-sm-10">
                     <input type="text" class="form-control" id="progree" name="progress"></input>
                     < ?= form_error('info', '<small class="text-danger pl-3">', '</small>'); ?>
                 </div>
             </div> -->
             <div class="form-group row float-right">
                 <div class="col-sm-10">
                     <button type="submit" class="btn btn-primary">Save</button>
                 </div>
             </div>

         </div>

     </div>
     <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->