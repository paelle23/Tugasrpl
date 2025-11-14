

<div class="page-header">
    <div class="header-title">
        <h1><i class="fas fa-calendar-alt"></i> Manajemen Jadwal Lab</h1>
        <p>Kelola booking dan jadwal penggunaan laboratorium</p>
    </div>
    <div class="header-actions">
        <button class="btn btn-primary" onclick="showAddScheduleModal()">
            <i class="fas fa-plus"></i> Booking Baru
        </button>
        <button class="btn btn-warning" onclick="showPendingApprovals()">
            <i class="fas fa-clock"></i> Menunggu Approval (<span id="pendingCount"><?php echo $pendingCount; ?></span>)
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
        <h3>Booking Disetujui</h3>
        <div class="value">24</div>
        <div class="trend up"><i class="fas fa-arrow-up"></i> 5 minggu ini</div>
    </div>
    <div class="stat-card success">
        <div class="stat-icon"><i class="fas fa-clock"></i></div>
        <h3>Menunggu Approval</h3>
        <div class="value"><?php echo $pendingCount; ?></div>
        <div class="trend">Perlu tindakan</div>
    </div>
    <div class="stat-card warning">
        <div class="stat-icon"><i class="fas fa-calendar-times"></i></div>
        <h3>Ditolak</h3>
        <div class="value">3</div>
        <div class="trend down"><i class="fas fa-arrow-down"></i> 1 dari kemarin</div>
    </div>
    <div class="stat-card info">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <h3>Total Pengguna</h3>
        <div class="value">156</div>
        <div class="trend up"><i class="fas fa-arrow-up"></i> 12% bulan ini</div>
    </div>
</div>

<!-- Filter Section -->
<div class="filter-section">
    <div class="filter-group">
        <label>Lab:</label>
        <select id="labFilter">
            <option value="">Semua Lab</option>
            <option value="lab1">Lab 1</option>
            <option value="lab2">Lab 2</option>
            <option value="lab3">Lab 3</option>
        </select>
    </div>
    <div class="filter-group">
        <label>Status:</label>
        <select id="statusFilter">
            <option value="">Semua Status</option>
            <option value="approved">Disetujui</option>
            <option value="pending">Menunggu</option>
            <option value="rejected">Ditolak</option>
            <option value="cancelled">Dibatalkan</option>
        </select>
    </div>
    <div class="filter-group">
        <label>Tanggal:</label>
        <input type="date" id="dateFilter">
    </div>
    <button class="btn btn-secondary" onclick="resetFilters()">
        <i class="fas fa-refresh"></i> Reset
    </button>
</div>

<!-- Schedule Table -->
<div class="table-container">
    <div class="table-header">
        <h3><i class="fas fa-list"></i> Daftar Booking</h3>
        <div class="table-actions">
            <button class="btn btn-outline" onclick="exportSchedule()">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Booking</th>
                <th>Pemohon</th>
                <th>Lab</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Keperluan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schedules as $index => $schedule): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><strong><?php echo $schedule['booking_code']; ?></strong></td>
                    <td>
                        <div class="user-info">
                            <div class="user-avatar sm"><?php echo strtoupper(substr($schedule['username'], 0, 1)); ?></div>
                            <?php echo $schedule['full_name']; ?>
                        </div>
                    </td>
                    <td><?php echo $schedule['lab_name']; ?></td>
                    <td><?php echo date('d M Y', strtotime($schedule['schedule_date'])); ?></td>
                    <td><?php echo $schedule['start_time'] . ' - ' . $schedule['end_time']; ?></td>
                    <td><?php echo $schedule['purpose']; ?></td>
                    <td>
                        <span class="status-badge status-<?php echo $schedule['status']; ?>">
                            <?php
                            $statusText = [
                                'pending' => 'Menunggu',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                'cancelled' => 'Dibatalkan'
                            ];
                            echo $statusText[$schedule['status']];
                            ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <?php if ($schedule['status'] == 'pending'): ?>
                                <button class="btn btn-success btn-sm" onclick="approveSchedule(<?php echo $schedule['id']; ?>)">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="rejectSchedule(<?php echo $schedule['id']; ?>)">
                                    <i class="fas fa-times"></i>
                                </button>
                            <?php endif; ?>
                            <button class="btn btn-info btn-sm" onclick="viewSchedule(<?php echo $schedule['id']; ?>)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-warning btn-sm" onclick="editSchedule(<?php echo $schedule['id']; ?>)">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Calendar View -->
<div class="calendar-section">
    <div class="section-header">
        <h3><i class="fas fa-calendar"></i> Kalender Jadwal</h3>
    </div>
    <div id="scheduleCalendar"></div>
</div>

<script>
    function showAddScheduleModal() {
        // Implementation for add schedule modal
        alert('Fitur tambah jadwal akan diimplementasikan');
    }

    function showPendingApprovals() {
        document.getElementById('statusFilter').value = 'pending';
        filterSchedules();
    }

    function filterSchedules() {
        // Implementation for filtering
        const lab = document.getElementById('labFilter').value;
        const status = document.getElementById('statusFilter').value;
        const date = document.getElementById('dateFilter').value;

        // Filter logic here
        console.log('Filtering:', {
            lab,
            status,
            date
        });
    }

    function resetFilters() {
        document.getElementById('labFilter').value = '';
        document.getElementById('statusFilter').value = '';
        document.getElementById('dateFilter').value = '';
        filterSchedules();
    }

    function approveSchedule(id) {
        if (confirm('Setujui booking ini?')) {
            // AJAX call to approve
            console.log('Approving schedule:', id);
        }
    }

    function rejectSchedule(id) {
        if (confirm('Tolak booking ini?')) {
            // AJAX call to reject
            console.log('Rejecting schedule:', id);
        }
    }
</script>