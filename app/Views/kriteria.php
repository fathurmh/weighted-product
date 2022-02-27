<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kriteria</h1>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-4 mt-2 mb-3">
            <form action="<?= base_url('kriteria/tambah'); ?>" method="POST">
                <input name="project_id" value="<?= $project_id; ?>" hidden>
                <div class="mb-3">
                    <label for="nama-kriteria" class="form-label">Nama Kriteria</label>
                    <input type="text" class="form-control" id="nama-kriteria" name="nama">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <a type="button" class="btn btn-warning mt-3 mb-1" href="<?= base_url("alternatif/$project_id"); ?>">Alternatif ></a>
        </div>

        <div class="col-md-12 col-lg-8">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <th width="5%" scope="col">No</th>
                        <th width="5%" scope="col">Kode</th>
                        <th width="80%" scope="col">Nama</th>
                        <th width="10%" scope="col">Aksi</th>
                    </thead>
                    <tbody>
                        <?php if (count($kriteria) == 0) : ?>
                            <tr>
                                <td colspan="4" scope="row">Tidak ada data.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($kriteria as $value) : ?>
                                <tr>
                                    <td scope="row"><?= $no++; ?>.</td>
                                    <td><?= $value['kode']; ?></td>
                                    <td><?= $value['nama']; ?></td>
                                    <td>
                                        <form action="<?= base_url('kriteria/hapus'); ?>" method="POST">
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