function registerPelanggan(baseUrl) {


    let nama = document.getElementById('nama').value.trim();
    let alamat = document.getElementById('alamat').value.trim();
    let no_hp = document.getElementById('no_hp').value.trim();
    let email = document.getElementById('email').value.trim();
    let username = document.getElementById('username').value.trim();
    let password = document.getElementById('password').value.trim();

    if (!nama || !username || !password) {
        Swal.fire('Error', 'Wajib isi data', 'error');
        return;
    }

    Swal.fire({
        title: 'Loading...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    fetch(baseUrl + "index.php/api/auth/register", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            nama, alamat, no_hp, email, username, password
        })
    })
    .then(res => res.json())
    .then(data => {

        if (data.status) {
            Swal.fire('Berhasil', data.message, 'success');

            setTimeout(() => {
                window.location.href = baseUrl + "index.php/pelanggan/login";
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