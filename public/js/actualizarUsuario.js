$('#userForm').validate({
    debug: false,
    rules:{        
        apellido: {
            required: false
        },
        telefono:{
            digits: true,
            checkTelefono: true
        },
        cedula:{
            digits: true,
            checkCedula: true
        },
        correo:{
            email: false,
            checkEmail: true
        }
    },
    messages:{
        usuario: 'Ingrese un usuario',
        nombre: 'Ingrese al menos un nombre o su razón social',
        correo: {
            required:'Ingrese un correo'
        },
        cedula: {
            required: 'Ingrese un número de cédula o RUC',
            digits: 'Sólo puede ingresar dígitos en este campo'
        },
        telefono: {
            required:'Ingrese un télefono',
            digits: 'Sólo puede ingresar dígitos en este campo'
        },
        direccion: 'Ingrese su dirección'
    }
});

$.validator.addMethod('checkEmail', function(value, element) {
    return this.optional(element) || /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
}, 'Ingrese una dirección de correo válida');
$.validator.addMethod('checkCedula', function(value, element) {
    return this.optional(element) || value.length == 10 || value.length == 13;
}, 'Su número de cédula debe tener 10 dígitos y su RUC debe tener 13 dígitos');
$.validator.addMethod('checkTelefono', function(value, element) {
    return this.optional(element) || value.length == 9 || value.length == 10;
}, 'Ingrese un teléfono válido (042123456/0981234567)');

$(document).ready(function() {
    $("input[name='usuario']").keydown(function (e) {
        // Permitir: backspace, delete, tab, escape, enter, guion y .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 189, 190]) !== -1 ||
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
    $("input[name='correo']").keydown(function (e) {
        // Permitir: backspace, delete, tab, escape, enter, guion y .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 189, 190]) !== -1 ||
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
        if (((e.keyCode < 48 || e.keyCode > 90) && (e.keyCode < 96 || e.keyCode > 105)) || e.keyCode == 61) {
            e.preventDefault();
        }
    });
    $("input[name='nombre'], input[name='apellido']").keydown(function (e) {
        // Permitir: space, backspace, delete, tab, escape, enter
        if ($.inArray(e.keyCode, [32, 46, 8, 9, 27, 13, 110]) !== -1 ||
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
             // Permitir: home, end, left, up, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // No hacer nada, dejar que las teclas puedan se presionadas
                 return;
        }
        if (e.shiftKey || ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105)) || e.keyCode == 61 || e.keyCode == 0 || e.keyCode == 191) {
            e.preventDefault();
        }
    });
    $("input[name='direccion']").keydown(function (e) {
        // Permitir: space, backspace, delete, tab, escape, enter, guion y .
        if ($.inArray(e.keyCode, [32, 46, 8, 9, 27, 13, 110, 189, 190]) !== -1 ||
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
        if (((e.keyCode < 48 || e.keyCode > 90) && (e.keyCode < 96 || e.keyCode > 105)) || e.keyCode == 61) {
            e.preventDefault();
        }
    });
});