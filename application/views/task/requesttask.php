<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <table id="list" class="table table-striped table-bordered" style="width:100%">
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
                <?php foreach ($kerjaan as $t) : ?>

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
                            <a href="<?= base_url('task/accept/'  . $t->id); ?>" class="btn btn-small text-success"><i class="fas fa-check"></i> Accept</a>
                            <a onclick="deleteConfirm('<?= base_url('task/delete/' . $t->id) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-times"></i> Decline</a>
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
            <tfoot>
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
            </tfoot>
        </table>

    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Request Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('task/accept/'  . $t->id); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <!-- <label for="exampleFormControlSelect1">Example select</label> -->
                        <select class="form-control" id="approve" name="approve">
                            <option>Approved</option>
                            <option>Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>