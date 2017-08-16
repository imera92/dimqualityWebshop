$(document).ready(function(){
    $('#cancel-button').addClass("btn-danger");
    $('#form-button-save').addClass("btn-success");
    $('.form-field-box').addClass("form-group");
    $(".form-input-box input").addClass("form-control");
    $('#save-and-go-back-button').addClass("btn-info");
    $('.box-content').addClass('container'); 
    $('#field-nombre').keydown(function (e) {
        // Permitir: space, backspace, delete, tab, escape, enter, guion y .
        if ($.inArray(e.keyCode, [32, 46, 8, 9, 27, 13, 110, 173, 189, 190]) !== -1 ||
            // Permitir: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: Ctrl/cmd+F5
            (e.keyCode == 116 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: F5
            (e.keyCode == 116) ||
            // Permitir: home, end, left, up, right
            (e.keyCode >= 35 && e.keyCode <= 39) ||
            // Permitir: ñ
            (e.keyCode == 0)) {
            // No hacer nada, dejar que las teclas puedan se presionadas
            return;
         }
         if (((e.keyCode < 48 || e.keyCode > 90) && (e.keyCode < 96 || e.keyCode > 105)) || e.keyCode == 61) {
            e.preventDefault();
        }
    });
    $('#field-categoria').keydown(function (e) {
        // Permitir: backspace, delete, tab, escape, enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            // Permitir: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: Ctrl/cmd+F5
            (e.keyCode == 116 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: F5
            (e.keyCode == 116) ||
            // Permitir: home, end, left, up, right
            (e.keyCode >= 35 && e.keyCode <= 39) ||
            // Permitir: ñ
            (e.keyCode == 0)) {
            // No hacer nada, dejar que las teclas puedan se presionadas
            return;
        }
        if (e.keyCode < 65 || e.keyCode > 90 || e.keyCode == 61) {
            e.preventDefault();
        }
    });
    $('#field-codigo').keydown(function (e) {
        // Permitir: space, backspace, delete, tab, escape, enter, guion y .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 173, 189, 190]) !== -1 ||
            // Permitir: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: Ctrl/cmd+F5
            (e.keyCode == 116 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: F5
            (e.keyCode == 116) ||
            // Permitir: home, end, left, up, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // No hacer nada, dejar que las teclas puedan se presionadas
            return;
         }
         if (e.shiftKey || ((e.keyCode < 48 || e.keyCode > 90) && (e.keyCode < 96 || e.keyCode > 105)) || e.keyCode == 61) {
            e.preventDefault();
        }
    });
    $('#field-pvp').keydown(function (e) {
        // Permitir: backspace, delete, tab, escape, enter y .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Permitir: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: Ctrl/cmd+F5
            (e.keyCode == 116 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Permitir: F5
            (e.keyCode == 116) ||
            // Permitir: home, end, left, up, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // No hacer nada, dejar que las teclas puedan se presionadas
            return;
        }
        if (e.shiftKey || ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105)) || e.keyCode == 61 || e.keyCode == 0 || e.keyCode == 191) {
            e.preventDefault();
        }
    });
    $(".chosen-search").remove();
    if ($('div[id = field-estado]').html() == '1') {
        $('div[id = field-estado]').html('Activo');
    } else {
        $('div[id = field-estado]').html('Inactivo');
    }
    if ($('div[id = field-destacado]').html() == '1') {
        $('div[id = field-destacado]').html('Destacado');
    } else {
        $('div[id = field-destacado]').html('No Destacado');
    }
    if ($('div[id = field-stock]').html() == '&nbsp;') {
        $('div[id = field-stock]').html('0');
    }
});