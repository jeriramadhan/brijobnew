<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-md-6 mb-3 dropdown">
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
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Approval</th>
                    <th scope="col">Status</th>
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
                            <?php if ($t->priority == "3") { ?>
                                <button type="button" class="btn btn-danger">High</button>
                            <?php } else if ($t->priority == "2") { ?>
                                <button type="button" class="btn btn-warning">Medium</button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-info">Low</button>
                            <?php } ?>
                        </td>
                        <td width="150">
                            <?= $t->startdate; ?>
                        </td>
                        <td width="150">
                            <?= $t->duration ?>
                            <?php if ($t->duration == date('Y-m-d', strtotime(' + 3 days'))) {

                            ?>
                                <a class="nav-link" data-toggle="modal" data-target="#modal-delete">
                                    <i class="far fa-bell"><span class="badge badge-warning navbar-badge">3 days</span></i>

                                </a>
                                <div class="modal fade" id="modal-delete">
                                    <div class="modal-dialog">
                                        <div class="alert alert-danger" role="alert">Duration task is still 3 days left!</div>
                                    </div>
                                </div>
                            <?php
                            }
                            if ($t->duration == date('Y-m-d', strtotime(' + 2 days'))) {
                            ?>
                                <a class="nav-link" data-toggle="modal" data-target="#modal-delete">
                                    <i class="far fa-bell"><span class="badge badge-warning navbar-badge">2 days</span></i>

                                </a>
                                <div class="modal fade" id="modal-delete">
                                    <div class="modal-dialog">
                                        <div class="alert alert-danger" role="alert">Duration task is still 2 days left!</div>
                                    </div>
                                </div>

                            <?php
                            }
                            if ($t->duration == date('Y-m-d', strtotime(' + 1 days'))) {
                            ?>
                                <a class="nav-link" data-toggle="modal" data-target="#modal-delete">
                                    <i class="far fa-bell"><span class="badge badge-warning navbar-badge">1 days</span></i>

                                </a>
                                <div class="modal fade" id="modal-delete">
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
                        <td width="150">
                            <?= $t->assign ?>
                        </td>

                        <td width="150">
                            <?php if ($t->approve == 'Approved') { ?>
                                <button type="button" class="btn btn-success">Approved</button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-warning"></button>
                            <?php } ?>
                        </td>
                        <td width="250">
                            <a href="<?= base_url('task/accept/'  . $t->id); ?>" class="btn btn-small text-success"><i class="fas fa-check"></i> Accept</a>
                            <a onclick="deleteConfirm('<?= base_url('task/delete/' . $t->id) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-times"></i> Decline</a>
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