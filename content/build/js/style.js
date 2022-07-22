$(document).ready(function () {
  $('[data-bs-toggle="tooltip"]').tooltip();
	$('[data-bs-toggle="popover"]').popover();
  $('.visitor').select2({
    placeholder: "Choose"
  });
  $(".clock").datetimepicker({
		lang: "en",
		timepicker: false,
		format: "Y-m-d",
		formatDate: "Y-m-d",
		scrollMonth: false,
	});
  $('.btn-close').click(function (e) { 
    e.preventDefault();
    $(".modal").remove();
		$(".modal-backdrop").remove();
		$("body").removeClass("modal-open");
  });
});