// datatable-defaults.js

// Atur default global DataTables
$.extend(true, $.fn.dataTable.defaults, {
    layout: {
        topEnd: null,
        bottomStart: {
            rowClass: "row mx-2 justify-content-between",
            features: ["info"],
        },
        bottomEnd: "paging",
    },
    language: {
        zeroRecords: "Tidak ditemukan data yang sesuai",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
        infoFiltered: "(disaring dari _MAX_ total entri)",
    },
});
