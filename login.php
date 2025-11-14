
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventory Lab</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #8796d3ff 0%, #dad7ddff 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 900px;
            display: flex;
            overflow: hidden;
            min-height: 500px;
        }

        /* Left Side - Branding */
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .logo h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .logo p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .features {
            list-style: none;
            margin-top: 30px;
        }

        .features li {
            padding: 10px 0;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
        }

        .features li i {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Right Side - Login Form */
        .login-right {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: #2c3e50;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.9rem;
        }

        input,
        select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.3s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .login-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Demo Section */
        .demo-section {
            margin-top: 25px;
        }

        .demo-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            color: #2c3e50;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .demo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .demo-account {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 8px;
            border-left: 3px solid #667eea;
            cursor: pointer;
            transition: all 0.3s;
        }

        .demo-account:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateX(5px);
        }

        .demo-role {
            font-size: 0.8rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 4px;
        }

        .demo-credentials {
            font-family: 'Courier New', monospace;
            font-size: 0.75rem;
            color: #666;
        }

        /* Role Badges */
        .role-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            color: white;
            margin-left: 5px;
        }

        .badge-admin {
            background: #e74c3c;
        }

        .badge-guru {
            background: #f39c12;
        }

        .badge-teknisi {
            background: #3498db;
        }

        .badge-siswa {
            background: #27ae60;
        }

        /* Alert Messages */
        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            display: none;
        }

        .alert-error {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .loading {
            display: none;
            text-align: center;
            margin-top: 10px;
        }

        .loading-spinner {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #667eea;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-right: 10px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 400px;
            }

            .login-left {
                padding: 30px;
            }

            .demo-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <!-- Left Side - Branding -->
        <div class="login-left">
            <div class="logo">
                <i class="fas fa-laptop-code"></i>
                <h1>Inventory Lab</h1>
                <p>Sistem Manajemen Laboratorium Komputer</p>
            </div>
            <ul class="features">
                <li><i class="fas fa-check-circle"></i> Kelola perangkat lab</li>
                <li><i class="fas fa-check-circle"></i> Booking jadwal praktikum</li>
                <li><i class="fas fa-check-circle"></i> Monitoring penggunaan</li>
                <li><i class="fas fa-check-circle"></i> Laporan otomatis</li>
            </ul>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-right">
            <div class="login-header">
                <h2>Masuk ke Sistem</h2>
                <p>Pilih role dan masukkan kredensial Anda</p>
            </div>

            <!-- Alert Messages -->
            <div class="alert alert-error" id="errorAlert">
                <i class="fas fa-exclamation-circle"></i> <span id="errorMessage"></span>
            </div>

            <div class="alert alert-success" id="successAlert">
                <i class="fas fa-check-circle"></i> <span id="successMessage"></span>
            </div>

            <form id="loginForm" action="auth.php" method="POST">
                <div class="form-group">
                    <label for="role"><i class="fas fa-user-tag"></i> Login Sebagai:</label>
                    <select id="role" name="role" required>
                        <option value="">Pilih Role</option>
                        <option value="admin">Administrator</option>
                        <option value="teacher">Guru</option>
                        <option value="technician">Teknisi</option>
                        <option value="student">Siswa</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="username"><i class="fas fa-user"></i> Username:</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password:</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="login-btn" id="loginBtn">
                    <i class="fas fa-sign-in-alt"></i> MASUK SISTEM
                </button>

                <div class="loading" id="loading">
                    <div class="loading-spinner"></div>
                    <span>Memproses login...</span>
                </div>
            </form>

            <div class="demo-section">
                <div class="demo-header">
                    <i class="fas fa-key"></i>
                    <span>Akun Demo (Klik untuk auto-isi):</span>
                </div>
                <div class="demo-grid">
                    <div class="demo-account" onclick="fillCredentials('admin', 'password', 'admin')">
                        <div class="demo-role">Administrator <span class="role-badge badge-admin">Admin</span></div>
                        <div class="demo-credentials">admin / password</div>
                    </div>
                    <div class="demo-account" onclick="fillCredentials('guru', 'password', 'teacher')">
                        <div class="demo-role">Guru <span class="role-badge badge-guru">Guru</span></div>
                        <div class="demo-credentials">guru / password</div>
                    </div>
                    <div class="demo-account" onclick="fillCredentials('teknisi', 'password', 'technician')">
                        <div class="demo-role">Teknisi <span class="role-badge badge-teknisi">Teknisi</span></div>
                        <div class="demo-credentials">teknisi / password</div>
                    </div>
                    <div class="demo-account" onclick="fillCredentials('siswa', 'password', 'student')">
                        <div class="demo-role">Siswa <span class="role-badge badge-siswa">Siswa</span></div>
                        <div class="demo-credentials">siswa / password</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function fillCredentials(username, password, role) {
            document.getElementById('username').value = username;
            document.getElementById('password').value = password;
            document.getElementById('role').value = role;
        }

        function showError(message) {
            const errorAlert = document.getElementById('errorAlert');
            const errorMessage = document.getElementById('errorMessage');

            errorMessage.textContent = message;
            errorAlert.style.display = 'block';

            // Sembunyikan success alert jika ada
            document.getElementById('successAlert').style.display = 'none';

            // Auto hide setelah 5 detik
            setTimeout(() => {
                errorAlert.style.display = 'none';
            }, 5000);
        }

        function showSuccess(message) {
            const successAlert = document.getElementById('successAlert');
            const successMessage = document.getElementById('successMessage');

            successMessage.textContent = message;
            successAlert.style.display = 'block';

            // Sembunyikan error alert jika ada
            document.getElementById('errorAlert').style.display = 'none';

            // Auto hide setelah 3 detik
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 3000);
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const role = document.getElementById('role').value;
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const loginBtn = document.getElementById('loginBtn');
            const loading = document.getElementById('loading');

            // Validasi
            if (!role || !username || !password) {
                showError('Harap lengkapi semua field!');
                return;
            }

            // Tampilkan loading
            loginBtn.style.display = 'none';
            loading.style.display = 'block';

            // Submit form via AJAX
            const formData = new FormData(this);

            fetch('auth.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccess('Login berhasil! Mengalihkan...');
                        setTimeout(() => {
                            window.location.href = 'main.php?module=dashboard';
                        }, 1000);
                    } else {
                        showError(data.message || 'Login gagal!');
                        loginBtn.style.display = 'block';
                        loading.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showError('Terjadi kesalahan saat login');
                    loginBtn.style.display = 'block';
                    loading.style.display = 'none';
                });
        });

        document.getElementById('role').addEventListener('change', function() {
            const role = this.value;
            const demoAccounts = {
                'admin': 'admin',
                'teacher': 'guru',
                'technician': 'teknisi',
                'student': 'siswa'
            };

            if (demoAccounts[role]) {
                document.getElementById('username').value = demoAccounts[role];
                document.getElementById('password').value = 'password';
            }
        });

        // Check URL parameters for messages
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            const errorType = urlParams.get('error');
            const errorMessages = {
                'empty': 'Username dan password harus diisi!',
                'invalid': 'Username atau password salah!',
                'database': 'Terjadi kesalahan sistem. Silakan coba lagi.',
                'session': 'Sesi telah berakhir. Silakan login kembali.'
            };
            showError(errorMessages[errorType] || 'Terjadi kesalahan saat login');
        }

        if (urlParams.has('logout')) {
            showSuccess('Anda telah logout dari sistem');
        }

        if (urlParams.has('timeout')) {
            showError('Sesi telah timeout. Silakan login kembali.');
        }

        // Auto focus pada username field
        document.getElementById('username').focus();
    </script>
</body>

</html>