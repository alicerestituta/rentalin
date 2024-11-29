function calculateTotal() {
    const pricePerDay = parseFloat(document.getElementById('pricePerDay').value);
    const startDate = document.getElementById('txtanggalsewa').value;
    const endDate = document.getElementById('txtanggalkembali').value;
    const amountField = document.getElementById('txjumlahbayar');

    // Reset jumlah bayar jika salah satu tanggal tidak diisi
    if (!startDate || !endDate) {
        amountField.value = 0;
        return;
    }

    const start = new Date(startDate);
    const end = new Date(endDate);
    const timeDiff = end - start;
    const daysDiff = timeDiff / (1000 * 3600 * 24); // Menghitung selisih hari

    // Jika tanggal kembali sama dengan tanggal sewa atau sebelum tanggal sewa
    if (daysDiff <= 0) {
        Swal.fire({
            title: 'Tanggal tidak valid!',
            text: 'Tanggal kembali harus lebih dari tanggal sewa',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        amountField.value = 0; // Reset jumlah bayar
        return;
    }

    // Menghitung total biaya
    const totalAmount = daysDiff * pricePerDay; // Menghitung total biaya
    amountField.value = totalAmount; // Update input jumlah bayar
}

// function kirim() {
//     simpan_data(function(success) {
//         if (success) {
//             kirim_email();
//         } else {
//             Swal.fire({
//                 title: "Error!",
//                 text: "Gagal menyimpan data, coba lagi!",
//                 icon: "error",
//                 confirmButtonText: "OK",
//             });
//         }
//     });
// }

function simpan_data() {
    let nama = $("#txnama").val();
    let email = $("#txemail").val();
    let mobilId = $("#txmobilid").val();
    let nomor_ktp = $("#txnomorktp").val();
    let nomor_telepon = $("#txnomortelepon").val();
    let alamat = $("#txalamat").val();
    let tanggal_sewa = $("#txtanggalsewa").val();
    let tanggal_kembali = $("#txtanggalkembali").val();
    let jumlah_bayar = $("#txjumlahbayar").val();

    if (
        nama === "" ||
        email === "" ||
        mobilId === "" ||
        nomor_ktp === "" ||
        nomor_telepon === "" ||
        alamat === "" ||
        tanggal_sewa === "" ||
        tanggal_kembali === ""
        // jumlah_bayar === ""
    ) {
        Swal.fire({
            title: "Error!",
            text: "Isi semua form terlebih dahulu!",
            icon: "error",
            confirmButtonText: "OK",
        });
    } else {
        $.post(base_url + "form/create",
            {
                txnama: nama,
                txemail: email,
                txmobilid: mobilId,
                txnomorktp: nomor_ktp,
                txnomortelepon: nomor_telepon,
                txalamat: alamat,
                txtanggalsewa: tanggal_sewa,
                txtanggalkembali: tanggal_kembali,
                txjumlahbayar: jumlah_bayar,
            },
            function (data) {
                console.log(data); 
                if (data.status === "error") {
                    Swal.fire({
                        title: "Error!",
                        text: data.msg,
                        icon: "error",
                        confirmButtonText: "Periksa",
                    });
                } else {
                    kirim_email(data.no_tran, email)
                    Swal.fire({
                        title: "Success!",
                        text: data.msg,
                        icon: "success",
                        confirmButtonText: "Kembali",
                        allowOutsideClick: false,
                        willClose: () => {
                            window.location.href = base_url + "user/riwayat"; 
                        }
                    });
                }
            },
            "json"
        );        
    }
    
}

function kirim_email(no_tran, email) {
    $.post(base_url + "form/tes_email", {no_tran:no_tran, email:email}, function(data){
    }, 'json');
}


$(document).ready(function () {
    // Ketika input dengan class 'angka' fokus, aluenya diselect semua
    $("body").on('focus', '.angka', function (e) {
        $(this).select();
    });

    $(".angka").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter, dan . (koma)
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190, 107, 189]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) || // Ctrl+A
            (e.keyCode == 67 && e.ctrlKey === true) || // Ctrl+C
            (e.keyCode == 88 && e.ctrlKey === true) || // Ctrl+X
            (e.keyCode >= 35 && e.keyCode <= 39)) { // home, end, left, right
            return; // biarkan berjalan
        }
        // Pastikan bahwa itu adalah angka dan hentikan keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
