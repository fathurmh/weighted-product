<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Alternatif</h1>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-4 mt-2 mb-3">
            <form action="<?= base_url('alternatif/tambah'); ?>" method="POST">
                <input name="project_id" value="<?= $project_id; ?>" hidden>
                <input name="id" value="<?= $alternatif['id']; ?>" hidden>
                <div class="mb-3">
                    <label for="nama-alternatif" class="form-label">Nama Alternatif</label>
                    <input type="text" class="form-control" id="nama-alternatif" name="nama" value="<?= $alternatif['nama']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            <a type="button" class="btn btn-warning mt-3 mb-1" href="<?= base_url("kriteria/$project_id"); ?>">Kriteria ></a>
        </div>

        <div class="col-md-12 col-lg-8">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <th width="5%" scope="col" class="text-center">No</th>
                        <th width="5%" scope="col" class="text-center">Kode</th>
                        <th width="75%" scope="col" class="text-center">Nama</th>
                        <th width="15%" scope="col" class="text-center">Aksi</th>
                    </thead>
                    <tbody>
                        <?php if (count($alternatif_list) == 0) : ?>
                            <tr>
                                <td colspan="4" scope="row">Tidak ada data.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($alternatif_list as $value) : ?>
                                <tr>
                                    <td scope="row" class="text-center"><?= $no++; ?>.</td>
                                    <td class="text-center"><?= $value['kode']; ?></td>
                                    <td><?= $value['nama']; ?></td>
                                    <td class="text-center">
                                        <form action="<?= base_url('alternatif/hapus'); ?>" method="POST">
                                            <a type="button" class="btn btn-sm btn-warning mb-1" href="<?= base_url("alternatif/$project_id/{$value['id']}"); ?>">Edit</a>
                                            <input name="project_id" value="<?= $value['project_id']; ?>" hidden>
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