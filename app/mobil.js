function load_data() {
  $.post(base_url + "mobil/load_data", {}, function (data) {
    console.log(data);
    $("#table").DataTable().clear().destroy();
    $("#table > tbody").html(''); // Clear the table body
    let index = 1; // Initialize index

    // Sort data based on some criteria, if needed
    // For example, you could sort by ID or date if provided

    $.each(data.mobil, function (idx, val) {
      // Create table row HTML
      let html = '<tr>';
      html += '<td>' + index + '</td>'; // Use index for numbering
      html += '<td>' + val['mobilMerk'] + '</td>';
      html += '<td>' + val['mobilModel'] + '</td>';
      html += '<td><img src="' + base_url + val['mobilFoto'] + '" width="200px"></td>'
      html += '<td>' + val['mobilKursi'] + '</td>';
      html += '<td>' + desimal(val['mobilHargaSewa']) + '</td>';
      html += '<td><span onclick="active_data(' + val['mobilId'] + ',' + val['mobilStatus'] + ')" class="badge ' + ((val['mobilStatus'] == '1') ? 'bg-success' : 'bg-danger') + '">' + ((val['mobilStatus'] == '1') ? 'Tersedia' : 'Tidak Tersedia') + '</span></td>';
      html += '<td><button class="btn btn-warning btn-sm btn-edit" onclick="edit_data(' + val['mobilId'] + ')"><i class="fas fa-edit"> </i></button></td>';
      html += '<td><button class="btn btn-danger btn-sm" onClick="hapus_data(' + val['mobilId'] + ')"><i class="fas fa-trash"></i></button></td>';
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

function reset_form() {
  $("#txmerk").val('');
  $("#txmodel").val('');
  $("#txfoto").val('');
  $("#txkursi").val('');
  $("#txhargasewa").val('');
  $("#imgPreview").attr('src', '').hide();
}

function simpan_data() {
  var formData = new FormData();
  formData.append('merk', $('#txmerk').val());
  formData.append('model', $('#txmodel').val());
  formData.append('foto', $('#txfoto')[0].files[0]);
  formData.append('kursi', $('#txkursi').val());
  formData.append('harga_sewa', $('#txhargasewa').val());

  $.ajax({
    url: base_url + 'mobil/create',
    data: formData,
    processData: false,
    contentType: false,
    dataType: 'json',
    type: 'POST',
    success: function (data) {
      if (data.status === 'success') {
        // Handle success now
        Swal.fire({
          title: 'Success!',
          text: data.msg,
          icon: 'success',
          confirmButtonText: 'OK'
        }).then(() => {
          $("#addModal").modal('hide');
          load_data(); // Muat ulang data untuk menampilkan perubahan
        });
      } else {
        // Handle error now
        Swal.fire({
          title: 'Error!',
          text: data.msg,
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      Swal.fire({
        title: 'Error!',
        text: 'An unexpected error occurred.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    }
  });
}


function desimal(input) {
  var output = input
  if (parseFloat(input)) {
    input = new String(input); // so you can perform string operations
    var parts = input.split("."); // remove the decimal part
    parts[0] = parts[0].split("").reverse().join("").replace(/(\d{3})(?!$)/g, "$1,").split("").reverse().join("");
    output = parts.join(".");
  }

  return output;
}

function imagePreview() {
  const fileInput = document.getElementById('txfoto');
  const imgPreview = document.getElementById('imgPreview');

  fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        imgPreview.src = e.target.result;
        imgPreview.style.display = 'block'; // Ensure the image is visible
      };
      reader.readAsDataURL(file);
    } else {
      imgPreview.src = '';
      imgPreview.style.display = 'none'; // Hide image if no file is selected
    }
  });
}

// Ensure the function is called when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
  imagePreview();
});


function showModal() {
  $(".btn-submit").show();
  $(".btn-update").hide();
}

function edit_data(id) {
  $.post(base_url + 'mobil/edit_table', { id: id }, function (data) {
    if (data.status === 'ok') {
      // Mengisi field form dengan data yang diterima
      $("#txmerk").val(data.data.mobil.mobilMerk);
      $("#txmodel").val(data.data.mobil.mobilModel);
      $("#txkursi").val(data.data.mobil.mobilKursi);
      $("#txhargasewa").val(data.data.mobil.mobilHargaSewa);

      // Menampilkan foto yang ada
      var fotoUrl = base_url + data.data.mobil.mobilFoto;
      $("#imgPreview").attr('src', fotoUrl).show();

      // Reset file input field
      $("#txfoto").val('');

      // Menyimpan ID untuk keperluan pengeditan
      $("#addModal").data('id', id);
      $("#addModal").modal('show');

      // Menyembunyikan tombol tambah dan menampilkan tombol edit
      $(".btn-submit").hide();
      $(".btn-update").show();
    } else {
      Swal.fire({
        title: 'Error!',
        text: data.msg,
        icon: 'error',
        confirmButtonText: 'OK'
      }).then(() => {
        $("#addModal").modal('hide');
        load_data(); // Muat ulang data untuk menampilkan perubahan
      });
    }
  }, 'json');
}

function update_data() {
  var id = $("#addModal").data('id'); // ID mobil untuk update

  // Mengumpulkan data dari form
  let carData = {
    id: id,
    mobilMerk: $("#txmerk").val(),
    mobilModel: $("#txmodel").val(),
    mobilKursi: $("#txkursi").val(),
    mobilHargaSewa: $("#txhargasewa").val()
  };

  // Check if any field is empty
  if (Object.values(carData).some(val => val === "")) {
    Swal.fire({
      title: 'Error!',
      text: 'Isi semua form terlebih dahulu',
      icon: 'error',
      confirmButtonText: 'OK'
    });
  } else {
    // Jika ada file foto yang dipilih, tambahkan file foto ke formData
    var formData = new FormData();
    formData.append('id', id);
    formData.append('mobilMerk', $("#txmerk").val());
    formData.append('mobilModel', $("#txmodel").val());
    formData.append('mobilFoto', $("#txfoto")[0].files[0]); // File foto yang dipilih
    formData.append('mobilKursi', $("#txkursi").val());
    formData.append('mobilHargaSewa', $("#txhargasewa").val());

    $.ajax({
      url: base_url + 'mobil/update_mobil', // URL endpoint untuk update data
      data: formData,
      processData: false,
      contentType: false,
      dataType: 'json',
      type: 'POST',
      success: function (data) {
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
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Swal.fire({
          title: 'Error!',
          text: 'An unexpected error occurred.',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    });
  }
}


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
      $.post(base_url + 'mobil/delete_table', { id: id }, function (data) {
        if (data.status === 'success') {
          Swal.fire({
            title: 'Berhasil!',
            text: 'Data berhasil dihapus',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then(() => {
            location.reload();
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
        text: 'Penghapusan data dibatalkan!',
        icon: 'info',
        confirmButtonText: 'OK'
      });
    }
  });
}

function active_data(id, status) {
  if (status == 1) {
    Swal.fire({
      title: 'Konfirmasi',
      text: 'Apakah anda yakin produk ini sedang tidak tersedia?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, tidak tersedia',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(base_url + 'mobil/active', { id: id }, function (data) {
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
              title: 'Gagal!',
              text: data.msg,
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
        }, 'json');
      }
    });
  } else {
    Swal.fire({
      title: 'Konfirmasi',
      text: 'Apakah anda yakin produk ini sudah tersedia?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, tersedia',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(base_url + 'mobil/active', { id: id }, function (data) {
          if (data.status === 'success') {
            Swal.fire({
              title: 'Sukses!',
              text: data.msg,
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              $("#addModal").modal('hide');
              load_data();
            });
          } else {
            Swal.fire({
              title: 'Gagal!',
              text: data.msg,
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
          location.reload();
        }, 'json');
      }
    });
  }
}
