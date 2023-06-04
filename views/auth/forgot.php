<div class="contenedor forgot">
    
<?php include_once __DIR__.'/../templates/nombre-sitio.php';?>

<div class="contenedor-sm">
    <p class="descripcion-pagina">Recuperar Cuenta</p>

    <form action="/forgot" method="POST" class="formulario">
        
        <div class="campo">
            <label for="email">Correo: </label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                placeholder="Tu Correo"
            >
        </div>

        <input type="submit" class="boton" value="Enviar Instrucciones">
    </form>
    <div class="acciones">
        <a href="/crear">¿Aún no tienes una cuenta? Crea Una</a>
        <a href="/">¿Ya tienes cuenta? Inicia Sesión</a>
    </div>
</div><!-- Contenedor SM -->

</div>
