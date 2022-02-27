<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container mb-5">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rating</h1>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <form action="<?= base_url('rating/simpan'); ?>" method="POST">
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr>
                                <th width="25%" scope="col" class="text-center align-middle" rowspan="2">Alternatif</th>
                                <th width="75%" scope="col" class="text-center" colspan="<?= $count_kriteria; ?>">Kriteria</th>
                            </tr>
                            <tr>
                                <?php foreach ($kriteria_list as $kriteria) : ?>
                                    <th width="<?= round(75 / $count_kriteria, 0); ?>%" scope="col" class="text-center" colspan="1"><?= $kriteria['kode']; ?> (<?= $kriteria['nama']; ?>)</th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <input name="project_id" value="<?= $project_id; ?>" hidden>

                            <?php foreach ($alternatif_list as $alternatif) : ?>
                                <tr>
                                    <td scope="row" class="text-left">
                                        <?= $alternatif['kode']; ?> (<?= $alternatif['nama']; ?>)
                                    </td>
                                    <?php foreach ($kriteria_list as $kriteria) : ?>
                                        <?php $id = "rating-{$alternatif['id']}-{$kriteria['id']}"; ?>
                                        <?php $id .= isset($alternatif_kriteria_id_list[$alternatif['id']]) ? (isset($alternatif_kriteria_id_list[$alternatif['id']][$kriteria['id']]) ? '-' . $alternatif_kriteria_id_list[$alternatif['id']][$kriteria['id']] : '') : ''; ?>
                                        <td>
                                            <input type="number" class="form-control" id="<?= $id; ?>" name="<?= $id; ?>" value="<?= $rating_list[$alternatif['id']][$kriteria['id']] ?? ''; ?>">
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <?php if ($count_rating) : ?>
                        <a type="button" class="btn btn-success" href="<?= base_url("vektor/$project_id"); ?>">Hitung Vektor</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>