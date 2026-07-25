<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BDE Events - Connexion</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 2.5rem 1.5rem 2rem 1.5rem;
            text-align: center;
            border-bottom-left-radius: 50% 20px;
            border-bottom-right-radius: 50% 20px;
        }

        .brand-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
            font-size: 1.5rem;
        }

        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
            border-color: #10b981;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            z-index: 10;
        }

        .btn-custom {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
            background: linear-gradient(135deg, #059669, #047857);
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-6 col-lg-4">

                <div class="card login-card">
                    <!-- Header -->
                    <div class="login-header">
                        <div class="brand-icon">
                            <i class="fa-solid fa-calendar-check text-white"></i>
                        </div>
                        <h4 class="fw-bold mb-0">BDE EVENTS</h4>
                        <p class="small text-white-50 mb-0 mt-1">Connectez-vous à votre espace</p>
                    </div>

                    <!-- Body -->
                    <div class="card-body p-4 pt-4">

                        <!-- Error Session Alert -->
                        @if(session('error'))
                            <div class="alert alert-danger border-0 rounded-3 small d-flex align-items-center mb-3" role="alert">
                                <i class="fa-solid fa-circle-exclamation me-2"></i>
                                <div>{{ session('error') }}</div>
                            </div>
                        @endif

                        <form action="{{ route('login.store') }}" method="POST">
                            @csrf

                            <!-- Email Input -->
                            <div class="mb-3">
                                <label class="form-label">Adresse Email</label>
                                <div class="input-group-custom">
                                    <i class="fa-regular fa-envelope"></i>
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="nom@exemple.com"
                                        value="{{ old('email') }}"
                                        required>
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1">
                                        <i class="fa-solid fa-triangle-exclamation me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label class="form-label">Mot de passe</label>
                                <div class="input-group-custom">
                                    <i class="fa-solid fa-lock"></i>
                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="••••••••"
                                        required>
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1">
                                        <i class="fa-solid fa-triangle-exclamation me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success btn-custom w-100 text-white">
                                Se connecter <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
