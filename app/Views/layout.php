<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Maulana Bahrun | 16.14.1.0089</title>
    <meta name="description" content="SISTEM PENDUKUNG KEPUTUSAN UNTUK MENENTUKAN LAYANAN PUBLIK BERBASIS ELEKTRONIK TERBAIK MENGGUNAKAN ALGORITMA WEIGHTED PRODUCT">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link rel="stylesheet" href="<?= base_url("css/bootstrap.css"); ?>">
</head>

<body>
    <nav class="py-3 bg-light border-bottom">
        <div class="container d-flex flex-wrap">
            <h3 class="text-center">SISTEM PENDUKUNG KEPUTUSAN UNTUK MENENTUKAN LAYANAN PUBLIK BERBASIS ELEKTRONIK TERBAIK MENGGUNAKAN ALGORITMA WEIGHTED PRODUCT</h3>
        </div>
    </nav>
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex flex-wrap justify-content-center">
            <h5 class="text-center">Maulana Bahrun | 16.14.1.0089</h5>
        </div>
    </header>

    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <div class="container">

                    <?php if (session()->has('breadcrumb')) : ?>
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <?php foreach (session('breadcrumb') as $key => $breadcrumb) : ?>
                                    <?php if (count(session('breadcrumb')) - 1 == $key) : ?>
                                        <li class="breadcrumb-item active" aria-current="page"><?= $breadcrumb['label'] ?></li>
                                    <?php else : ?>
                                        <li class="breadcrumb-item"><a href="<?= $breadcrumb['link'] ?>"><?= $breadcrumb['label'] ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ol>
                        </nav>
                    <?php endif; ?>

                    <?php if (session()->has('message')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session('message') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->has('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->has('errors')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                <?php foreach (session('errors') as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                </div>

                <?= $this->renderSection('content'); ?>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="<?= base_url("js/bootstrap.js"); ?>"></script>
    <script>
    </script>
</body>

</html>