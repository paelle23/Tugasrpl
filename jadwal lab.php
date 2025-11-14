<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Inventory Lab Komputer</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --info: #17a2b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Enhanced */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--primary) 0%, #1a252f 100%);
            color: white;
            transition: all 0.3s;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 25px 20px;
            background: rgba(0, 0, 0, 0.2);
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            margin-bottom: 5px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sidebar-header .subtitle {
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .sidebar-menu {
            padding: 0;
            list-style: none;
            margin-top: 20px;
        }

        .sidebar-menu li {
            position: relative;
        }

        .sidebar-menu a {
            padding: 15px 25px;
            display: flex;
            align-items: center;
            color: #bdc3c7;
            text-decoration: none;
            border-left: 4px solid transparent;
            transition: all 0.3s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(52, 73, 94, 0.6);
            color: white;
            border-left-color: var(--secondary);
        }

        .sidebar-menu a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .menu-badge {
            background: var(--secondary);
            color: white;
            border-radius: 10px;
            padding: 2px 8px;
            font-size: 0.7rem;
            margin-left: auto;
        }

        /* Main Content Enhanced */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 25px;
            transition: all 0.3s;
        }

        .header {
            background: white;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: var(--dark);
            font-size: 1.6rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary), #2980b9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.3);
        }

        .notification-bell {
            position: relative;
            cursor: pointer;
            font-size: 1.2rem;
            color: var(--dark);
        }

        .notification-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Enhanced Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-left: 5px solid var(--secondary);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            background: rgba(52, 152, 219, 0.1);
            border-radius: 0 0 0 80px;
        }

        .stat-card.success {
            border-left-color: var(--success);
        }

        .stat-card.warning {
            border-left-color: var(--warning);
        }

        .stat-card.danger {
            border-left-color: var(--danger);
        }

        .stat-card.info {
            border-left-color: var(--info);
        }

        .stat-card h3 {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card .value {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .stat-card .trend {
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-card .trend.down {
            color: var(--danger);
        }

        .stat-card .trend.up {
            color: var(--success);
        }

        .stat-icon {
            position: absolute;
            top: 25px;
            right: 25px;
            font-size: 2rem;
            opacity: 0.3;
        }

        /* Enhanced Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 35px;
        }

        .chart-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .chart-container h3 {
            color: var(--dark);
            margin-bottom: 25px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Enhanced Recent Activity */
        .recent-activity {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 35px;
        }

        .section-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-header h3 {
            color: var(--dark);
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .view-all {
            color: var(--secondary);
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .activity-list {
            list-style: none;
            padding: 0;
        }

        .activity-item {
            padding: 18px 0;
            border-bottom: 1px solid #ecf0f1;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: background 0.3s;
        }

        .activity-item:hover {
            background: #f8f9fa;
            border-radius: 8px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .activity-icon.success {
            background: var(--success);
        }

        .activity-icon.warning {
            background: var(--warning);
        }

        .activity-icon.danger {
            background: var(--danger);
        }

        .activity-icon.info {
            background: var(--secondary);
        }

        .activity-icon.purple {
            background: #9b59b6;
        }

        .activity-content {
            flex: 1;
        }

        .activity-content p {
            margin: 0;
            color: var(--dark);
            font-weight: 500;
        }

        .activity-time {
            font-size: 0.8rem;
            color: #7f8c8d;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .activity-user {
            font-weight: 600;
            color: var(--secondary);
        }

        /* Enhanced Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .action-btn {
            background: white;
            border: 2px dashed #bdc3c7;
            padding: 25px 20px;
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--dark);
            text-decoration: none;
            display: block;
        }

        .action-btn:hover {
            border-color: var(--secondary);
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .action-btn i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--secondary);
        }

        .action-btn .btn-text {
            font-weight: 600;
            font-size: 1rem;
        }

        .action-btn .btn-desc {
            font-size: 0.8rem;
            color: #7f8c8d;
            margin-top: 5px;
        }

        /* System Status */
        .system-status {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .status-item {
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            background: #f8f9fa;
        }

        .status-item.online {
            border-left: 4px solid var(--success);
        }

        .status-item.offline {
            border-left: 4px solid var(--danger);
        }

        .status-item.warning {
            border-left: 4px solid var(--warning);
        }

        .status-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .status-dot.online {
            background: var(--success);
        }

        .status-dot.offline {
            background: var(--danger);
        }

        .status-dot.warning {
            background: var(--warning);
        }

        /* Responsive Enhancements */
        @media (max-width: 1200px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -280px;
                z-index: 1000;
            }

            .sidebar.active {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .menu-toggle {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1001;
                background: var(--secondary);
                color: white;
                border: none;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
            }
        }

        /* New Elements */
        .menu-toggle {
            display: none;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Mobile Menu Toggle -->
    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Overlay for Mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Enhanced Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-laptop-code"></i> Inventory Lab</h3>
            <div class="subtitle">Management System</div>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-desktop"></i> Manajemen Perangkat <span class="menu-badge">142</span></a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> Jadwal Lab <span class="menu-badge">8</span></a></li>
            <li><a href="#"><i class="fas fa-wrench"></i> Perawatan <span class="menu-badge">14</span></a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i> Laporan & Analytics</a></li>
            <li><a href="#"><i class="fas fa-users"></i> Manajemen User <span class="menu-badge">156</span></a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Pengaturan Sistem</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Enhanced Main Content -->
    <div class="main-content">
        <!-- Enhanced Header -->
        <div class="header">
            <h1><i class="fas fa-tachometer-alt"></i> Dashboard Administrator</h1>
            <div class="user-info">
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-count">3</span>
                </div>
                <span>Hai, Administrator!</span>
                <div class="user-avatar">A</div>
            </div>
        </div>

        <!-- Enhanced Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-desktop"></i></div>
                <h3>Total Perangkat</h3>
                <div class="value">142</div>
                <div class="trend up"><i class="fas fa-arrow-up"></i> 12% dari bulan lalu</div>
            </div>
            <div class="stat-card success">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <h3>Perangkat Aktif</h3>
                <div class="value">128</div>
                <div class="trend">90% operational</div>
            </div>
            <div class="stat-card warning">
                <div class="stat-icon"><i class="fas fa-tools"></i></div>
                <h3>Dalam Perbaikan</h3>
                <div class="value">8</div>
                <div class="trend up"><i class="fas fa-arrow-up"></i> 2 dari kemarin</div>
            </div>
            <div class="stat-card danger">
                <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <h3>Perangkat Rusak</h3>
                <div class="value">6</div>
                <div class="trend down"><i class="fas fa-arrow-down"></i> 1 diperbaiki</div>
            </div>
        </div>

        <!-- Enhanced Charts Section -->
        <div class="charts-grid">
            <div class="chart-container">
                <h3><i class="fas fa-chart-bar"></i> Penggunaan Lab (Minggu Ini)</h3>
                <canvas id="usageChart"></canvas>
            </div>
            <div class="chart-container">
                <h3><i class="fas fa-chart-pie"></i> Status Perangkat</h3>
                <canvas id="deviceStatusChart"></canvas>
            </div>
        </div>

        <!-- Enhanced Quick Actions -->
        <div class="quick-actions">
            <a href="#" class="action-btn">
                <i class="fas fa-plus-circle"></i>
                <div class="btn-text">Tambah Perangkat</div>
                <div class="btn-desc">Tambah perangkat baru ke inventory</div>
            </a>
            <a href="#" class="action-btn">
                <i class="fas fa-calendar-check"></i>
                <div class="btn-text">Approve Booking</div>
                <div class="btn-desc">8 booking menunggu persetujuan</div>
            </a>
            <a href="#" class="action-btn">
                <i class="fas fa-file-export"></i>
                <div class="btn-text">Generate Laporan</div>
                <div class="btn-desc">Export data ke PDF/Excel</div>
            </a>
            <a href="#" class="action-btn">
                <i class="fas fa-user-plus"></i>
                <div class="btn-text">Tambah User</div>
                <div class="btn-desc">Buat akun baru</div>
            </a>
        </div>

        <!-- Enhanced Recent Activity -->
        <div class="recent-activity">
            <div class="section-header">
                <h3><i class="fas fa-history"></i> Aktivitas Terbaru</h3>
                <a href="#" class="view-all">Lihat Semua <i class="fas fa-chevron-right"></i></a>
            </div>
            <ul class="activity-list">
                <li class="activity-item">
                    <div class="activity-icon success">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="activity-content">
                        <p>Perbaikan <strong>PC LAB-1-05</strong> selesai</p>
                        <div class="activity-time"><i class="far fa-clock"></i> 2 menit yang lalu • <span class="activity-user">Teknisi Andi</span></div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon info">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="activity-content">
                        <p>Booking <strong>Lab 2</strong> untuk praktikum</p>
                        <div class="activity-time"><i class="far fa-clock"></i> 1 jam yang lalu • <span class="activity-user">Bu Sari</span></div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon warning">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>Monitor LAB-2-03</strong> dilaporkan rusak</p>
                        <div class="activity-time"><i class="far fa-clock"></i> 3 jam yang lalu • <span class="activity-user">Pak Budi</span></div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon danger">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>Printer LAB-1</strong> tidak dapat digunakan</p>
                        <div class="activity-time"><i class="far fa-clock"></i> 5 jam yang lalu • <span class="activity-user">Siswa Rina</span></div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon purple">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div class="activity-content">
                        <p>Maintenance berkala <strong>LAB 1</strong> selesai</p>
                        <div class="activity-time"><i class="far fa-clock"></i> Kemarin, 14:30 • <span class="activity-user">System Auto</span></div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- System Status -->
        <div class="system-status">
            <div class="section-header">
                <h3><i class="fas fa-server"></i> Status Sistem</h3>
            </div>
            <div class="status-grid">
                <div class="status-item online">
                    <div class="status-dot online"></div>
                    <strong>Web Server</strong>
                    <div>Online</div>
                </div>
                <div class="status-item online">
                    <div class="status-dot online"></div>
                    <strong>Database</strong>
                    <div>Connected</div>
                </div>
                <div class="status-item warning">
                    <div class="status-dot warning"></div>
                    <strong>Backup</strong>
                    <div>Pending</div>
                </div>
                <div class="status-item online">
                    <div class="status-dot online"></div>
                    <strong>Security</strong>
                    <div>Active</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu Toggle
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }

            menuToggle.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);

            // Enhanced Charts
            const usageCtx = document.getElementById('usageChart').getContext('2d');
            const usageChart = new Chart(usageCtx, {
                type: 'bar',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                    datasets: [{
                            label: 'LAB 1',
                            data: [65, 59, 80, 81, 56, 55],
                            backgroundColor: 'rgba(52, 152, 219, 0.8)',
                            borderColor: '#3498db',
                            borderWidth: 2,
                            borderRadius: 5,
                        },
                        {
                            label: 'LAB 2',
                            data: [45, 70, 60, 75, 65, 50],
                            backgroundColor: 'rgba(46, 204, 113, 0.8)',
                            borderColor: '#2ecc71',
                            borderWidth: 2,
                            borderRadius: 5,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Jam Penggunaan per Hari'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jam Penggunaan'
                            }
                        }
                    }
                }
            });

            // Enhanced Doughnut Chart
            const statusCtx = document.getElementById('deviceStatusChart').getContext('2d');
            const statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Aktif', 'Dalam Perbaikan', 'Rusak', 'Maintenance'],
                    datasets: [{
                        data: [128, 8, 6, 12],
                        backgroundColor: [
                            '#27ae60',
                            '#f39c12',
                            '#e74c3c',
                            '#3498db'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff',
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                            }
                        }
                    },
                    cutout: '65%'
                }
            });

            // Enhanced Stats Animation
            function animateValue(element, start, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    const value = Math.floor(progress * (end - start) + start);
                    element.textContent = value.toLocaleString();
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            // Animate all stat cards
            const stats = [{
                    element: document.querySelectorAll('.stat-card .value')[0],
                    start: 0,
                    end: 142
                },
                {
                    element: document.querySelectorAll('.stat-card .value')[1],
                    start: 0,
                    end: 128
                },
                {
                    element: document.querySelectorAll('.stat-card .value')[2],
                    start: 0,
                    end: 8
                },
                {
                    element: document.querySelectorAll('.stat-card .value')[3],
                    start: 0,
                    end: 6
                }
            ];

            setTimeout(() => {
                stats.forEach(stat => {
                    animateValue(stat.element, stat.start, stat.end, 1500);
                });
            }, 800);

            // Add hover effects to activity items
            const activityItems = document.querySelectorAll('.activity-item');
            activityItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>

</html>                 