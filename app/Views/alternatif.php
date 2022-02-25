<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <div class="row">
        <div class="col-4 mt-2">
            <form action="<?= base_url('alternatif/tambah'); ?>" method="POST">
                <input name="project_id" value="<?= $project_id; ?>" hidden>
                <div class="mb-3">
                    <label for="nama-alternatif" class="form-label">Nama Alternatif</label>
                    <input type="text" class="form-control" id="nama-alternatif" name="nama">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="col-8">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <th width="5%" scope="col">No</th>
                        <th width="5%" scope="col">Kode</th>
                        <th width="70%" scope="col">Nama</th>
                        <th width="20%" scope="col">Aksi</th>
                    </thead>
                    <tbody>
                        <?php if (count($alternatif) == 0) : ?>
                            <tr>
                                <td colspan="4" scope="row">Tidak ada data.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($alternatif as $value) : ?>
                                <tr>
                                    <td scope="row"><?= $no++; ?>.</td>
                                    <td><?= $value['kode']; ?></td>
                                    <td><?= $value['nama']; ?></td>
                                    <td>
                                        <form action="<?= base_url('alternatif/hapus'); ?>" method="POST">
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