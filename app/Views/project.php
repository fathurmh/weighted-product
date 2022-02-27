<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Project</h1>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-4 mt-2 mb-3">
            <form action="<?= base_url('tambah'); ?>" method="POST">
                <div class="mb-3">
                    <label for="nama-project" class="form-label">Nama Project</label>
                    <input type="text" class="form-control" id="nama-project" name="nama">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>

        <div class="col-md-12 col-lg-8">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <th width="5%" scope="col" class="text-center">No</th>
                        <th width="65%" scope="col" class="text-center">Nama Project</th>
                        <th width="30%" scope="col" class="text-center">Aksi</th>
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
                                    <td scope="row" class="text-center"><?= $no++; ?>.</td>
                                    <td><?= $value['nama']; ?></td>
                                    <td class="text-center">
                                        <form action="<?= base_url('hapus'); ?>" method="POST">
                                            <a type="button" class="btn btn-sm btn-primary mb-1" href="<?= base_url("alternatif/{$value['id']}"); ?>">Alternatif</a>
                                            <a type="button" class="btn btn-sm btn-success mb-1" href="<?= base_url("kriteria/{$value['id']}"); ?>">Kriteria</a>

                                            <input name="id" value="<?= $value['id']; ?>" hidden>
                                            <button type="submit" class="btn btn-sm btn-danger mb-1">Hapus</button>
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