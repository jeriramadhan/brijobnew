 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <?= form_open('task/updateaccept'); ?>

     <?php foreach ($approve as $task) : ?>


         <div class="form-group row">
             <div class="col-sm-10">
                 <select class="form-control" id="approve" name="approve">
                     <option value="--- Select approve ---">--- Select approve ---</option>
                     <option value="Approved">Approved</option>
                     <option value="Rejected">Rejected</option>
                 </select>
                 <?= form_error('approve', '<small class="text-danger pl-3">', '</small>'); ?>
             </div>
         </div>


         <input type="hidden" name="id" value="<?= $task->id; ?>" />
         <button class="btn btn-primary" type="submit">Submit</button>
         <!-- </form> -->
     <?php endforeach; ?>
     <?= form_close(); ?>

 </div>
 <!-- /.container-fluid -->