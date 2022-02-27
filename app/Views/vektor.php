<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container mb-5">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Vektor</h1>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6 mt-2 mb-3">
            <div class="table-responsive">
                <a type="button" class="btn btn-primary mb-2" href="<?= base_url("vektor/s/$project_id"); ?>">Hitung Vektor S</a>
                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <th width="5%" scope="col" class="text-center">No</th>
                        <th width="75%" scope="col" class="text-center">Alternatif</th>
                        <th width="20%" scope="col" class="text-center">Vektor S</th>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($alternatif_list_s as $value) : ?>
                            <tr>
                                <td scope="row" class="text-center"><?= $no++; ?>.</td>
                                <td class="text-left"><?= $value['kode']; ?> (<?= $value['nama']; ?>)</td>
                                <td class="text-center"><?= $value['vektor_s']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12 col-lg-6 mt-2 mb-3">
            <div class="table-responsive">
                <?php if ($sum_vektor_s > 0) : ?>
                    <a type="button" class="btn btn-primary mb-3" href="<?= base_url("vektor/v/$project_id"); ?>">Hitung Vektor V</a>
                <?php else : ?>
                    <div class="mt-5"></div>
                <?php endif; ?>

                <table class="table table-bordered table-striped align-middle">
                    <thead>
                        <th width="5%" scope="col" class="text-center">No</th>
                        <th width="65%" scope="col" class="text-center">Alternatif</th>
                        <th width="20%" scope="col" class="text-center">Vektor V</th>
                        <th width="10%" scope="col" class="text-center">Ranking</th>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($alternatif_list_v as $value) : ?>
                            <tr>
                                <td scope="row" class="text-center"><?= $no++; ?>.</td>
                                <td class="text-left"><?= $value['kode']; ?> (<?= $value['nama']; ?>)</td>
                                <td class="text-center"><?= $value['vektor_v']; ?></td>
                                <td class="text-center"><?= $value['rank']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>