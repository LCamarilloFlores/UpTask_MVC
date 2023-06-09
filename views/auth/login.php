<div class="contenedor login">
    
<?php include_once __DIR__.'/../templates/nombre-sitio.php';?>

<div class="contenedor-sm">
    <p class="descripcion-pagina">Iniciar Sesión</p>

    <?php include_once __DIR__.'/../templates/alertas.php';?>

    <form action="/" method="POST" class="formulario">
        
        <div class="campo">
            <label for="email">Correo: </label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                placeholder="Tu Correo"
            >
        </div>

        <div class="campo">
            <label for="password">Password: </label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                placeholder="Tu Password"
            >
        </div>

        <input type="submit" class="boton" value="Iniciar Sesión">
    </form>
    <div class="acciones">
        <a href="/crear">¿Aún no tienes una cuenta? Crea Una</a>
        <a href="/forgot">¿Olvidaste tu password?</a>
    </div>
</div><!-- Contenedor SM -->

</div>
