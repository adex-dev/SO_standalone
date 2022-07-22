$(document).ready(function () {
  $(".tabledummy").DataTable({
    dom: '<"col-sm-12"B><"col-sm-12 mt-2 float-start"f><"col-sm-12"p>t',
    dom: "frti",
    scrollY: 450,
    processing: true,
    serverSide: true,
    ajax: {
      url: hostname + "homeproses/gettabledummy",
      type: "POST",
    },
    lengthMenu: [
      [6000, -1],
      [6000, "All"],
    ],
    paging: true,
    ordering: false,
    scrollX: true,
    fixedColumns: {
      leftColumns: 1,
    },
    "drawCallback": function (settings) {
      $('[data-bs-toggle="tooltip"]').tooltip();
    },
    'columnDefs': [
      //hide the second & fourth column
      { 'visible': false, 'targets': [2,3] }
    ],
    fixedHeader: true,
    fixedHeader: {
      header: true,
    },
    order: [[2, 'asc']],
    rowGroup: {
      dataSrc: [2,3]
    },
    language: {
      emptyTable: "Tidak terdapat data di tabel",
      info: "",
      infoEmpty: "",
      infoFiltered: "",
      search: "<i class='fa fa-search'></i>",
      searchPlaceholder: "Search..",
      paginate: {
        next: ">",
        previous: "<<",
      },
      zeroRecords: "Tidak ditemukan data yang sesuai",
    },
    "footerCallback": function (row, data, start, end, display) {
    },
  });
  $(".tablerekap").DataTable({
    dom: '<"col-sm-12"B><"col-sm-12 mt-2 float-start"f><"col-sm-12"p>t',
    dom: "Bpfrti", 
    dom: "Blpfrt",
    scrollY: 450,
    processing: true,
    serverSide: true,
    ajax: {
      url: hostname + "homeproses/gettableinvetori",
      type: "POST",
    },
    lengthMenu: [
      [6000, -1],
      [6000, "All"],
    ],
    paging: true,
    ordering: false,
    scrollX: true,
    fixedColumns: {
      leftColumns: 1,
    },
    "drawCallback": function (settings) {
      $('[data-bs-toggle="tooltip"]').tooltip();
    },
    buttons: [
      {
        extend: "collection",
        text: "Export Data",
        className: "btn btn-sm btn-primary",
        buttons: [
          '<h3 style="color:black">Export Data</h3>',
          {
            extend: "copy",
            title: 'Rekap Data '+ storename,
            className: "btn btn-sm btn-primary",
          },
          {
            extend: "excel",
            title:'Rekap Data '+ storename,
            tag: 'button',
            header: true,
            className: "btn btn-sm btn-success",
            'targets': 2, visible: true,
             exportOptions: {
              columns: ':visible',
            }
          },
          {
            extend: 'print',
            text: 'Print',
            title: 'Rekap Data '+ storename,
            autoPrint: true,
            footer: true,
            exportOptions: {
              columns: ':visible',
            },
            customize: function (win) {
              $(win.document.body).find('table').addClass('display').css('font-size', '9px');
              $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
                $(this).css('background-color', '#D0D0D0');
              });
              $(win.document.body).find('h1').css('text-align', 'center');
            },
          }
        ],
      },
    ],
    'columnDefs': [
      //hide the second & fourth column
      { 'visible': false, 'targets': [4] }
    ],
    fixedHeader: true,
    fixedHeader: {
      header: true,
    },
    order: [[4, 'asc']],
    rowGroup: {
      dataSrc: [4]
    },
    language: {
      emptyTable: "Tidak terdapat data di tabel",
      info: "",
      infoEmpty: "",
      infoFiltered: "",
      search: "<i class='fa fa-search'></i>",
      searchPlaceholder: "Search..",
      paginate: {
        next: ">",
        previous: "<<",
      },
      zeroRecords: "Tidak ditemukan data yang sesuai",
    },
  });
  $(document).on('click', '.btnclicktable', function () {
    var isi = $(this).data('locationtujuan')
    location.href = isi
  })
  $('[data-bs-dismiss="modal"]').click(function (e) { 
    e.preventDefault();
    $(".modal").remove();
		$(".modal-backdrop").remove();
		$("body").removeClass("modal-open");
  });
});