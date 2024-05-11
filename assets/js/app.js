window.addEventListener('load', ()=>{

    // # Variables login ---
    let boton = document.getElementById('formulario');
    let usuario = document.getElementById('usuario');
    let password = document.getElementById('password');
    let alert = document.getElementById('alerta');

    console.log(usuario);

    // # Recogida datos login ---
    function data() {

        // -- Validación lado del cliente
        if (usuario.value === '' || password.value === ''){
            alerta('Por favor, rellena todo los campos.');
            return;
        }
        
        let datos = new FormData();
        datos.append("usuario", usuario.value);
        datos.append("password", password.value);

        fetch('logIn.php', {
            method: 'POST',
            body: datos
        })
        
        .then(Response => {
            if (!Response.ok) {
                throw new Error('Error de red');
            }
            return Response.json();
        })
        .then(({ success }) => {
            if (success === 1) {
                location.href = 'home.php';
            } else {
                alerta();

                // location.href = 'index.php';
            }
            console.log(success);
        })
        .catch(error => {
            console.error('Ha ocurrido un error:', error);
        });
        
    }

    // # Alerta de no login --
    function alerta(mensaje) {
        alert.innerHTML = `
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Datos Incorrectos</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      `;
        
    }

    // # Evento botón login --
    boton.addEventListener('submit', (e) =>{
        e.preventDefault();

        data();
    })

});