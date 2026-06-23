<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Master Data view for Dashboard Warehouse">
    <meta name="author" content="">

    <title>Master Data - Dashboard Warehouse</title>

    <link rel="icon" href="img/LogoLintas.png">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/excel-upload.css?v=<?= time() ?>" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Basic Select2 Bootstrap 4 overrides */
        .select2-container .select2-selection--single { height: 31px; border: 1px solid #d1d3e2; border-radius: 0.2rem; display: flex; align-items: center; }
        .select2-container--default .select2-selection--single .select2-selection__arrow { height: 29px; }
    </style>
    
    <style>
        .nav-tabs .nav-link { font-weight: bold; }
        .nav-tabs .nav-link.active { color: #4e73df; }
        .table-responsive { overflow-x: auto; }
        #dataTableAsset th, #dataTableAsset td { white-space: nowrap; }
        #dataTableAsset td:nth-child(1) { white-space: normal !important; min-width: 200px; }
    </style>

</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column min-vh-100">
            <div id="content" class="flex-grow-1">
                
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 fixed-top shadow" style="z-index: 1020;">
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <a href="index.php"><img src="img/Lintasarta.png" alt="" width="150px"></a>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <!-- Navigation Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 font-weight-bold">
                                    <i class="fas fa-th-large mr-1"></i> Dashboard
                                </span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="master_data.php">
                                <span class="mr-2 d-none d-lg-inline text-primary font-weight-bold">
                                    <i class="fas fa-database mr-1"></i> Master Data
                                </span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- User Information (Static) -->
                        <li class="nav-item d-flex align-items-center">
                            <span class="nav-link pr-0">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><i class="fa fa-user mr-2 text-gray-400"></i>LISKA DWI NURYATI</span>
                            </span>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="padding-top: 100px;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Master Data</h1>
                        <div>
                            <button class="btn btn-success mr-2" data-toggle="modal" data-target="#uploadExcelModal">
                                <i class="fas fa-file-excel mr-1"></i> Upload Excel
                            </button>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteDataModal">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus Data
                            </button>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-4" id="masterDataTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="asset-tab" data-toggle="tab" href="#asset-data" role="tab" aria-controls="asset-data" aria-selected="true">Data Asset</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="rack-tab" data-toggle="tab" href="#rack-data" role="tab" aria-controls="rack-data" aria-selected="false">Data Utilisasi Rack</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="masterDataTabsContent">
                        
                        <!-- Asset Data Tab -->
                        <div class="tab-pane fade show active" id="asset-data" role="tabpanel" aria-labelledby="asset-tab">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data Asset</h6>
                                </div>
                                <div class="card-body">
                                    
                                    <!-- Custom Filters for Asset -->
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label>Periode (Month/Year):</label>
                                            <select id="filterAssetPeriode" class="form-control form-control-sm">
                                                <option value="">All Periods</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Sub Location:</label>
                                            <select id="filterAssetSubLocation" class="form-control form-control-sm">
                                                <option value="">All Sub Locations</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 d-flex align-items-end justify-content-end" id="assetSearchContainer">
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm" id="dataTableAsset" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Spec Code</th>
                                                    <th>Spec Name</th>
                                                    <th>Reg No</th>
                                                    <th>Asset Planner Org</th>
                                                    <th>NBV</th>
                                                    <th>SO Result</th>
                                                    <th>SO Location</th>
                                                    <th>Range</th>
                                                    <th>Sub Location</th>
                                                    <th>Category</th>
                                                    <th>Periode Group</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Populated by JS -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Rack Data Tab -->
                        <div class="tab-pane fade" id="rack-data" role="tabpanel" aria-labelledby="rack-tab">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tabel Master Utilisasi Rack</h6>
                                </div>
                                <div class="card-body">
                                    
                                    <!-- Custom Filters for Rack -->
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label>Category:</label>
                                            <select id="filterRackCategory" class="form-control form-control-sm">
                                                <option value="">All Categories</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Rack Name:</label>
                                            <select id="filterRackName" class="form-control form-control-sm">
                                                <option value="">All Racks</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 d-flex align-items-end justify-content-end" id="rackSearchContainer">
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm" id="dataTableRack" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Label (Sub Location)</th>
                                                    <th>Rack Group</th>
                                                    <th>Category</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Populated by JS -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white mt-auto">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2026</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Delete Data Modal-->
    <div class="modal fade" id="deleteDataModal" tabindex="-1" role="dialog" aria-labelledby="deleteDataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content upload-modal-content">
                <div class="modal-header upload-modal-header" style="background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);">
                    <h5 class="modal-title text-white" id="deleteDataModalLabel">
                        <i class="fas fa-trash-alt mr-2 text-white"></i>Hapus Data
                    </h5>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close" style="opacity: 0.8;">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body upload-modal-body">
                    <div class="p-3">
                        <div class="text-center text-gray-600 mb-4">
                            <h3 class="text-danger font-weight-bold mb-3"><i class="fas fa-exclamation-triangle mr-2"></i>Peringatan</h3>
                            <p class="mb-0" style="font-size: 1.1rem;">Data yang Anda pilih akan dihapus secara permanen dari sistem dan tidak dapat dikembalikan.</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="deleteMonthSelect" class="small font-weight-bold text-gray-600">Bulan</label>
                            <select class="form-control form-control-sm" id="deleteMonthSelect">
                                <option value="">-- Pilih Bulan --</option>
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="deleteYearSelect" class="small font-weight-bold text-gray-600">Tahun</label>
                            <select class="form-control form-control-sm" id="deleteYearSelect">
                                <option value="">-- Pilih Tahun --</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end mt-4">
                            <button class="btn btn-light px-4 mr-2" type="button" data-dismiss="modal" style="border-radius: 6px; font-weight: 600;">Cancel</button>
                            <button class="btn btn-danger px-4" type="button" id="btn-confirm-delete" style="border-radius: 6px; font-weight: 600; box-shadow: 0 4px 10px rgba(231,74,59,0.3);">
                                <i class="fas fa-trash mr-1"></i> Delete Data
                            </button>
                        </div>
                    </div>
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
                                    Supported: .xlsx, .xls, .csv &bull; Max 100MB
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
                                    <label for="sheet-select">Pilih Sheet</label>
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

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <!-- DataTables JS -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    
    <!-- SheetJS (xlsx) for Excel parsing -->
    <script src="https://cdn.sheetjs.com/xlsx-0.20.3/package/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="js/excel-upload.js?v=<?= time() ?>"></script>
    <script src="js/formula-controller.js?v=<?= time() ?>"></script>
    <script src="js/master-data.js?v=<?= time() ?>"></script>
    
    <script>
        $(document).ready(function() {
            // Restore active tab from localStorage if exists
            var activeTab = localStorage.getItem('activeMasterDataTab');
            if (activeTab) {
                $('#masterDataTabs a[href="' + activeTab + '"]').tab('show');
            }

            // Save active tab to localStorage on click
            $('#masterDataTabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var targetTab = $(e.target).attr("href");
                localStorage.setItem('activeMasterDataTab', targetTab);
            });
        });

        // Close modal after chart generation/saving
        var genBtn = document.getElementById('btn-generate-charts');
        if (genBtn) {
            genBtn.addEventListener('click', function () {
                setTimeout(function () {
                    $('#uploadExcelModal').modal('hide');
                    // Reload DataTables after upload
                    $('#dataTableAsset').DataTable().ajax.reload();
                    $('#dataTableRack').DataTable().ajax.reload();
                }, 400);
            });
        }
        
        // Delete Data Logic
        // Load periods for the delete dropdown
        fetch('api/get_periods.php')
            .then(response => response.json())
            .then(result => {
                if(result.status === 'success' && result.data) {
                    var mSel = document.getElementById('deleteMonthSelect');
                    var ySel = document.getElementById('deleteYearSelect');
                    if (mSel && ySel) {
                        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                        months.forEach(function (item) {
                            var opt = document.createElement('option');
                            opt.value = item; opt.textContent = item; mSel.appendChild(opt);
                        });
                        result.data.forEach(function (item) {
                            var parts = item.split(' ');
                            if(parts.length >= 2) {
                                var year = parts[1];
                                var existing = Array.from(ySel.options).find(opt => opt.value === year);
                                if(!existing) {
                                    var opt = document.createElement('option');
                                    opt.value = year; opt.textContent = year; ySel.appendChild(opt);
                                }
                            }
                        });
                    }
                }
            });

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
                if (!confirm("Are you SURE you want to delete all data for " + periodToDelete.toUpperCase() + "? This cannot be undone.")) return;

                fetch('api/delete_data.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ periode: periodToDelete })
                })
                .then(r => r.json())
                .then(res => {
                    if (res.status === 'success') {
                        alert('Data deleted successfully.');
                        $('#deleteDataModal').modal('hide');
                        $('#dataTableAsset').DataTable().ajax.reload();
                    } else {
                        alert('Failed to delete data: ' + res.message);
                    }
                });
            });
        }
    </script>
</html>
