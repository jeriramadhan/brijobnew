<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">< ?= $title; ?></h1> -->

    <table id="list" class="table table-hover">
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

                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
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
        </tfoot>
    </table>
</div>
</div>
<!-- End of Main Content -->