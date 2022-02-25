<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <div class="row">
        <div class="col-4 mt-2">
            <form action="<?= base_url('tambah'); ?>" method="POST">
                <div class="mb-3">
                    <label for="nama-project" class="form-label">Nama Project</label>
                    <input type="text" class="form-control" id="nama-project" name="nama">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="col-8">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <th width="5%" scope="col">No</th>
                        <th width="70%" scope="col">Nama Project</th>
                        <th width="25%" scope="col">Aksi</th>
                    </thead>
                    <tbody>
                        <?php if (count($project) == 0) : ?>
                            <tr>
                                <td colspan="3" scope="row">Tidak ada data.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($project as $value) : ?>
                                <tr>
                                    <td scope="row"><?= $no++; ?>.</td>
                                    <td><?= $value['nama']; ?></td>
                                    <td>
                                        <form action="<?= base_url('hapus'); ?>" method="POST">
                                            <a type="button" class="btn btn-sm btn-success" href="<?= route_to('alternatif'); ?>">Alternatif</a>

                                            <input name="id" value="<?= $value['id']; ?>" hidden>
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>