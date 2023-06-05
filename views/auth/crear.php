<div class="contenedor crear">

<?php include_once __DIR__.'/../templates/nombre-sitio.php';?>

<div class="contenedor-sm">
    <p class="descripcion-pagina">Crear Cuenta</p>

    <?php include_once __DIR__."/../templates/alertas.php"; ?>
    
    <form action="/crear" method="POST" class="formulario">
    <div class="campo">
        <label for="nombre">Nombre: </label>
        <input 
            type="nombre" 
            name="nombre" 
            id="nombre" 
            placeholder="Tu Nombre"
            value="<?php echo $usuario->nombre;?>"
        >
    </div>
        <div class="campo">
            <label for="email">Correo: </label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                placeholder="Tu Correo"
                value="<?php echo $usuario->email;?>"
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

<div class="campo">
    <label for="password">Confirmar Password: </label>
    <input 
        type="password" 
        name="password2" 
        id="password2" 
        placeholder="Confirmar Password"
    >
</div>

        <input type="submit" class="boton" value="Crear Cuenta">
    </form>
    <div class="acciones">
        <a href="/">¿Ya tienes cuenta? Inicia Sesión</a>
        <a href="/forgot">¿Olvidaste tu password?</a>
    </div>
</div><!-- Contenedor SM -->

</div>