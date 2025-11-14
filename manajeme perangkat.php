<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Perangkat - Inventory Lab</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #4cc9a7;
            --warning: #f9c74f;
            --danger: #f94144;
            --light: #f8f9fa;
            --dark: #2b2d42;
            --sidebar: #1e293b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f1f5f9;
            display: flex;
            min-height: 100vh;
            color: var(--dark);
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--sidebar);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 25px 20px;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
        }

        .sidebar-menu {
            padding: 15px 0;
            list-style: none;
        }

        .sidebar-menu li {
            margin: 5px 15px;
        }

        .sidebar-menu a {
            padding: 14px 20px;
            display: flex;
            align-items: center;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .sidebar-menu a:hover {
            background: #334155;
            color: white;
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .sidebar-menu a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 25px;
        }

        /* Header */
        .header {
            background: white;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: var(--dark);
            font-size: 1.6rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Page Actions */
        .page-actions {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .btn-success {
            background: var(--success);
            color: white;
        }

        .btn-outline {
            background: white;
            border: 2px solid #e2e8f0;
            color: var(--dark);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Filters */
        .filters {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-group label {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--dark);
        }

        .filter-group select,
        .filter-group input {
            padding: 10px 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        /* Devices Grid */
        .devices-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .device-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .device-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .device-header {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .device-info h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .device-id {
            color: #64748b;
            font-size: 0.85rem;
            font-family: 'Courier New', monospace;
        }

        .device-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-maintenance {
            background: #fef3c7;
            color: #92400e;
        }

        .status-broken {
            background: #fee2e2;
            color: #991b1b;
        }

        .device-specs {
            padding: 20px;
        }

        .spec-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .spec-item:last-child {
            border-bottom: none;
        }

        .spec-label {
            color: #64748b;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .spec-value {
            color: var(--dark);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .device-actions {
            padding: 15px 20px;
            background: #f8fafc;
            display: flex;
            gap: 10px;
            border-top: 1px solid #e2e8f0;
        }

        .action-btn {
            padding: 8px 12px;
            border: none;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .action-btn.edit {
            background: #dbeafe;
            color: #1e40af;
        }

        .action-btn.repair {
            background: #fef3c7;
            color: #92400e;
        }

        .action-btn.delete {
            background: #fee2e2;
            color: #dc2626;
        }

        .action-btn:hover {
            transform: translateY(-1px);
        }

        /* Devices Table View */
        .devices-table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 25px;
        }

        .table-header {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .table-actions {
            display: flex;
            gap: 10px;
        }

        .table-search {
            padding: 10px 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            width: 300px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--dark);
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        tr:hover {
            background: #f8fafc;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .indicator-active {
            background: var(--success);
        }

        .indicator-maintenance {
            background: var(--warning);
        }

        .indicator-broken {
            background: var(--danger);
        }

        /* View Toggle */
        .view-toggle {
            display: flex;
            background: white;
            border-radius: 10px;
            padding: 5px;
            margin-bottom: 20px;
            width: fit-content;
        }

        .view-option {
            padding: 10px 20px;
            border: none;
            background: none;
            cursor: pointer;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .view-option.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        /* QR Code Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            max-width: 400px;
            width: 90%;
            text-align: center;
        }

        .qr-code {
            width: 200px;
            height: 200px;
            background: #f8fafc;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #e2e8f0;
            border-radius: 10px;
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #64748b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .devices-grid {
                grid-template-columns: 1fr;
            }

            .filters {
                grid-template-columns: 1fr;
            }

            .page-actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-laptop-code"></i> Inventory Lab</h3>
        </div>
        <ul class="sidebar-menu">
            <li><a href="/project lab komputer/dashboard admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#" class="active"><i class="fas fa-desktop"></i> Manajemen Perangkat</a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> Jadwal Lab</a></li>
            <li><a href="#"><i class="fas fa-wrench"></i> Perawatan</a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i> Laporan</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Pengaturan</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1><i class="fas fa-desktop"></i> Manajemen Perangkat</h1>
            <div class="user-info">
                <span style="font-weight: 600;">Hai, Administrator!</span>
                <div class="user-avatar">A</div>
            </div>
        </div>

        <!-- Page Actions -->
        <div class="page-actions">
            <button class="btn btn-primary" onclick="showAddDeviceModal()">
                <i class="fas fa-plus"></i> Tambah Perangkat
            </button>
            <button class="btn btn-success">
                <i class="fas fa-file-export"></i> Export Data
            </button>
            <button class="btn btn-outline">
                <i class="fas fa-print"></i> Print QR Codes
            </button>
            <button class="btn btn-outline">
                <i class="fas fa-sync-alt"></i> Refresh Data
            </button>
        </div>

        <!-- View Toggle -->
        <div class="view-toggle">
            <button class="view-option active" onclick="toggleView('grid')">
                <i class="fas fa-th"></i> Grid
            </button>
            <button class="view-option" onclick="toggleView('table')">
                <i class="fas fa-list"></i> Table
            </button>
        </div>

        <!-- Filters -->
        <div class="filters">
            <div class="filter-group">
                <label>Lab</label>
                <select>
                    <option>Semua Lab</option>
                    <option>Lab 1</option>
                    <option>Lab 2</option>
                    <option>Lab 3</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Status</label>
                <select>
                    <option>Semua Status</option>
                    <option>Aktif</option>
                    <option>Maintenance</option>
                    <option>Rusak</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Tipe Perangkat</label>
                <select>
                    <option>Semua Tipe</option>
                    <option>PC Desktop</option>
                    <option>Laptop</option>
                    <option>Monitor</option>
                    <option>Printer</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Cari Perangkat</label>
                <input type="text" placeholder="Cari berdasarkan nama atau ID...">
            </div>
        </div>

        <!-- Devices Grid View -->
        <div id="gridView" class="devices-grid">
            <!-- Device Card 1 -->
            <div class="device-card">
                <div class="device-header">
                    <div class="device-info">
                        <h3>PC LAB-1-01</h3>
                        <div class="device-id">INV/PC/2024/001</div>
                    </div>
                    <div class="device-status status-active">Aktif</div>
                </div>
                <div class="device-specs">
                    <div class="spec-item">
                        <span class="spec-label">Lab</span>
                        <span class="spec-value">Lab 1</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Processor</span>
                        <span class="spec-value">Intel i5-10400</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">RAM</span>
                        <span class="spec-value">8GB DDR4</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Storage</span>
                        <span class="spec-value">256GB SSD</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Terakhir Maintenance</span>
                        <span class="spec-value">15 Mar 2024</span>
                    </div>
                </div>
                <div class="device-actions">
                    <button class="action-btn edit" onclick="editDevice(1)">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="action-btn repair" onclick="showQRCode('PC LAB-1-01')">
                        <i class="fas fa-qrcode"></i> QR Code
                    </button>
                    <button class="action-btn delete" onclick="deleteDevice(1)">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>

            <!-- Device Card 2 -->
            <div class="device-card">
                <div class="device-header">
                    <div class="device-info">
                        <h3>PC LAB-2-05</h3>
                        <div class="device-id">INV/PC/2024/002</div>
                    </div>
                    <div class="device-status status-maintenance">Maintenance</div>
                </div>
                <div class="device-specs">
                    <div class="spec-item">
                        <span class="spec-label">Lab</span>
                        <span class="spec-value">Lab 2</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Processor</span>
                        <span class="spec-value">Intel i3-10100</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">RAM</span>
                        <span class="spec-value">4GB DDR4</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Storage</span>
                        <span class="spec-value">1TB HDD</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Terakhir Maintenance</span>
                        <span class="spec-value">10 Mar 2024</span>
                    </div>
                </div>
                <div class="device-actions">
                    <button class="action-btn edit">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="action-btn repair" onclick="showQRCode('PC LAB-2-05')">
                        <i class="fas fa-qrcode"></i> QR Code
                    </button>
                    <button class="action-btn delete">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>

            <!-- Add more device cards as needed -->
        </div>

        <!-- Devices Table View -->
        <div id="tableView" class="devices-table-container" style="display: none;">
            <div class="table-header">
                <h3>Daftar Semua Perangkat</h3>
                <div class="table-actions">
                    <input type="text" class="table-search" placeholder="Cari perangkat...">
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID Perangkat</th>
                        <th>Nama</th>
                        <th>Lab</th>
                        <th>Spesifikasi</th>
                        <th>Status</th>
                        <th>Terakhir Maintenance</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>INV/PC/2024/001</td>
                        <td>PC LAB-1-01</td>
                        <td>Lab 1</td>
                        <td>i5-10400, 8GB RAM, 256GB SSD</td>
                        <td><span class="status-indicator indicator-active"></span> Aktif</td>
                        <td>15 Mar 2024</td>
                        <td>
                            <button class="action-btn edit">Edit</button>
                            <button class="action-btn repair">QR</button>
                        </td>
                    </tr>
                    <tr>
                        <td>INV/PC/2024/002</td>
                        <td>PC LAB-2-05</td>
                        <td>Lab 2</td>
                        <td>i3-10100, 4GB RAM, 1TB HDD</td>
                        <td><span class="status-indicator indicator-maintenance"></span> Maintenance</td>
                        <td>10 Mar 2024</td>
                        <td>
                            <button class="action-btn edit">Edit</button>
                            <button class="action-btn repair">QR</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- QR Code Modal -->
    <div id="qrModal" class="modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeModal()">&times;</button>
            <h3>QR Code Perangkat</h3>
            <div class="qr-code">
                <span style="color: #64748b;">QR Code akan muncul di sini</span>
            </div>
            <p id="qrDeviceName" style="font-weight: 600; margin: 15px 0;"></p>
            <button class="btn btn-primary">
                <i class="fas fa-print"></i> Print QR Code
            </button>
        </div>
    </div>

    <script>
        // Toggle between grid and table view
        function toggleView(view) {
            const gridView = document.getElementById('gridView');
            const tableView = document.getElementById('tableView');
            const viewOptions = document.querySelectorAll('.view-option');

            viewOptions.forEach(opt => opt.classList.remove('active'));
            event.target.classList.add('active');

            if (view === 'grid') {
                gridView.style.display = 'grid';
                tableView.style.display = 'none';
            } else {
                gridView.style.display = 'none';
                tableView.style.display = 'block';
            }
        }

        // Show QR Code Modal
        function showQRCode(deviceName) {
            const modal = document.getElementById('qrModal');
            const deviceNameEl = document.getElementById('qrDeviceName');

            deviceNameEl.textContent = deviceName;
            modal.style.display = 'flex';
        }

        // Close Modal
        function closeModal() {
            const modal = document.getElementById('qrModal');
            modal.style.display = 'none';
        }

        // Show Add Device Modal
        function showAddDeviceModal() {
            alert('Fitur tambah perangkat akan dibuka di sini');
            // In real implementation, show a form modal
        }

        // Edit Device
        function editDevice(id) {
            alert(`Edit perangkat dengan ID: ${id}`);
        }

        // Delete Device
        function deleteDevice(id) {
            if (confirm('Apakah Anda yakin ingin menghapus perangkat ini?')) {
                alert(`Perangkat dengan ID: ${id} akan dihapus`);
            }
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('qrModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>

</html>