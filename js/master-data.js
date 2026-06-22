// js/master-data.js
$(document).ready(function() {

    var tablesLoaded = 0;
    var totalTables = 2;

    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Loading Data...',
            html: 'Please wait while the data is being processed.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }

    function checkAllTablesLoaded() {
        tablesLoaded++;
        if (tablesLoaded >= totalTables && typeof Swal !== 'undefined') {
            Swal.close();
        }
    }

    // 1. Initialize Asset DataTable
    var assetTable = $('#dataTableAsset').DataTable({
        deferRender: true,
        ajax: 'api/get_master_assets.php',
        columns: [
            { data: 'spec_code' },
            { data: 'spec_name' },
            { data: 'reg_no' },
            { data: 'asset_planner_organization' },
            { data: 'nbv', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ') },
            { data: 'so_result' },
            { data: 'so_location' },
            { data: 'range' },
            { data: 'sub_location' },
            { data: 'category' },
            { data: 'periode_group' },
            { 
                data: 'status',
                render: function(data, type, row) {
                    if (data === 'IN') {
                        return '<span class="badge badge-success px-2 py-1">IN</span>';
                    } else if (data === 'OUT') {
                        return '<span class="badge badge-danger px-2 py-1">OUT</span>';
                    } else if (data === '-') {
                        return '<span class="badge badge-secondary px-2 py-1">-</span>';
                    }
                    return data ? data : '';
                }
            }
        ],
        initComplete: function () {
            // Populate Periode Group filter
            var api = this.api();
            var periodes = api.column(10).data().unique().sort();
            var $periodeSelect = $('#filterAssetPeriode');
            periodes.each(function (d) {
                if(d) $periodeSelect.append('<option value="'+d+'">'+d+'</option>');
            });

            // Populate Sub Location filter
            var subLocations = api.column(8).data().unique().sort();
            var $subLocSelect = $('#filterAssetSubLocation');
            subLocations.each(function (d) {
                if(d) $subLocSelect.append('<option value="'+d+'">'+d+'</option>');
            });

            // Initialize Select2
            $('#filterAssetPeriode, #filterAssetSubLocation').select2({ width: '100%' });

            // Move search bar to custom container
            var $searchBar = $('#dataTableAsset_filter');
            $searchBar.detach().appendTo('#assetSearchContainer');
            $searchBar.css({ 'text-align': 'right', 'width': '100%' });
            $searchBar.find('label').css({ 'margin-bottom': '0', 'display': 'inline-flex', 'align-items': 'center' });
            $searchBar.find('input').css('margin-left', '0.5em');

            checkAllTablesLoaded();
        }
    });

    // Asset Filters onChange
    $('#filterAssetPeriode').on('change', function(){
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        assetTable.column(10).search(val ? '^'+val+'$' : '', true, false).draw();
    });

    $('#filterAssetSubLocation').on('change', function(){
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        assetTable.column(8).search(val ? '^'+val+'$' : '', true, false).draw();
    });

    // 2. Initialize Rack DataTable
    var rackTable = $('#dataTableRack').DataTable({
        deferRender: true,
        ajax: 'api/get_rack_data.php',
        columns: [
            { data: 'label' },
            { data: 'rack' },
            { data: 'category' }
        ],
        initComplete: function () {
            var api = this.api();
            
            // Populate Category filter
            var categories = api.column(2).data().unique().sort();
            var $categorySelect = $('#filterRackCategory');
            categories.each(function (d) {
                if(d) $categorySelect.append('<option value="'+d+'">'+d+'</option>');
            });

            // Populate Rack filter
            var racks = api.column(1).data().unique().sort();
            var $rackSelect = $('#filterRackName');
            racks.each(function (d) {
                if(d) $rackSelect.append('<option value="'+d+'">'+d+'</option>');
            });

            // Initialize Select2
            $('#filterRackCategory, #filterRackName').select2({ width: '100%' });

            // Move search bar to custom container
            var $searchBar = $('#dataTableRack_filter');
            $searchBar.detach().appendTo('#rackSearchContainer');
            $searchBar.css({ 'text-align': 'right', 'width': '100%' });
            $searchBar.find('label').css({ 'margin-bottom': '0', 'display': 'inline-flex', 'align-items': 'center' });
            $searchBar.find('input').css('margin-left', '0.5em');

            checkAllTablesLoaded();
        }
    });

    // Rack Filters onChange
    $('#filterRackCategory').on('change', function(){
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        rackTable.column(2).search(val ? '^'+val+'$' : '', true, false).draw();
    });

    $('#filterRackName').on('change', function(){
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        rackTable.column(1).search(val ? '^'+val+'$' : '', true, false).draw();
    });

});
