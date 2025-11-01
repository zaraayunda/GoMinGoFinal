
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assetsdashboard/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assetsdashboard/css/styles.min.css') }}" />
  <style>
    .form-control.is-valid {
      border-color: #28a745;
      padding-right: calc(1.5em + 0.75rem);
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right calc(0.375em + 0.1875rem) center;
      background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
    .form-control.is-invalid {
      border-color: #dc3545;
      padding-right: calc(1.5em + 0.75rem);
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right calc(0.375em + 0.1875rem) center;
      background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
    #name-help, #email-help, #password-help, #password_confirmation-help {
      display: block;
      margin-top: 0.25rem;
    }
    #name-help:empty, #email-help:empty, #password-help:empty, #password_confirmation-help:empty {
      display: none;
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="{{ asset('assetsdashboard/images/logos/dark-logo.svg') }}" width="180" alt="">
                </a>
                <p class="text-center">GoMinGo - Platform Wisata</p>
                
                @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                <form method="POST" action="{{ route('registrasi') }}">
                  @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" 
                           aria-describedby="nameHelp" maxlength="100" required autofocus>
                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback" id="name-error"></div>
                    <small class="text-muted" id="name-help"></small>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" 
                           aria-describedby="emailHelp" maxlength="100" required>
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback" id="email-error"></div>
                    <small class="text-muted" id="email-help"></small>
                  </div>
                  <div class="mb-3">
                    <label for="role" class="form-label">Daftar Sebagai</label>
                    <select class="form-control @error('role') is-invalid @enderror" 
                            id="role" name="role" required>
                      <option value="">Pilih Role</option>
                      <option value="tempat_wisata" {{ old('role') == 'tempat_wisata' ? 'selected' : '' }}>Tempat Wisata</option>
                      <option value="tour_guide" {{ old('role') == 'tour_guide' ? 'selected' : '' }}>Tour Guide</option>
                      <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback" id="role-error"></div>
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" minlength="8" required>
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="invalid-feedback" id="password-error"></div>
                    <small class="text-muted" id="password-help">Minimal 8 karakter</small>
                  </div>
                  <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation" minlength="8" required>
                    <div class="invalid-feedback" id="password_confirmation-error"></div>
                    <small class="text-muted" id="password_confirmation-help"></small>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Sign In</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('assetsdashboard/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assetsdashboard/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script>
    $(document).ready(function() {
      // Validasi Nama
      $('#name').on('input blur', function() {
        const name = $(this).val().trim();
        const nameField = $(this);
        const errorDiv = $('#name-error');
        const helpDiv = $('#name-help');
        
        if (name.length === 0) {
          nameField.addClass('is-invalid');
          errorDiv.text('Nama harus diisi');
          helpDiv.text('');
        } else if (name.length > 100) {
          nameField.addClass('is-invalid');
          errorDiv.text('Nama maksimal 100 karakter');
          helpDiv.text('');
        } else {
          nameField.removeClass('is-invalid');
          nameField.addClass('is-valid');
          errorDiv.text('');
          helpDiv.text('');
        }
      });

      // Validasi Email
      $('#email').on('input blur', function() {
        const email = $(this).val().trim();
        const emailField = $(this);
        const errorDiv = $('#email-error');
        const helpDiv = $('#email-help');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email.length === 0) {
          emailField.addClass('is-invalid');
          errorDiv.text('Email harus diisi');
          helpDiv.text('');
        } else if (email.length > 100) {
          emailField.addClass('is-invalid');
          errorDiv.text('Email maksimal 100 karakter');
          helpDiv.text('');
        } else if (!emailRegex.test(email)) {
          emailField.addClass('is-invalid');
          errorDiv.text('Format email tidak valid');
          helpDiv.text('');
        } else {
          emailField.removeClass('is-invalid');
          emailField.addClass('is-valid');
          errorDiv.text('');
          helpDiv.text('');
        }
      });

      // Validasi Role
      $('#role').on('change blur', function() {
        const role = $(this).val();
        const roleField = $(this);
        const errorDiv = $('#role-error');
        
        if (!role) {
          roleField.addClass('is-invalid');
          errorDiv.text('Role harus dipilih');
        } else {
          roleField.removeClass('is-invalid');
          roleField.addClass('is-valid');
          errorDiv.text('');
        }
      });

      // Validasi Password
      $('#password').on('input blur', function() {
        const password = $(this).val();
        const passwordField = $(this);
        const errorDiv = $('#password-error');
        const helpDiv = $('#password-help');
        
        if (password.length === 0) {
          passwordField.addClass('is-invalid');
          errorDiv.text('Password harus diisi');
          helpDiv.text('Minimal 8 karakter');
        } else if (password.length < 8) {
          passwordField.addClass('is-invalid');
          errorDiv.text('Password minimal 8 karakter');
          helpDiv.text('Minimal 8 karakter');
        } else {
          passwordField.removeClass('is-invalid');
          passwordField.addClass('is-valid');
          errorDiv.text('');
          helpDiv.text('✓ Password valid');
          
          // Validasi ulang password confirmation
          if ($('#password_confirmation').val().length > 0) {
            $('#password_confirmation').trigger('input');
          }
        }
      });

      // Validasi Password Confirmation
      $('#password_confirmation').on('input blur', function() {
        const passwordConfirmation = $(this).val();
        const password = $('#password').val();
        const passwordConfField = $(this);
        const errorDiv = $('#password_confirmation-error');
        const helpDiv = $('#password_confirmation-help');
        
        if (passwordConfirmation.length === 0) {
          passwordConfField.addClass('is-invalid');
          errorDiv.text('Konfirmasi password harus diisi');
          helpDiv.text('');
        } else if (passwordConfirmation !== password) {
          passwordConfField.addClass('is-invalid');
          errorDiv.text('Konfirmasi password tidak cocok');
          helpDiv.text('');
        } else {
          passwordConfField.removeClass('is-invalid');
          passwordConfField.addClass('is-valid');
          errorDiv.text('');
          helpDiv.text('✓ Password cocok');
        }
      });

      // Validasi form sebelum submit
      $('form').on('submit', function(e) {
        let isValid = true;
        
        // Trigger validasi untuk semua field
        $('#name').trigger('blur');
        $('#email').trigger('blur');
        $('#role').trigger('blur');
        $('#password').trigger('blur');
        $('#password_confirmation').trigger('blur');
        
        // Cek apakah ada field yang invalid
        if ($('.is-invalid').length > 0) {
          isValid = false;
          e.preventDefault();
          $('.is-invalid').first().focus();
        }
        
        return isValid;
      });
    });
  </script>
</body>

</html>