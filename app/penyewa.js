function load_data() {
  $.post(base_url + "penyewa/load_data", {}, function (data) {
    console.log(data);
    $("#table").DataTable().clear().destroy();
    $("#table > tbody").html(''); // Clear the table body
    let index = 1; // Initialize index

    // Sort data based on some criteria, if needed
    // For example, you could sort by ID or date if provided

    $.each(data.penyewa, function (idx, val) {
      // Create table row HTML
      let html = '<tr>';
      html += '<td>' + index + '</td>'; // Use index for numbering
      html += '<td>' + val['penyewaNama'] + '</td>';
      html += '<td>' + val['penyewaEmail'] + '</td>';
      html += '<td>' + val['penyewaNoKtp'] + '</td>';
      html += '<td>' + val['penyewaTelepon'] + '</td>';
      html += '<td>' + val['penyewaAlamat'] + '</td>';
      html += '<td><button class="btn btn-warning btn-sm btn-edit" onclick="edit_data(' + val['penyewaId'] + ')"><i class="fas fa-edit"> </i></button></td>';
      html += '<td><button class="btn btn-danger btn-sm" onClick="hapus_data(' + val['penyewaId'] + ')"><i class="fas fa-trash"></i></button></td>';
      html += '</tr>';

      // Append the HTML to the table body
      $("#table > tbody").append(html);
      index++; // Increment the index for the next row
    });

    // Reinitialize DataTables
    $("#table").DataTable({
      responsive: true,
      processing: true,
      scroll: true,
      pagingType: 'first_last_numbers',
      // order: [[0, 'desc']], // Keep the order of rows in the table
      dom: "<'row'<'col-3'l><'col-9'f>>" +
        "<'row dt-row'<'col-sm-12'tr>>" +
        "<'row'<'col-4'i><'col-8'p>>",
      language: {
        info: "Page _PAGE_ of _PAGES_",
        lengthMenu: "MENU",
        search: "",
        searchPlaceholder: "Search.."
      }
    });
  }, 'json');
}



$(document).ready(function () {
  $(".btn-closed").click(function () {
    reset_form();
    $("#addModal").modal('hide');
  });

  // ketika input dengan class angka focus, maka aluenya diselect semua
  $("body").on('focus', '.angka', function (e) {
    $(this).select();
  });
  $(".angka").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and . 188 untuk koma

    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190, 107, 189]) !== -1 ||
      // Allow: Ctrl+A
      (e.keyCode == 65 && e.ctrlKey === true) ||
      // Allow: Ctrl+C
      (e.keyCode == 67 && e.ctrlKey === true) ||
      // Allow: Ctrl+X
      (e.keyCode == 88 && e.ctrlKey === true) ||
      // Allow: home, end, left, right
      (e.keyCode >= 35 && e.keyCode <= 39)) {
      // let it happen, don't do anything
      return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
  });
  load_data();
});

function showModal() {
  $(".btn-submit").show();
  $(".btn-update").hide();
}

function reset_form() {
  $("#txnama").val('');
  $("#txemail").val('');
  $("#txnomorktp").val('');
  $("#txnomortelepon").val('');
  $("#txalamat").val('');
 
}

function simpan_data() {
  let nama = $("#txnama").val();
  let email = $("#txemail").val();
  let nomor_ktp = $("#txnomorktp").val();
  let nomor_telepon = $("#txnomortelepon").val();
  let alamat = $("#txalamat").val();

  console.log({
      txnama: nama,
      txemail: email,
      txnomorktp: nomor_ktp,
      txnomortelepon: nomor_telepon,
      txalamat: alamat,
  });

  if (nama === "" || email === "" || nomor_ktp === "" || nomor_telepon === "" || alamat === "") {
      Swal.fire({
          title: 'Data Tidak Lengkap',
          text: 'Data yang dimasukkan masih belum lengkap',
          icon: 'warning',
          confirmButtonText: 'OK'
      });
  } else {
      $.post(base_url+"penyewa/create", {
        txnama: nama,
        txemail: email,
        txnomorktp: nomor_ktp,
        txnomortelepon: nomor_telepon,
        txalamat: alamat,
      }, function(data) {
          console.log(data.status);
          if (data.status === "error") {
              Swal.fire({
                  title: 'Error',
                  text: data.msg,
                  icon: 'error',
                  confirmButtonText: 'OK'
              });
          } else {
              Swal.fire({
                  title: 'Berhasil',
                  text: data.msg,
                  icon: 'success',
                  confirmButtonText: 'OK'
                }).then(() => {
                  $("#addModal").modal('hide');
                  load_data();
                });
          }
          $(".btn-submit").show();
          $(".btn-update").hide();
      }, 'json');
  }
}

function edit_data(id) {
  $.post(base_url+'penyewa/edit_table', { id: id }, function (data) {
    $("#txnama").val(data.data.penyewaNama);
    $("#txemail").val(data.data.penyewaEmail); 
    $("#txnomorktp").val(data.data.penyewaNoKtp);
    $("#txnomortelepon").val(data.data.penyewaTelepon);
    $("#txalamat").val(data.data.penyewaAlamat);
    $("#addModal").data('id', id); 
    $("#addModal").modal('show');
    $(".btn-submit").hide();
    $(".btn-update").show();
  }, 'json')
}

function update_data(){
  var id = $("#addModal").data('id');
  let penyewaNama = $("#txnama").val();
  let penyewaEmail = $("#txemail").val();
  let penyewaNoKtp = $("#txnomorktp").val();
  let penyewaTelepon = $("#txnomortelepon").val();
  let penyewaAlamat = $("#txalamat").val();
  
  if (penyewaNama === "" || penyewaEmail === "" || penyewaNoKtp === ""|| penyewaTelepon === ""|| penyewaAlamat === ""){
    Swal.fire({
      title: 'Error!',
      text: data.msg,
      icon: 'error',
      confirmButtonText: 'OK'
    })
  }else{
    $.post(base_url+'penyewa/update_table', { id: id, penyewaNama: penyewaNama, penyewaEmail: penyewaEmail, penyewaNoKtp: penyewaNoKtp, penyewaTelepon: penyewaTelepon, penyewaAlamat: penyewaAlamat}, function(data) {
      if (data.status === 'success') {
        Swal.fire({
          title: 'Success!',
          text: data.msg,
          icon: 'success',
          confirmButtonText: 'OK'
        }).then(() => {
          $("#addModal").modal('hide');
          load_data();
        });
      } else {
        Swal.fire({
          title: 'Error!',
          text: data.msg,
          icon: 'error',
          confirmButtonText: 'OK'
        })
      }
  }, 'json');
}}

function hapus_data(id) {
  Swal.fire({
    title: 'Konfirmasi!',
    text: 'Yakin ingin menghapus data?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    cancelButtonText: 'Batal',
    reverseButtons: true,
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    }
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(base_url+'penyewa/delete_table', { id: id }, function (data) {
        if (data.status === 'success') {
          Swal.fire({
            title: 'Berhasil!',
            text: 'Data berhasil dihapus',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then(() => {
            $("#addModal").modal('hide');
            load_data();
          });
        } else {
          Swal.fire({
            title: 'Error!',
            text: data.msg || 'Gagal menghapus data',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      }, 'json');
    } else {
      Swal.fire({
        title: 'Dibatalkan',
        text: 'Penghapusan data dibatalkan',
        icon: 'info',
        confirmButtonText: 'OK'
      });
    }
  });
}