function loginPelanggan(baseUrl) {

    let email = document.getElementById('email').value.trim();
    let password = document.getElementById('password').value.trim();

    if (!email || !password) {
        Swal.fire('Error', 'Email & password wajib diisi', 'error');
        return;
    }

    Swal.fire({
        title: 'Login...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    fetch(baseUrl + "index.php/api/auth/login", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            email: email,
            password: password
        })
    })
    .then(res => res.json())
    .then(data => {

        if (data.status && data.role === 'pelanggan') {

            Swal.fire('Berhasil', 'Login sukses', 'success');

            setTimeout(() => {
                window.location.href = baseUrl + "index.php/pelanggan/home";
            }, 1500);

        } else {
            Swal.fire('Gagal', data.message, 'error');
        }

    })
    .catch(err => {
        console.log(err);
        Swal.fire('Error', 'Server error', 'error');
    });

}