<div class="contenedor reset">
    
<?php include_once __DIR__.'/../templates/nombre-sitio.php';?>

<div class="contenedor-sm">
    <p class="descripcion-pagina">Coloca tu nuevo password</p>

    <form action="/reset" method="POST" class="formulario">
        
        <div class="campo">
            <label for="password">Nuevo Password: </label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                placeholder="Nuevo Password"
            >
        </div>

        <input type="submit" class="boton" value="Reestablecer Password">
    </form>
    <div class="acciones">
        <a href="/crear">¿Aún no tienes una cuenta? Crea Una</a>
        <a href="/">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
</div><!-- Contenedor SM -->

</div>
