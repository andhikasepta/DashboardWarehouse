// js/master-data.js
$(document).ready(function() {

    // 1. Initialize Asset DataTable
    var assetTable = $('#dataTableAsset').DataTable({
        ajax: 'api/get_master_assets.php',
        columns: [
            { data: 'nama_perangkat' },
            { data: 'spec_code' },
            { data: 'reg_no' },
            { data: 'kategori' },
            { data: 'in' },
            { data: 'out' },
            { data: 'asset_planner_organization' },
            { data: 'gr_date' },
            { data: 'nbv', render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ') },
            { data: 'since' },
            { data: 'days' },
            { data: 'range' },
            { data: 'sub_location' },
            { data: 'grup_building' },
            { data: 'grup_rack' },
            { data: 'periode_group' }
        ],
        initComplete: function () {
            // Populate Periode Group filter
            var api = this.api();
            var periodes = api.column(15).data().unique().sort();
            var $periodeSelect = $('#filterAssetPeriode');
            periodes.each(function (d) {
                if(d) $periodeSelect.append('<option value="'+d+'">'+d+'</option>');
            });

            // Populate Sub Location filter
            var subLocations = api.column(12).data().unique().sort();
            var $subLocSelect = $('#filterAssetSubLocation');
            subLocations.each(function (d) {
                if(d) $subLocSelect.append('<option value="'+d+'">'+d+'</option>');
            });
        }
    });

    // Asset Filters onChange
    $('#filterAssetPeriode').on('change', function(){
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        assetTable.column(15).search(val ? '^'+val+'$' : '', true, false).draw();
    });

    $('#filterAssetSubLocation').on('change', function(){
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        assetTable.column(12).search(val ? '^'+val+'$' : '', true, false).draw();
    });

    // 2. Initialize Rack DataTable
    var rackTable = $('#dataTableRack').DataTable({
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
