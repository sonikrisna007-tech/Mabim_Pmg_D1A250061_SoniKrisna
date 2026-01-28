/**
 * JavaScript pikeun halaman login Pacilcom
 * Ngatur validasi formulir jeung interaksi pangguna
 */

// Tunggu halaman asup sapinuhna
document.addEventListener('DOMContentLoaded', function () {
  // Nyokot formulir login
  const loginForm = document.querySelector('.login-class form');

  // Nyokot input fields
  const usernameInput = document.querySelector('input[name="name"]');
  const passwordInput = document.querySelector('input[name="password"]');
  const submitButton = document.querySelector('input[type="submit"]');

  /**
   * Fungsi pikeun nampilkeun pesan error
   * @param {HTMLElement} inputElement - Input field nu aya masalah
   * @param {string} message - Pesan error nu bakal ditampilkeun
   */
  function showError(inputElement, message) {
    // Hapus pesan error saméméhna
    hideError(inputElement);

    // Nyieun elemen pikeun pesan error
    const errorElement = document.createElement('div');
    errorElement.className = 'error-message';
    errorElement.textContent = message;
    errorElement.style.color = '#e74c3c';
    errorElement.style.fontSize = '0.9rem';
    errorElement.style.marginTop = '5px';
    errorElement.style.marginBottom = '10px';

    // Nambahkeun error message sanggeus input field
    inputElement.parentNode.insertBefore(errorElement, inputElement.nextSibling);

    // Nambahkeun kelas error ka input field
    inputElement.classList.add('error');
    inputElement.style.borderColor = '#e74c3c';
  }

  /**
   * Fungsi pikeun nyumputkeun pesan error
   * @param {HTMLElement} inputElement - Input field nu error-na bakal dihapus
   */
  function hideError(inputElement) {
    // Nyokot error message nu aya
    const errorElement = inputElement.parentNode.querySelector('.error-message');

    // Hapus error message lamun aya
    if (errorElement) {
      errorElement.remove();
    }

    // Hapus kelas error ti input field
    inputElement.classList.remove('error');
    inputElement.style.borderColor = '#e0e0e0';
  }

  /**
   * Fungsi pikeun validasi username
   * @param {string} username - Username nu bakal divalidasi
   * @returns {boolean} - True lamun valid, false lamun teu valid
   */
  function validateUsername(username) {
    // Cek lamun username kosong
    if (!username.trim()) {
      showError(usernameInput, 'Username teu kenging kosong!');
      return false;
    }

    // Cek lamun username kurang ti 3 karakter
    if (username.length < 3) {
      showError(usernameInput, 'Username kedah sahenteuna 3 karakter!');
      return false;
    }

    // Cek lamun username leuwih ti 20 karakter
    if (username.length > 20) {
      showError(usernameInput, 'Username teu tiasa langkung ti 20 karakter!');
      return false;
    }

    // Hapus error lamun valid
    hideError(usernameInput);
    return true;
  }

  /**
   * Fungsi pikeun validasi password
   * @param {string} password - Password nu bakal divalidasi
   * @returns {boolean} - True lamun valid, false lamun teu valid
   */
  function validatePassword(password) {
    // Cek lamun password kosong
    if (!password.trim()) {
      showError(passwordInput, 'Password teu kenging kosong!');
      return false;
    }

    // Cek lamun password kurang ti 6 karakter
    if (password.length < 6) {
      showError(passwordInput, 'Password kedah sahenteuna 6 karakter!');
      return false;
    }

    // Hapus error lamun valid
    hideError(passwordInput);
    return true;
  }

  /**
   * Fungsi pikeun nangtukeun loading state tombol
   * @param {boolean} isLoading - Nangtukeun lamun keur loading atawa henteu
   */
  function setLoading(isLoading) {
    if (isLoading) {
      // Simpen teks asli tombol
      submitButton.dataset.originalText = submitButton.value;

      // Ganti teks tombol
      submitButton.value = 'Keur Login...';

      // Nonaktifkeun tombol
      submitButton.disabled = true;
      submitButton.style.opacity = '0.7';
      submitButton.style.cursor = 'not-allowed';
    } else {
      // Balikkeun teks asli tombol
      if (submitButton.dataset.originalText) {
        submitButton.value = submitButton.dataset.originalText;
      }

      // Aktifkeun deui tombol
      submitButton.disabled = false;
      submitButton.style.opacity = '1';
      submitButton.style.cursor = 'pointer';
    }
  }

  /**
   * Fungsi pikeun simulasi login
   * @param {string} username - Username nu asup
   * @param {string} password - Password nu asup
   */
  function simulateLogin(username, password) {
    // Tampilkeun loading state
    setLoading(true);

    // Simulasi request API kalawan setTimeout
    setTimeout(() => {
      // Conto validasi login (dina prakna, ieu bakal diganti ku request API sabenerna)
      if (username === 'admin' && password === 'password123') {
        // Login suksés
        showSuccessMessage('Login suksés! Keur muka halaman...');

        // Redirect ka halaman séjén (conto)
        setTimeout(() => {
          window.location.href = 'dashboard.html';
        }, 1500);
      } else {
        // Login gagal
        showError(submitButton, 'Username atawa password salah!');
        setLoading(false);

        // Guncang formulir pikeun efek visual
        loginForm.style.animation = 'shake 0.5s';
        setTimeout(() => {
          loginForm.style.animation = '';
        }, 500);
      }
    }, 2000); // Simulasi waktu loading 2 detik
  }

  /**
   * Fungsi pikeun nampilkeun pesan suksés
   * @param {string} message - Pesan suksés nu bakal ditampilkeun
   */
  function showSuccessMessage(message) {
    // Nyieun elemen pikeun pesan suksés
    const successElement = document.createElement('div');
    successElement.className = 'success-message';
    successElement.textContent = message;
    successElement.style.color = '#2ecc71';
    successElement.style.fontSize = '1rem';
    successElement.style.marginTop = '15px';
    successElement.style.textAlign = 'center';
    successElement.style.fontWeight = '600';
    successElement.style.padding = '10px';
    successElement.style.backgroundColor = 'rgba(46, 204, 113, 0.1)';
    successElement.style.borderRadius = '8px';

    // Nambahkeun pesan suksés di handapeun formulir
    loginForm.appendChild(successElement);
  }

  /**
   * Fungsi pikeun nangtukeun tombol Enter pikeun submit
   */
  function setupEnterKeySubmit() {
    document.addEventListener('keypress', function (event) {
      // Cek lamun tombol Enter diteken
      if (event.key === 'Enter') {
        // Cegah submit default
        event.preventDefault();

        // Trigger submit tombol
        submitButton.click();
      }
    });
  }

  /**
   * Fungsi pikeun nambahkeun animasi shake ka CSS
   */
  function addShakeAnimation() {
    // Nyieun style element pikeun animasi shake
    const style = document.createElement('style');
    style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }
        `;
    document.head.appendChild(style);
  }

  // Event listener pikeun validasi real-time username
  usernameInput.addEventListener('blur', function () {
    validateUsername(this.value);
  });

  // Event listener pikeun validasi real-time password
  passwordInput.addEventListener('blur', function () {
    validatePassword(this.value);
  });

  // Event listener pikeun formulir submit
  loginForm.addEventListener('submit', function (event) {
    // Cegah submit default
    event.preventDefault();

    // Nyokot nilai input
    const username = usernameInput.value;
    const password = passwordInput.value;

    // Validasi input
    const isUsernameValid = validateUsername(username);
    const isPasswordValid = validatePassword(password);

    // Cek lamun sadayana valid
    if (isUsernameValid && isPasswordValid) {
      // Proses login
      simulateLogin(username, password);
    } else {
      // Tampilkeun pesan error umum
      if (!isUsernameValid && !isPasswordValid) {
        showError(submitButton, 'Kedah ngeusian username jeung password!');
      }

      // Fokus ka field nu aya masalah
      if (!isUsernameValid) {
        usernameInput.focus();
      } else if (!isPasswordValid) {
        passwordInput.focus();
      }
    }
  });

  // Event listener pikeun reset error waktu input dirobah
  usernameInput.addEventListener('input', function () {
    hideError(this);
    hideError(submitButton);
  });

  passwordInput.addEventListener('input', function () {
    hideError(this);
    hideError(submitButton);
  });

  // Inisialisasi fitur tambahan
  addShakeAnimation();
  setupEnterKeySubmit();

  // Fokus otomatis ka username input waktu halaman muat
  usernameInput.focus();

  // Conto pamake: admin / password123
  console.log('Conto pamake:');
  console.log('Username: admin');
  console.log('Password: password123');
});
