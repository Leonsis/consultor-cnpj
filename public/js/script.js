var mainInput = document.getElementById('mainInput');

mainInput.addEventListener('input', function (e) {
    
    var valor = e.target.value.replace(/\D/g, '');

    if (valor.length > 14) {
        valor = valor.slice(0, 14);
    }        

    if (valor.length > 11) {               
        valor = valor.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2}).*/, "$1.$2.$3/$4-$5");
    } else { 
        valor = valor.replace(/^(\d{3})(\d{3})(\d{3})(\d{2}).*/, "$1.$2.$3-$4");
    }
    e.target.value = valor;
});

