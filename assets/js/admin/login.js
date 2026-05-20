function login(baseUrl) {

    let username = document.getElementById('username').value.trim();
    let password = document.getElementById('password').value.trim();

    // VALIDASI KOSONG
    if (username === "" || password === "") {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Username dan password wajib diisi!'
        });
        return;
    }

    //loading popup
    Swal.fire({
        title: 'Logging in...',
        text: 'Mohon tunggu sebentar',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(baseUrl + "index.php/api/auth/login", {
    method: "POST",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded"
    },
    body: new URLSearchParams({
        username: username,
        password: password
    })
})
.then(res => res.text())
.then(text => {
    console.log("RAW RESPONSE:", text);
    return JSON.parse(text);
})
.then(data => {

    if (data.status) {

        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil',
            text: data.message,
            timer: 1500,
            showConfirmButton: false
        });

        setTimeout(() => {
            if (data.role === 'admin') {
                window.location.href = baseUrl + "index.php/admin/dashboard";
            } else {
                window.location.href = baseUrl + "index.php/pelanggan/home";
            }
        }, 1500);

    } else {
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: data.message
        });
    }

})
.catch(err => {
    console.log("ERROR:", err);
    Swal.fire({
        icon: 'error',
        title: 'Server Error',
        text: 'Cek console'
    });
});

}

function logout(baseUrl) {

    fetch(baseUrl + "index.php/api/auth/logout")
    .then(res => res.json())
    .then(data => {

        console.log(data);

        if (data.status) {
            setTimeout(() => {
                window.location.href = baseUrl + "index.php/admin/login";
            }, 300);
        }

    })
    .catch(err => {
        console.log(err);
    });

}