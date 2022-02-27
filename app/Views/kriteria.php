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
                <input name="id" value="<?= $kriteria['id']; ?>" hidden>
                <div class="mb-3">
                    <label for="nama-kriteria" class="form-label">Nama Kriteria</label>
                    <input type="text" class="form-control" id="nama-kriteria" name="nama" value="<?= $kriteria['nama']; ?>">
                </div>
                <div class="mb-3">
                    <label for="jenis-kriteria" class="form-label">Jenis Kriteria</label>
                    <select class="form-select" name="jenis">
                        <option value="0" <?= $kriteria['jenis'] == 0 ? 'selected' : ''; ?>>Benefit</option>
                        <option value="1" <?= $kriteria['jenis'] == 1 ? 'selected' : ''; ?>>Cost</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bobot-kriteria" class="form-label">Bobot Kriteria</label>
                    <input type="number" class="form-control" id="bobot-kriteria" name="bobot" value="<?= $kriteria['bobot']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            <a type="button" class="btn btn-warning mt-3 mb-1" href="<?= base_url("alternatif/$project_id"); ?>">Alternatif ></a>
        </div>

        <div class="col-md-12 col-lg-8">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <th width="5%" scope="col" class="text-center">No</th>
                        <th width="5%" scope="col" class="text-center">Kode</th>
                        <th width="45%" scope="col" class="text-center">Nama</th>
                        <th width="10%" scope="col" class="text-center">Jenis</th>
                        <th width="5%" scope="col" class="text-center">Bobot</th>
                        <th width="10%" scope="col" class="text-center">Normalisasi</th>
                        <th width="15%" scope="col" class="text-center">Aksi</th>
                    </thead>
                    <tbody>
                        <?php if (count($kriteria_list) == 0) : ?>
                            <tr>
                                <td colspan="6" scope="row">Tidak ada data.</td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($kriteria_list as $value) : ?>
                                <tr>
                                    <td scope="row" class="text-center"><?= $no++; ?>.</td>
                                    <td class="text-center"><?= $value['kode']; ?></td>
                                    <td><?= $value['nama']; ?></td>
                                    <td class="text-center"><?= $value['jenis_dd']; ?></td>
                                    <td class="text-center"><?= $value['bobot']; ?></td>
                                    <td class="text-center"><?= $value['normalisasi']; ?></td>
                                    <td class="text-center">
                                        <form action="<?= base_url('kriteria/hapus'); ?>" method="POST">
                                            <a type="button" class="btn btn-sm btn-warning mb-1" href="<?= base_url("kriteria/$project_id/{$value['id']}"); ?>">Edit</a>
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
                <a type="button" class="btn btn-success mb-3" href="<?= base_url("kriteria/normalisasi/$project_id"); ?>">Normalisasi</a>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>