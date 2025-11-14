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
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #4cc9a7;
            --warning: #f9c74f;
            --danger: #f94144;
            --light: #f8f9fa;
            --dark: #2b2d42;
            --info: #4895ef;
            --sidebar: #1e293b;
            --sidebar-hover: #334155;
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

        /* Sidebar Modern */
        .sidebar {
            width: 260px;
            background: var(--sidebar);
            color: white;
            transition: all 0.3s;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);
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

        .sidebar-header .subtitle {
            font-size: 0.8rem;
            opacity: 0.7;
            margin-top: 5px;
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
            background: var(--sidebar-hover);
            color: white;
            transform: translateX(5px);
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

        .menu-badge {
            background: var(--danger);
            color: white;
            border-radius: 12px;
            padding: 4px 10px;
            font-size: 0.75rem;
            margin-left: auto;
            font-weight: 600;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 25px;
            transition: all 0.3s;
        }

        /* Header Modern */
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

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification-bell {
            position: relative;
            cursor: pointer;
            font-size: 1.3rem;
            color: var(--dark);
            transition: all 0.3s;
        }

        .notification-bell:hover {
            color: var(--primary);
            transform: scale(1.1);
        }

        .notification-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--danger);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            cursor: pointer;
        }

        /* Stats Grid Modern */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .stat-card.success::before {
            background: linear-gradient(135deg, var(--success), #38b2ac);
        }

        .stat-card.warning::before {
            background: linear-gradient(135deg, var(--warning), #f8961e);
        }

        .stat-card.danger::before {
            background: linear-gradient(135deg, var(--danger), #dc2f4f);
        }

        .stat-card h3 {
            color: #64748b;
            font-size: 0.85rem;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .stat-card .value {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 8px;
            line-height: 1;
        }

        .stat-card .trend {
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
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
            opacity: 0.1;
            color: var(--dark);
        }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .chart-container {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .chart-container h3 {
            color: var(--dark);
            margin-bottom: 20px;
            font-size: 1.1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Recent Activity Modern */
        .recent-activity {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-header h3 {
            color: var(--dark);
            font-size: 1.1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .view-all {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s;
        }

        .view-all:hover {
            gap: 8px;
        }

        .activity-list {
            list-style: none;
            padding: 0;
        }

        .activity-item {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s;
            border-radius: 10px;
            margin-bottom: 5px;
        }

        .activity-item:hover {
            background: #f8fafc;
            transform: translateX(5px);
        }

        .activity-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .activity-icon.success {
            background: linear-gradient(135deg, var(--success), #38b2ac);
        }

        .activity-icon.warning {
            background: linear-gradient(135deg, var(--warning), #f8961e);
        }

        .activity-icon.danger {
            background: linear-gradient(135deg, var(--danger), #dc2f4f);
        }

        .activity-icon.info {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .activity-content {
            flex: 1;
        }

        .activity-content p {
            margin: 0;
            color: var(--dark);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .activity-time {
            font-size: 0.8rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 4px;
        }

        .activity-user {
            font-weight: 700;
            color: var(--primary);
        }

        /* Quick Actions Modern */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .action-btn {
            background: white;
            border: 2px solid #e2e8f0;
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
            border-color: var(--primary);
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .action-btn i {
            font-size: 2.2rem;
            margin-bottom: 12px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .action-btn .btn-text {
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 5px;
        }

        .action-btn .btn-desc {
            font-size: 0.8rem;
            color: #64748b;
        }

        /* System Status Modern */
        .system-status {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .status-item {
            text-align: center;
            padding: 20px 15px;
            border-radius: 12px;
            background: #f8fafc;
            border: 2px solid transparent;
            transition: all 0.3s;
        }

        .status-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .status-item.online {
            border-color: var(--success);
        }

        .status-item.offline {
            border-color: var(--danger);
        }

        .status-item.warning {
            border-color: var(--warning);
        }

        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            box-shadow: 0 0 10px currentColor;
        }

        .status-dot.online {
            background: var(--success);
            color: var(--success);
        }

        .status-dot.offline {
            background: var(--danger);
            color: var(--danger);
        }

        .status-dot.warning {
            background: var(--warning);
            color: var(--warning);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

            .menu-toggle {
                display: block;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 1001;
                background: var(--primary);
                color: white;
                border: none;
                padding: 10px 12px;
                border-radius: 10px;
                cursor: pointer;
                box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            }
        }

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

    <!-- Modern Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-laptop-code"></i> Inventory Lab</h3>
            <div class="subtitle">Management System</div>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="/project lab komputer/manajeme perangkat.php"><i class="fas fa-desktop"></i> Manajemen Perangkat <span class="menu-badge">142</span></a></li>
            <li><a href="#"><i class="fas fa-calendar-alt"></i> Jadwal Lab <span class="menu-badge">8</span></a></li>
            <li><a href="#"><i class="fas fa-wrench"></i> Perawatan <span class="menu-badge">14</span></a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i> Laporan & Analytics</a></li>
            <li><a href="#"><i class="fas fa-users"></i> Manajemen User</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Pengaturan Sistem</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Modern Main Content -->
    <div class="main-content">
        <!-- Modern Header -->
        <div class="header">
            <h1><i class="fas fa-tachometer-alt"></i> Dashboard Administrator</h1>
            <div class="user-info">
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-count">3</span>
                </div>
                <span style="font-weight: 600;">Hai, Administrator!</span>
                <div class="user-avatar">A</div>
            </div>
        </div>

        <!-- Modern Stats Grid -->
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

        <!-- Modern Charts Section -->
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

        <!-- Modern Quick Actions -->
        <div class="quick-actions">
            <a href="#" class="action-btn">
                <i class="fas fa-plus-circle"></i>
                <div class="btn-text">Tambah Perangkat</div>
                <div class="btn-desc">Tambah perangkat baru</div>
            </a>
            <a href="#" class="action-btn">
                <i class="fas fa-calendar-check"></i>
                <div class="btn-text">Approve Booking</div>
                <div class="btn-desc">8 booking menunggu</div>
            </a>
            <a href="#" class="action-btn">
                <i class="fas fa-file-export"></i>
                <div class="btn-text">Generate Laporan</div>
                <div class="btn-desc">Export data lengkap</div>
            </a>
            <a href="#" class="action-btn">
                <i class="fas fa-user-cog"></i>
                <div class="btn-text">Kelola User</div>
                <div class="btn-desc">Manage pengguna</div>
            </a>
        </div>

        <!-- Modern Recent Activity -->
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
                        <div class="activity-time"><i class="far fa-clock"></i> 2 menit lalu • <span class="activity-user">Teknisi Andi</span></div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon info">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div class="activity-content">
                        <p>Booking <strong>Lab 2</strong> untuk praktikum</p>
                        <div class="activity-time"><i class="far fa-clock"></i> 1 jam lalu • <span class="activity-user">Bu Sari</span></div>
                    </div>
                </li>
                <li class="activity-item">
                    <div class="activity-icon warning">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>Monitor LAB-2-03</strong> dilaporkan rusak</p>
                        <div class="activity-time"><i class="far fa-clock"></i> 3 jam lalu • <span class="activity-user">Pak Budi</span></div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Modern System Status -->
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

            // Modern Charts
            const usageCtx = document.getElementById('usageChart').getContext('2d');
            const usageChart = new Chart(usageCtx, {
                type: 'bar',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                    datasets: [{
                            label: 'LAB 1',
                            data: [65, 59, 80, 81, 56, 55],
                            backgroundColor: 'rgba(67, 97, 238, 0.8)',
                            borderColor: '#4361ee',
                            borderWidth: 2,
                            borderRadius: 8,
                        },
                        {
                            label: 'LAB 2',
                            data: [45, 70, 60, 75, 65, 50],
                            backgroundColor: 'rgba(76, 201, 167, 0.8)',
                            borderColor: '#4cc9a7',
                            borderWidth: 2,
                            borderRadius: 8,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });

            // Modern Doughnut Chart
            const statusCtx = document.getElementById('deviceStatusChart').getContext('2d');
            const statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Aktif', 'Dalam Perbaikan', 'Rusak', 'Maintenance'],
                    datasets: [{
                        data: [128, 8, 6, 12],
                        backgroundColor: [
                            '#4cc9a7',
                            '#f9c74f',
                            '#f94144',
                            '#4361ee'
                        ],
                        borderWidth: 3,
                        borderColor: '#ffffff',
                        hoverOffset: 20
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    },
                    cutout: '65%'
                }
            });

            // Stats Animation
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

            // Animate stats
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
                stats.forEach((stat, index) => {
                    setTimeout(() => {
                        animateValue(stat.element, stat.start, stat.end, 1500);
                    }, index * 200);
                });
            }, 500);
        });
    </script>
</body>

</html>