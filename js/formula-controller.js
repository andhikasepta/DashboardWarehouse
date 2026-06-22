/**
 * Formula Controller for Dashboard Summary Cards
 * ==============================================
 * Handles computing mathematical formulas (Sum, Average, Count) 
 * from Excel data to dynamically update the dashboard cards.
 */

(function (window) {
    'use strict';

    var FormulaController = {};

    // Helper: format numbers like "12.450"
    function formatNumber(num) {
        if (isNaN(num)) return '0';
        return new Intl.NumberFormat('id-ID').format(Math.round(num));
    }

    // Helper: format currency like "Rp. 15.200.000"
    function formatCurrency(num) {
        if (isNaN(num)) return 'Rp 0';
        return 'Rp ' + formatNumber(num);
    }

    // Mathematical operations
    FormulaController.computeSum = function (data, columnName) {
        if (!data || !columnName) return 0;
        var sum = 0;
        for (var i = 0; i < data.length; i++) {
            var raw = data[i][columnName];
            if (raw === undefined || raw === null || raw === '') continue;

            if (typeof raw === 'number') {
                sum += raw;
                continue;
            }

            var str = String(raw).trim().replace(/[RrpP\s]/g, ''); // Remove Rp and spaces
            
            var lastDot = str.lastIndexOf('.');
            var lastComma = str.lastIndexOf(',');

            if (lastComma > lastDot && lastDot !== -1) {
                // Comma is after dot: dot is thousands, comma is decimal (Indo)
                str = str.replace(/\./g, '').replace(/,/g, '.');
            } else if (lastDot > lastComma && lastComma !== -1) {
                // Dot is after comma: comma is thousands, dot is decimal (English)
                str = str.replace(/,/g, '');
            } else if (lastDot !== -1 && lastComma === -1) {
                // Only dots. If multiple dots or exactly 3 digits after last dot, assume thousands separator
                if (str.split('.').length > 2 || str.split('.')[1].length === 3) {
                    str = str.replace(/\./g, '');
                }
            } else if (lastComma !== -1 && lastDot === -1) {
                // Only commas. If multiple commas or exactly 3 digits after last comma, assume thousands separator
                if (str.split(',').length > 2 || str.split(',')[1].length === 3) {
                    str = str.replace(/,/g, '');
                } else {
                    // Otherwise assume it's a decimal (Indo)
                    str = str.replace(/,/g, '.');
                }
            }

            var val = parseFloat(str);
            if (!isNaN(val)) {
                sum += val;
            }
        }
        return sum;
    };

    FormulaController.computeCount = function (data, columnName) {
        if (!data) return 0;
        if (!columnName) return data.length;
        var count = 0;
        for (var i = 0; i < data.length; i++) {
            if (data[i][columnName] !== undefined && data[i][columnName] !== '') {
                count++;
            }
        }
        return count;
    };

    FormulaController.computeAverage = function (data, columnName) {
        if (!data || data.length === 0 || !columnName) return 0;
        var sum = FormulaController.computeSum(data, columnName);
        return sum / data.length;
    };

    // Auto-detect columns based on keywords (prioritizes keywords in order)
    function findColumnByKeyword(headers, keywords) {
        // Iterate over keywords first to ensure priority
        for (var j = 0; j < keywords.length; j++) {
            for (var i = 0; i < headers.length; i++) {
                var h = String(headers[i]).toLowerCase().trim();
                if (h.includes(keywords[j].toLowerCase())) {
                    return headers[i];
                }
            }
        }
        return null;
    }

    // Helper to find exact column or fallback
    FormulaController.findBestColumn = function(headers, exactNames, keywords) {
        for (var i = 0; i < headers.length; i++) {
            var h = String(headers[i]).trim();
            for (var j = 0; j < exactNames.length; j++) {
                if (h === exactNames[j]) return headers[i];
            }
        }
        return findColumnByKeyword(headers, keywords);
    };

    // Main entry point to update cards
    FormulaController.updateDashboardCards = function (sheetData, headers) {
        if (!sheetData || sheetData.length === 0) {
            console.log("Formula Controller: Clearing dashboard...");
            // Reset cards to 0
            var cardAsset = document.getElementById('card-total-asset');
            if (cardAsset) cardAsset.textContent = '0';
            var cardNbv = document.getElementById('card-total-nbv');
            if (cardNbv) cardNbv.textContent = 'Rp 0';
            var cardUtilText = document.getElementById('card-utilisasi-space-text');
            if (cardUtilText) cardUtilText.textContent = '0%';
            var cardUtilBar = document.getElementById('card-utilisasi-space-bar');
            if (cardUtilBar) { cardUtilBar.style.width = '0%'; cardUtilBar.className = 'progress-bar bg-danger'; }
            var cardFreeText = document.getElementById('card-free-space-text');
            if (cardFreeText) cardFreeText.textContent = '0%';
            var cardFreeBar = document.getElementById('card-free-space-bar');
            if (cardFreeBar) { cardFreeBar.style.width = '0%'; cardFreeBar.className = 'progress-bar bg-danger'; }
            var cardUpdate = document.getElementById('card-last-update');
            if (cardUpdate) cardUpdate.textContent = '-';
            
            // Clear charts
            if (window.myBarChart && window.myBarChart.data) { window.myBarChart.data.labels = []; window.myBarChart.data.datasets.forEach(function(d) { d.data = []; }); window.myBarChart.update(); }
            if (window.myHorizontalBarChart && window.myHorizontalBarChart.data) { window.myHorizontalBarChart.data.labels = []; window.myHorizontalBarChart.data.datasets.forEach(function(d) { d.data = []; }); window.myHorizontalBarChart.update(); }
            if (window.agingBarChart && window.agingBarChart.data) { window.agingBarChart.data.labels = []; window.agingBarChart.data.datasets.forEach(function(d) { d.data = []; }); window.agingBarChart.update(); }
            
            // Clear table
            var tbody = document.getElementById('table-utilisasi-area-body');
            if (tbody) tbody.replaceChildren();
            var dotContainer = document.getElementById('rack-status-dots');
            if (dotContainer) dotContainer.replaceChildren();

            return;
        }

        console.log("Formula Controller: Updating cards from data...", headers);

        // 1. TOTAL ASSET
        // Counts rows where "Nama Perangkat" is present
        var assetCol = findColumnByKeyword(headers, ['nama perangkat', 'perangkat', 'nama', 'asset']);
        var totalAsset = assetCol ? FormulaController.computeCount(sheetData, assetCol) : FormulaController.computeCount(sheetData);
        var cardAsset = document.getElementById('card-total-asset');
        if (cardAsset) cardAsset.textContent = formatNumber(totalAsset);

        // 2. TOTAL NBV
        // Tries to sum an "NBV" column first, then "Value", "Harga", or "Price".
        var nbvCol = findColumnByKeyword(headers, ['nbv', 'value', 'harga', 'price', 'total']);
        var totalNbv = nbvCol ? FormulaController.computeSum(sheetData, nbvCol) : 0;
        var cardNbv = document.getElementById('card-total-nbv');
        if (cardNbv) cardNbv.textContent = formatCurrency(totalNbv);

        // 3 & 4. UTILISASI SPACE & FREE SPACE
        // These cards are populated by the UTILISASI AREA / RACK table section (section 9) below.
        // Helper for Utilisasi progress bar colors
        function getUtilisasiClass(percent) {
            if (percent <= 70) return 'bg-success';
            if (percent <= 90) return 'bg-warning';
            return 'bg-danger';
        }

        // Helper for Free Space progress bar colors
        function getFreeSpaceClass(percent) {
            if (percent <= 29) return 'bg-danger';
            if (percent <= 59) return 'bg-warning';
            return 'bg-success';
        }

        // 5. LAST UPDATE
        // Set to today's date formatted
        var cardUpdate = document.getElementById('card-last-update');
        if (cardUpdate) {
            var date = new Date();
            var months = ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'];
            cardUpdate.textContent = months[date.getMonth()] + ' ' + date.getFullYear();
        }

        // 6. PERGERAKAN PERANGKAT CHART (myBarChart)
        // Uses GRUP_BUILDING column for grouping.
        // Qty = count of SPEC_CODE per unique building.
        // NBV = sum of NBV per unique building.
        if (window.myBarChart && window.myBarChart.data) {
            // Try exact column name first, then fallback to keyword detection
            var buildingCol = FormulaController.findBestColumn(headers, ['GRUP_BUILDING'], ['grup_building', 'building', 'gedung', 'status', 'pergerakan', 'kategori']);

            // Find SPEC_CODE column for counting Qty
            var specCodeColBar = FormulaController.findBestColumn(headers, ['SPEC_CODE'], ['spec_code', 'spec code', 'spek']);

            // Find NBV column for summing
            var barNbvCol = FormulaController.findBestColumn(headers, ['NBV'], ['nbv', 'value', 'harga', 'price', 'total']);

            if (buildingCol) {
                // Group rows by unique GRUP_BUILDING
                var groups = {};
                for (var i = 0; i < sheetData.length; i++) {
                    var building = String(sheetData[i][buildingCol] || 'Unknown').trim();
                    if (!groups[building]) {
                        groups[building] = { data: [] };
                    }
                    groups[building].data.push(sheetData[i]);
                }

                var labels = Object.keys(groups);
                var qtyData = [];
                var nbvData = [];

                for (var j = 0; j < labels.length; j++) {
                    var groupData = groups[labels[j]].data;

                    // Qty = count of rows that have a SPEC_CODE value in this building group
                    var qty = specCodeColBar
                        ? FormulaController.computeCount(groupData, specCodeColBar)
                        : FormulaController.computeCount(groupData);

                    // NBV = sum of NBV column for this building group
                    var nbv = barNbvCol
                        ? FormulaController.computeSum(groupData, barNbvCol)
                        : 0;

                    qtyData.push(qty);
                    nbvData.push(nbv);
                }

                window.myBarChart.data.labels = labels;
                window.myBarChart.data.datasets[0].data = qtyData;
                window.myBarChart.data.datasets[1].data = nbvData;
                window.myBarChart.update();
            } else {
                // Fallback if no building column is found: plot total
                window.myBarChart.data.labels = ["Total"];
                window.myBarChart.data.datasets[0].data = [totalAsset];
                window.myBarChart.data.datasets[1].data = [totalNbv];
                window.myBarChart.update();
            }
        }

        // 7. BERDASARKAN ASSET ORGANIZATION (myHorizontalBarChart)
        // Uses ASSET_PLANNER_ORGANIZATION column for grouping.
        // Qty = count of SPEC_CODE per unique organization.
        // NBV = sum of NBV per unique organization.
        if (window.myHorizontalBarChart && window.myHorizontalBarChart.data) {
            // Try exact column name first, then fallback to keyword detection
            var orgCol = FormulaController.findBestColumn(headers, ['ASSET_PLANNER_ORGANIZATION'], ['asset_planner_organization', 'department', 'dept', 'organization', 'unit', 'pemilik', 'owner', 'divisi']);

            // Find SPEC_CODE column for counting Qty
            var specCodeCol = FormulaController.findBestColumn(headers, ['SPEC_CODE'], ['spec_code', 'spec code', 'spek']);

            // Find NBV column for summing
            var orgNbvCol = FormulaController.findBestColumn(headers, ['NBV'], ['nbv', 'value', 'harga', 'price', 'total']);

            if (orgCol) {
                // Group rows by unique ASSET_PLANNER_ORGANIZATION
                var orgGroups = {};
                for (var k = 0; k < sheetData.length; k++) {
                    var org = String(sheetData[k][orgCol] || 'Unknown').trim();
                    if (!orgGroups[org]) {
                        orgGroups[org] = { data: [] };
                    }
                    orgGroups[org].data.push(sheetData[k]);
                }

                var orgLabels = Object.keys(orgGroups);
                var orgQtyData = [];
                var orgNbvData = [];

                for (var l = 0; l < orgLabels.length; l++) {
                    var oGroupData = orgGroups[orgLabels[l]].data;

                    // Qty = count of rows that have a SPEC_CODE value in this org group
                    var oQty = specCodeCol
                        ? FormulaController.computeCount(oGroupData, specCodeCol)
                        : FormulaController.computeCount(oGroupData);

                    // NBV = sum of NBV column for this org group
                    var oNbv = orgNbvCol
                        ? FormulaController.computeSum(oGroupData, orgNbvCol)
                        : 0;

                    orgQtyData.push(oQty);
                    orgNbvData.push(oNbv);
                }

                window.myHorizontalBarChart.data.labels = orgLabels;
                window.myHorizontalBarChart.data.datasets[0].data = orgQtyData;
                window.myHorizontalBarChart.data.datasets[1].data = orgNbvData;
                window.myHorizontalBarChart.update();
            } else {
                // Fallback if no org column is found
                window.myHorizontalBarChart.data.labels = ["Total"];
                window.myHorizontalBarChart.data.datasets[0].data = [totalAsset];
                window.myHorizontalBarChart.data.datasets[1].data = [totalNbv];
                window.myHorizontalBarChart.update();
            }
        }

        // 8. AGING PERANGKAT CHART (agingBarChart)
        // Uses RANGE column for grouping.
        // Qty = count of SPEC_CODE per unique range.
        if (window.agingBarChart && window.agingBarChart.data) {
            // Try exact column name first, then fallback to keyword detection
            var rangeCol = headers.indexOf('RANGE') !== -1
                ? 'RANGE'
                : findColumnByKeyword(headers, ['range', 'aging', 'usia', 'umur']);

            // Find SPEC_CODE column for counting
            var specCodeColAging = headers.indexOf('SPEC_CODE') !== -1
                ? 'SPEC_CODE'
                : findColumnByKeyword(headers, ['spec_code', 'spec code', 'spek']);

            if (rangeCol) {
                // Group rows by unique RANGE
                var rangeGroups = {};
                for (var m = 0; m < sheetData.length; m++) {
                    var range = String(sheetData[m][rangeCol] || 'Unknown').trim();
                    if (!rangeGroups[range]) {
                        rangeGroups[range] = { data: [] };
                    }
                    rangeGroups[range].data.push(sheetData[m]);
                }

                var rangeLabels = Object.keys(rangeGroups);
                var rangeQtyData = [];

                for (var n = 0; n < rangeLabels.length; n++) {
                    var rGroupData = rangeGroups[rangeLabels[n]].data;

                    // Qty = count of rows that have a SPEC_CODE value in this range group
                    var rQty = specCodeColAging
                        ? FormulaController.computeCount(rGroupData, specCodeColAging)
                        : FormulaController.computeCount(rGroupData);

                    rangeQtyData.push(rQty);
                }

                window.agingBarChart.data.labels = rangeLabels;
                window.agingBarChart.data.datasets[0].data = rangeQtyData;
                window.agingBarChart.update();
            }
        }

        // 9. UTILISASI AREA / RACK TABLE
        var tbody = document.getElementById('table-utilisasi-area-body');
        if (tbody) {
            tbody.replaceChildren(); // clear first
            
            // Fetch Rack Master data to know total slots
            fetch('api/get_rack_data.php')
                .then(function(response) { return response.json(); })
                .then(function(rackResult) {
                    var masterRackData = (rackResult.status === 'success' && rackResult.data) ? rackResult.data : [];
                    
                    // 1. Calculate Total Slots per Rack from master data
                    var masterRackGroups = {};
                    for (var i = 0; i < masterRackData.length; i++) {
                        var row = masterRackData[i];
                        var rName = String(row.rack || 'Unknown').trim();
                        if (!masterRackGroups[rName]) {
                            masterRackGroups[rName] = { totalSlots: 0, labels: {} };
                        }
                        masterRackGroups[rName].totalSlots++;
                        if (row.label) {
                            masterRackGroups[rName].labels[String(row.label).trim().toLowerCase()] = true;
                        }
                    }

                    // 2. Calculate Used Slots per Rack from asset data
                    var usedSlotsPerRack = {};
                    var subLocationCol = findColumnByKeyword(headers, ['sub_location', 'sub location', 'label', 'lokasi', 'location']);
                    
                    if (subLocationCol && sheetData.length > 0) {
                        for (var j = 0; j < sheetData.length; j++) {
                            var assetSubLoc = String(sheetData[j][subLocationCol] || '').trim().toLowerCase();
                            if (!assetSubLoc) continue;
                            
                            // Find which rack this sub_location belongs to
                            for (var rName in masterRackGroups) {
                                if (masterRackGroups[rName].labels[assetSubLoc]) {
                                    if (!usedSlotsPerRack[rName]) usedSlotsPerRack[rName] = 0;
                                    usedSlotsPerRack[rName]++;
                                    break; // asset can only be in one slot
                                }
                            }
                        }
                    }

                    // 3. If there is no master data, fallback to old logic?
                    // Let's just show what's in master data. If master is empty, show empty.
                    var rackNames = Object.keys(masterRackGroups);
                    rackNames.sort();

                    var greenCount = 0;
                    var yellowCount = 0;
                    var redCount = 0;
                    var rackCapacities = [];

                    for (var q = 0; q < rackNames.length; q++) {
                        var rName = rackNames[q];
                        var totalSlots = masterRackGroups[rName].totalSlots;
                        var usedSlots = usedSlotsPerRack[rName] || 0;
                        
                        var capacity = totalSlots > 0 ? Math.round((usedSlots / totalSlots) * 100) : 0;
                        if (capacity > 100) capacity = 100; // cap at 100% just in case
                        
                        rackCapacities.push(capacity);

                        var barColorClass;
                        if (capacity <= 70) {
                            barColorClass = 'bg-success';
                            greenCount++;
                        } else if (capacity <= 90) {
                            barColorClass = 'bg-warning';
                            yellowCount++;
                        } else {
                            barColorClass = 'bg-danger';
                            redCount++;
                        }

                        var tr = document.createElement('tr');
                        var tdName = document.createElement('td');
                        tdName.textContent = rName;
                        tdName.style.fontSize = '0.85rem';
                        tdName.style.whiteSpace = 'nowrap';

                        var tdCapacity = document.createElement('td');
                        var progressWrap = document.createElement('div');
                        progressWrap.className = 'd-flex align-items-center';

                        var percentLabel = document.createElement('span');
                        percentLabel.className = 'mr-2 font-weight-bold';
                        percentLabel.style.minWidth = '38px';
                        percentLabel.style.fontSize = '0.8rem';
                        percentLabel.textContent = capacity + '%';

                        var progressOuter = document.createElement('div');
                        progressOuter.className = 'progress progress-sm flex-grow-1';
                        progressOuter.style.height = '10px';
                        progressOuter.style.borderRadius = '5px';

                        var progressInner = document.createElement('div');
                        progressInner.className = 'progress-bar ' + barColorClass;
                        progressInner.setAttribute('role', 'progressbar');
                        progressInner.style.width = capacity + '%';
                        progressInner.style.borderRadius = '5px';
                        progressInner.style.transition = 'width 0.6s ease';

                        progressOuter.appendChild(progressInner);
                        progressWrap.appendChild(percentLabel);
                        progressWrap.appendChild(progressOuter);
                        tdCapacity.appendChild(progressWrap);

                        tr.appendChild(tdName);
                        tr.appendChild(tdCapacity);
                        tbody.appendChild(tr);
                    }

                    // Update colored dot summary
                    var dotContainer = document.getElementById('rack-status-dots');
                    if (dotContainer) {
                        dotContainer.replaceChildren();

                        function createDotBadge(colorClass, count) {
                            var badge = document.createElement('span');
                            badge.className = 'badge badge-pill mr-2 d-flex align-items-center';
                            badge.style.fontSize = '0.75rem';
                            badge.style.padding = '4px 10px';

                            var dot = document.createElement('span');
                            dot.style.display = 'inline-block';
                            dot.style.width = '10px';
                            dot.style.height = '10px';
                            dot.style.borderRadius = '50%';
                            dot.style.marginRight = '5px';

                            if (colorClass === 'success') {
                                dot.style.backgroundColor = '#1cc88a';
                                badge.style.backgroundColor = 'rgba(28, 200, 138, 0.15)';
                                badge.style.color = '#1cc88a';
                            } else if (colorClass === 'warning') {
                                dot.style.backgroundColor = '#f6c23e';
                                badge.style.backgroundColor = 'rgba(246, 194, 62, 0.15)';
                                badge.style.color = '#f6c23e';
                            } else {
                                dot.style.backgroundColor = '#e74a3b';
                                badge.style.backgroundColor = 'rgba(231, 74, 59, 0.15)';
                                badge.style.color = '#e74a3b';
                            }

                            badge.appendChild(dot);
                            badge.appendChild(document.createTextNode(count));
                            return badge;
                        }

                        dotContainer.appendChild(createDotBadge('success', greenCount));
                        dotContainer.appendChild(createDotBadge('warning', yellowCount));
                        dotContainer.appendChild(createDotBadge('danger', redCount));
                    }

                    // Update UTILISASI SPACE & FREE SPACE cards
                    var avgCapacity = 0;
                    if (rackCapacities.length > 0) {
                        var sumCap = 0;
                        for (var t = 0; t < rackCapacities.length; t++) {
                            sumCap += rackCapacities[t];
                        }
                        avgCapacity = Math.round(sumCap / rackCapacities.length);
                    }

                    var utilPercent = avgCapacity;
                    var freePercent = 100 - utilPercent;

                    var cardUtilText = document.getElementById('card-utilisasi-space-text');
                    var cardUtilBar = document.getElementById('card-utilisasi-space-bar');
                    var cardFreeText = document.getElementById('card-free-space-text');
                    var cardFreeBar = document.getElementById('card-free-space-bar');

                    if (cardUtilText) cardUtilText.textContent = utilPercent + '%';
                    if (cardUtilBar) {
                        cardUtilBar.style.width = utilPercent + '%';
                        cardUtilBar.setAttribute('aria-valuenow', utilPercent);
                        cardUtilBar.className = 'progress-bar ' + getUtilisasiClass(utilPercent);
                    }

                    if (cardFreeText) cardFreeText.textContent = freePercent + '%';
                    if (cardFreeBar) {
                        cardFreeBar.style.width = freePercent + '%';
                        cardFreeBar.setAttribute('aria-valuenow', freePercent);
                        cardFreeBar.className = 'progress-bar ' + getFreeSpaceClass(freePercent);
                    }
                })
                .catch(function(err) { console.error('Error fetching rack data:', err); });
        }
    };

    // Expose to window
    window.FormulaController = FormulaController;

})(window);
