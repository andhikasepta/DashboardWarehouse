<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <link rel="icon" href="img/LogoLintas.png">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/excel-upload.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column min-vh-100">
            <div id="content" class="flex-grow-1">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <img src="img/Lintasarta.png" alt="" width="150px">
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="periodDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="selected-period-text"
                                    style="font-weight: bold;">PILIH DATA</span> <i
                                    class="fas fa-chevron-down fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in p-3"
                                aria-labelledby="periodDropdown" id="period-dropdown-menu"
                                style="min-width: 280px;">
                                <h6 class="dropdown-header px-0 pt-0 text-primary font-weight-bold">PILIH DATA</h6>
                                <div class="form-group mb-2">
                                    <label for="period-month-select" class="small font-weight-bold text-gray-600">Bulan</label>
                                    <select class="form-control form-control-sm" id="period-month-select">
                                        <option value="">-- Pilih Bulan --</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="period-year-select" class="small font-weight-bold text-gray-600">Tahun</label>
                                    <select class="form-control form-control-sm" id="period-year-select">
                                        <option value="">-- Pilih Tahun --</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary btn-sm btn-block" id="btn-load-period" disabled>
                                    <i class="fas fa-check mr-1"></i>Tampilkan Data
                                </button>
                            </div>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><i class="fa fa-user mr-2 text-gray-400"></i>ANDHIKA SEPTA</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="master_data.php">
                                    <i class="fas fa-database fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Master Data
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                TOTAL ASSET</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="card-total-asset">0
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-box fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                TOTAL NBV</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="card-total-nbv">Rp 0
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                UTILISASI SPACE
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                                                        id="card-utilisasi-space-text">0%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            id="card-utilisasi-space-bar" style="width: 0%"
                                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-warehouse fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                FREE SPACE
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"
                                                        id="card-free-space-text">0%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            id="card-free-space-bar" style="width: 0%" aria-valuenow="0"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                LAST UPDATE</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="card-last-update">-
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="row">
                                <div class="col-xl- col-lg-6">
                                    <div class="card shadow mb-4">
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">PERGERAKAN PERANGKAT<br>
                                                <span style="font-size: small;">Berdasarkan Kategori</span>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-bar">
                                                <canvas id="myBarChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="card shadow mb-4">
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">BERDASARKAN ASSET
                                                ORGANIZATION<br>
                                                <span style="font-size: small;">Department / Unit Pemilik Asset</span>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-bar">
                                                <canvas id="myHorizontalBarChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4">
                                    <div class="card shadow mb-4">
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">AGING PERANGKAT<br>
                                                <span style="font-size: small;">Berdasarkan Usia</span>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-bar">
                                                <canvas id="agingBarChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4">
                                    <div class="card shadow mb-4">
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">PERANGKAT IN<br>
                                                <span style="font-size: small;">Bulan X</span>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-bar">
                                                <canvas id="perangkatInChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4">
                                    <div class="card shadow mb-4">
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">PERANGKAT OUT<br>
                                                <span style="font-size: small;">Bulan X<br></span>
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-bar">
                                                <canvas id="perangkatOutChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 mb-4">
                            <div class="card shadow mb-4 h-100">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">UTILISASI AREA / RACK<br>
                                        <span style="font-size: small;"><br></span>
                                    </h6>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div id="rack-status-dots" class="d-flex justify-content-left mb-2"></div>
                                    <div class="table-responsive flex-grow-1" style="overflow-y: auto; height: 0;">
                                        <table class="table" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>RACK / AREA</th>
                                                    <th>CAPACITY</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table-utilisasi-area-body">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Andhikasep</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Delete Data Modal-->
        <div class="modal fade" id="deleteDataModal" tabindex="-1" role="dialog" aria-labelledby="deleteDataModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteDataModalLabel">Delete Data by Period</h5>
                        <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Select a period to delete all its associated data from the database.</p>
                        <div class="form-group">
                            <label for="deleteMonthSelect">Bulan</label>
                            <select class="form-control" id="deleteMonthSelect">
                                <option value="">-- Pilih Bulan --</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deleteYearSelect">Tahun</label>
                            <select class="form-control" id="deleteYearSelect">
                                <option value="">-- Pilih Tahun --</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" type="button" id="btn-confirm-delete">Delete Data</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="uploadExcelModal" tabindex="-1" role="dialog"
            aria-labelledby="uploadExcelModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document" id="uploadExcelModalDialog">
                <div class="modal-content upload-modal-content">
                    <div class="modal-header upload-modal-header">
                        <h5 class="modal-title" id="uploadExcelModalLabel">
                            <i class="fas fa-file-excel mr-2"></i>Upload Excel Data
                        </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body upload-modal-body">
                        <div class="row">
                            <div class="col-lg-12" id="uploadModalLeftCol">
                                <div class="form-group mb-3">
                                    <label for="upload-data-type" class="small font-weight-bold text-gray-600">Tipe Data</label>
                                    <select class="form-control form-control-sm" id="upload-data-type">
                                        <option value="asset">Data Asset</option>
                                        <option value="rack">Data Utilisasi Rack</option>
                                    </select>
                                </div>
                                <div class="upload-drop-zone" id="upload-drop-zone">
                                    <input type="file" id="excel-file-input" accept=".xlsx,.xls,.csv"
                                        style="display:none" />
                                    <div class="upload-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <h5>Drag &amp; Drop Excel File</h5>
                                    <p>or click to browse your computer</p>
                                    <button class="btn-browse" id="btn-browse-file" type="button">
                                        <i class="fas fa-folder-open mr-1"></i> Browse Files
                                    </button>
                                    <div class="file-types">
                                        Supported: .xlsx, .xls, .csv &bull; Max 10MB
                                    </div>
                                </div>

                                <div class="upload-progress-container" id="upload-progress">
                                    <div class="upload-progress-bar">
                                        <div class="progress-fill" id="upload-progress-fill"></div>
                                    </div>
                                    <div class="upload-file-info">
                                        <span class="file-name" id="upload-file-name"></span>
                                        <span class="file-size" id="upload-file-size"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" id="uploadModalRightCol" style="display: none;">
                                <div class="upload-controls" id="upload-controls">
                                    <div class="form-group">
                                        <label for="sheet-select">Select Sheet</label>
                                        <select class="form-control" id="sheet-select"></select>
                                    </div>
                                    <button class="btn-generate" id="btn-generate-charts" type="button" disabled>
                                        <i class="fas fa-check "></i> Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Apakah Anda yakin ingin keluar?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js"></script>

        <!-- SheetJS (xlsx) for Excel parsing -->
        <!-- TODO(security): Pin version and add SRI integrity hash for production -->
        <script src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/formula-controller.js?v=5"></script>
        <script src="js/excel-upload.js?v=5"></script>
        <script src="js/demo/chart-bar-demo.js?v=5"></script>
        <script src="js/demo/chart-horizontal-bar-demo.js?v=5"></script>

        <!-- Close modal after chart generation -->
        <script>
            (function () {
                var genBtn = document.getElementById('btn-generate-charts');
                if (genBtn) {
                    genBtn.addEventListener('click', function () {
                        // Small delay so charts render, then close modal
                        setTimeout(function () {
                            $('#uploadExcelModal').modal('hide');
                        }, 400);
                    });
                }
            })();
        </script>

        <!-- Fetch data from database on load -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var ALL_MONTHS = [
                    "January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ];

                // Keep the dropdown open when clicking inside the selects
                var periodMenu = document.getElementById('period-dropdown-menu');
                if (periodMenu) {
                    periodMenu.addEventListener('click', function (e) {
                        e.stopPropagation();
                    });
                }

                // ── Populate Month & Year selects from DB ──
                function loadPeriods(selectPeriod) {
                    fetch('api/get_periods.php')
                        .then(function (r) { return r.json(); })
                        .then(function (result) {
                            var yearsSet = {};

                            if (result.status === 'success' && result.data) {
                                result.data.forEach(function (pg) {
                                    if (!pg || pg === 'Unknown Period') return;
                                    var parts = pg.split(' ');
                                    if (parts.length >= 2) {
                                        yearsSet[parts[1]] = true;
                                    }
                                });
                            }

                            // Build sorted year list ascending
                            var availableYears = Object.keys(yearsSet).sort();

                            // Populate navbar Month select (always all 12 months)
                            populateSelect('period-month-select', ALL_MONTHS, '-- Pilih Bulan --');
                            // Populate navbar Year select (dynamic from DB)
                            populateSelect('period-year-select', availableYears, '-- Pilih Tahun --');

                            // Populate delete modal selects
                            populateSelect('deleteMonthSelect', ALL_MONTHS, '-- Pilih Bulan --');
                            populateSelect('deleteYearSelect', availableYears, '-- Pilih Tahun --');

                            // If a specific period was requested (e.g. after upload), pre-select it
                            if (selectPeriod) {
                                preselectPeriod(selectPeriod);
                                loadDataForPeriod(selectPeriod);
                            } else {
                                document.getElementById('selected-period-text').textContent = "PILIH DATA";
                                if (window.FormulaController) {
                                    window.FormulaController.updateDashboardCards([], []);
                                }
                            }
                        })
                        .catch(function (err) {
                            console.error('Error fetching periods:', err);
                        });
                }

                function populateSelect(selectId, items, placeholder) {
                    var sel = document.getElementById(selectId);
                    if (!sel) return;
                    sel.replaceChildren();
                    var defOpt = document.createElement('option');
                    defOpt.value = '';
                    defOpt.textContent = placeholder;
                    sel.appendChild(defOpt);
                    items.forEach(function (item) {
                        var opt = document.createElement('option');
                        opt.value = item;
                        opt.textContent = item.toUpperCase();
                        sel.appendChild(opt);
                    });
                }

                function preselectPeriod(period) {
                    var parts = period.split(' ');
                    if (parts.length >= 2) {
                        var mSel = document.getElementById('period-month-select');
                        var ySel = document.getElementById('period-year-select');
                        if (mSel) mSel.value = parts[0];
                        if (ySel) ySel.value = parts[1];
                        updateLoadButton();
                    }
                }

                // ── Enable / disable the "Tampilkan Data" button ──
                function updateLoadButton() {
                    var m = document.getElementById('period-month-select');
                    var y = document.getElementById('period-year-select');
                    var btn = document.getElementById('btn-load-period');
                    if (btn) {
                        btn.disabled = !(m && m.value && y && y.value);
                    }
                }

                var monthSel = document.getElementById('period-month-select');
                var yearSel = document.getElementById('period-year-select');
                if (monthSel) monthSel.addEventListener('change', updateLoadButton);
                if (yearSel) yearSel.addEventListener('change', updateLoadButton);

                // ── Load button click ──
                var btnLoad = document.getElementById('btn-load-period');
                if (btnLoad) {
                    btnLoad.addEventListener('click', function () {
                        var m = document.getElementById('period-month-select');
                        var y = document.getElementById('period-year-select');
                        if (m && m.value && y && y.value) {
                            var period = m.value + ' ' + y.value;
                            loadDataForPeriod(period);
                            // Close the dropdown after selecting
                            $(periodMenu).closest('.dropdown').find('.dropdown-toggle').dropdown('toggle');
                        }
                    });
                }

                // ── Fetch & render data for a period ──
                function loadDataForPeriod(period) {
                    document.getElementById('selected-period-text').textContent = period.toUpperCase();
                    fetch('api/get_data.php?periode=' + encodeURIComponent(period))
                        .then(function (response) { return response.json(); })
                        .then(function (result) {
                            if (result.status === 'success' && result.data && result.data.length > 0) {
                                console.log("Loaded data from database:", result.data.length, "rows for", period);
                                var headers = Object.keys(result.data[0]);
                                window.currentDashboardData = result.data;
                                window.currentDashboardHeaders = headers;
                                if (window.FormulaController) {
                                    setTimeout(function () {
                                        window.FormulaController.updateDashboardCards(result.data, headers);
                                        var cardUpdate = document.getElementById('card-last-update');
                                        if (cardUpdate) {
                                            cardUpdate.textContent = period.toUpperCase();
                                        }
                                    }, 100);
                                }
                            } else {
                                if (window.FormulaController) {
                                    window.FormulaController.updateDashboardCards([], []);
                                }
                            }
                        })
                        .catch(function (error) { console.error('Error fetching data:', error); });
                }

                // ── Initial load ──
                loadPeriods();

                // Expose globally so excel-upload.js can trigger after upload
                window.loadPeriods = loadPeriods;

                // ── Delete Data Logic ──
                var btnConfirmDelete = document.getElementById('btn-confirm-delete');
                if (btnConfirmDelete) {
                    btnConfirmDelete.addEventListener('click', function () {
                        var delMonth = document.getElementById('deleteMonthSelect');
                        var delYear = document.getElementById('deleteYearSelect');
                        if (!delMonth || !delMonth.value || !delYear || !delYear.value) {
                            alert('Please select both Month and Year to delete.');
                            return;
                        }

                        var periodToDelete = delMonth.value + ' ' + delYear.value;

                        if (!confirm("Are you SURE you want to delete all data for " + periodToDelete.toUpperCase() + "? This cannot be undone.")) {
                            return;
                        }

                        fetch('api/delete_data.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ periode: periodToDelete })
                        })
                            .then(function (response) { return response.json(); })
                            .then(function (result) {
                                if (result.status === 'success') {
                                    alert(result.message);
                                    $('#deleteDataModal').modal('hide');

                                    var currentPeriodText = document.getElementById('selected-period-text').textContent;
                                    if (currentPeriodText.toLowerCase() === periodToDelete.toLowerCase()) {
                                        document.getElementById('selected-period-text').textContent = "PILIH DATA";
                                        if (window.FormulaController) {
                                            window.FormulaController.updateDashboardCards([], []);
                                        }
                                    }
                                    // Refresh period selects
                                    loadPeriods();
                                } else {
                                    alert("Error deleting data: " + result.message);
                                }
                            })
                            .catch(function (error) {
                                console.error('Error:', error);
                                alert("Failed to delete data.");
                            });
                    });
                }
            });
        </script>

</body>

</html>