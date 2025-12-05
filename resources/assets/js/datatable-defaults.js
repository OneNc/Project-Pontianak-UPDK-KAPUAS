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
window.clearFieldErrors = function (formSel = "#formMain") {
    const $form = $(formSel);
    $form.find(".is-invalid").removeClass("is-invalid");
    $form.find(".invalid-feedback").empty();
}

window.applyFieldErrors = function (errors, formSel = "#formMain") {
    const $form = $(formSel);
    let firstInvalid = null;

    Object.entries(errors || {}).forEach(([field, messages]) => {
        const $el = $form.find(`[name="${field}"]`);
        if ($el.length) {
            if (
                $el.attr("type") === "radio" ||
                $el.attr("type") === "checkbox"
            ) {
                $el.addClass("is-invalid");
                const $fb = $el
                    .closest(".mb-3, .form-group, .row, .form-floating")
                    .find(".invalid-feedback")
                    .first();
                if ($fb.length) $fb.html((messages || []).join("<br>"));
                if (!firstInvalid) firstInvalid = $el.first();
            } else {
                $el.addClass("is-invalid");
                const $fb = $el
                    .closest(".form-floating, .mb-3, .input-group")
                    .find(".invalid-feedback")
                    .first();
                if ($fb.length) $fb.html((messages || []).join("<br>"));
                if (!firstInvalid) firstInvalid = $el;
            }
        }
    });
}
window.attachInvalidReset = function (formSel) {
    const $form = $(formSel);
    $form.on(
        "focus keyup",
        'input:not([type="radio"]):not([type="checkbox"]), textarea, select',
        function () {
            $(this).removeClass("is-invalid");
        },
    );
    $form.on(
        "change",
        'input[type="radio"], input[type="checkbox"]',
        function () {
            const name = $(this).attr("name");
            $form.find(`[name="${name}"]`).removeClass("is-invalid");
        },
    );
}
