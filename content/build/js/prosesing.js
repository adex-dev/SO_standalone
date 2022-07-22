$(document).ready(function () {
	$(document).on("submit", ".importciperlab", function (e) {
		e.preventDefault();
		Swal.fire({
			backdrop: true,
			position: "center",
			icon: "info",
			title: "Proses Upload Data...",
			text: "mohon bersabar.., proses ini membutuhkan waktu yang lama.",
			showConfirmButton: false,
			allowOutsideClick: false,
			allowEscapeKey: false,
		});
		var uploadDataStok = $("input[type=file]")[0].files[0];
		var flor = $(".selectflor").val();
		var formdata = new FormData();
		formdata.append("namaflor", flor);
		formdata.append("namafile", uploadDataStok);
		$.ajax({
			type: "POST",
			url: hostname + "homeproses/insertchiperlab",
			data: formdata,
			cache: false,
			processData: false,
			contentType: false,
			dataType: "json",
			success: function (response) {
				if (response.sukses) {
					Swal.fire({
						text: response.sukses,
						icon: "success",
						showCancelButton: false,
						confirmButton: true,
					}).then(function () {
						location.reload();
					});
				} else if (response.gagal) {
					Swal.fire({
						text: response.gagal,
						icon: "error",
						showCancelButton: false,
						confirmButton: true,
					}).then(function () {
						Swal.close();
						$.ajax({
							type: "POST",
							url: hostname + "auth/hapusfile",
							data: formdata,
							cache: false,
							processData: false,
							contentType: false,
							dataType: "json",
							success: function (response) {
								Swal.close();
							},
						});
					});
				}
			},
			error: function (jqXHR, error, errorThrown) {
				if (jqXHR.status && jqXHR.status == 500) {
					Swal.fire({
						text: "Periksa Kembali isi file anda,pastikan tidak ada spesial character.",
						icon: "error",
						showCancelButton: false,
						confirmButton: true,
					}).then(function () {
						Swal.close();
						$.ajax({
							type: "POST",
							url: hostname + "auth/hapusfile",
							data: formdata,
							cache: false,
							processData: false,
							contentType: false,
							dataType: "json",
							success: function (response) {},
						});
					});
				} else {
					Swal.fire({
						text: "Periksa Kembali isi file anda,pastikan tidak ada spesial character",
						icon: "error",
						showCancelButton: false,
						confirmButton: true,
					}).then(function () {
						Swal.close();
						$.ajax({
							type: "POST",
							url: hostname + "auth/hapusfile",
							data: formdata,
							cache: false,
							processData: false,
							contentType: false,
							dataType: "json",
							success: function (response) {
								Swal.close();
							},
						});
					});
				}
			},
		});
	});

  $(".btnposserver").click(function (e) {
		e.preventDefault();
			Swal.fire({
				backdrop: true,
				position: "center",
				icon: "info",
				title: "Uploading data...",
				text: "Attention please wait.., this process takes a long time",
				showConfirmButton: false,
				allowOutsideClick: false,
				allowEscapeKey: false,
			});
      $.ajax({
        type: "GET",
        url: hostname + "homeproses/kirimdataserver",
        dataType: "json",
        success: function (response) {
          if (response.sukses) {
            Swal.fire(response.sukses, "", "info").then(function () {
              Swal.close();
              location.reload()
            });
          } else if (response.gagal) {
            Swal.fire(response.gagal, "", "error").then(function () {
              Swal.close();
            });
          }
        },
      });
	});
});
