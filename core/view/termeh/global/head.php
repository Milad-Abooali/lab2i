<!DOCTYPE html>
<html lang="fa">
<head>
    <!--- Main Meta -->
    <link rel="author" href="<?= APP_URL ?>humans.txt" />
    <meta name="generator" content="Mahan" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--- APP -->
    <meta name="app-url" content="<?= APP_URL ?>" />
    <meta name="app-cdn" content="<?= CDN ?>" />
    <meta name="app-img" content="<?= IMG ?>" />
    <meta name="app-js" content="<?= JS ?>" />
    <!--- Prefetch
    <link rel='dns-prefetch' href="<?= CDN ?>" />
  -->
    <!--- SEO -->
    <title><?= $this->data['PAGE']['title']; ?> &bull; Bid 2 Enjoy</title>
    <meta name="robots" content="noindex, nofollow" />
    <!--- ICO -->
    <meta name="application-name" content="Bid 2 Enjoy" />
    <link rel="icon" type="image/ico" sizes="32x32" href="<?= ICO ?>favicon.ico" />
    <!--- CSS -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= CSS ?>bootstrap.4.2.1.min.css" rel="stylesheet" />
    <link href="<?= CSS ?>notific.css" rel="stylesheet" />
    <link href="<?= CSS ?>bootstrap-select.css" rel="stylesheet" />
    <link href="<?= CSS ?>style.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <link href="<?= CSS ?>steps.css" rel="stylesheet" />

    <!--- Script -->
    <script src="<?= JS ?>jquery-3.5.1.min.js"></script>
    <script defer src="<?= JS ?>popper.min.js"></script>
    <script defer src="<?= JS ?>bootstrap.4.2.1.min.js"></script>
    <script defer src="<?= JS ?>pace.min.js"></script>
    <script defer src="<?= JS ?>notific.js"></script>
    <script defer src="<?= JS ?>bootstrap-select.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script defer src="<?= JS ?>dataTables.bootstrap4.min.js"></script>

    <!--- Head -->
    <?= $this->HEADER; ?>
    <?= $this->data['PAGE']['head'] ?>

</head>
<!--- Page Body -->
<body><div id="app-body" data-g="user" data-token="<uponE>$_SESSION['M']['TOKEN']</uponE>">
