$(document).ready(function() {
    $("input[name='usuario']").keydown(function (e) {
        // Permitir: backspace, delete, tab, escape, enter, guion y .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 173, 190]) !== -1 ||
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
             // Permitir: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // No hacer nada, dejar que las teclas puedan se presionadas
                 return;
        }
        if (e.shiftKey || ((e.keyCode < 48 || e.keyCode > 90) && (e.keyCode < 96 || e.keyCode > 105)) || e.keyCode == 61) {
            e.preventDefault();
        }
    });
    $("input[name='nombre'], input[name='apellido']").keydown(function (e) {
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
             // Permitir: home, end, left, right
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
    $("input[name='cedula'], input[name='telefono']").keydown(function (e) {
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
             // Permitir: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // No hacer nada, dejar que las teclas puedan se presionadas
                 return;
        }
        if (e.shiftKey || ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105)) || e.keyCode == 61) {
            e.preventDefault();
        }
    });
    $("input[name='direccion']").keydown(function (e) {
        // Permitir: space, backspace, delete, tab, escape, enter, guion y .
        if ($.inArray(e.keyCode, [32, 46, 8, 9, 27, 13, 110, 173, 190]) !== -1 ||
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
             // Permitir: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // No hacer nada, dejar que las teclas puedan se presionadas
                 return;
        }
        if (((e.keyCode < 48 || e.keyCode > 90) && (e.keyCode < 96 || e.keyCode > 105)) || e.keyCode == 61) {
            e.preventDefault();
        }
    });
});