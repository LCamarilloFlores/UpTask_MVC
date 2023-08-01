(function () {
  //Botón para mostrar el modal de Agregar tarea
  $("#agregar-tarea").on("click", mostrarFormulario);

  function mostrarFormulario() {
    const modal = document.createElement("DIV");
    modal.classList.add("modal");
    modal.innerHTML = `
    <form class="formulario nueva-tarea">
      <legend>Añade una nueva tarea.</legend>
      <div class="campo">
          <label htmlFor="tarea">Tarea</label>
          <input 
            type="text"
            id="tarea"
            name="tarea"
            placeholder="Añadir tarea al proyecto actual"
            />
      </div>
      <div class="opciones">
        <input type="submit" class="submit-nueva-tarea" value="Agregar tarea" />
        <button type="button" class="cerrar-modal">Cancelar</button>
      </div>
    </form>
    `;
    modal.addEventListener("click", (e) => {
      let elemento = e.target.classList;
      if (elemento.contains("cerrar-modal")) {
        console.log("Es el boton de cancelar");
        $(".formulario").removeClass("animar");
        setTimeout(() => {
          modal.remove();
        }, 500);
      }
    });

    setTimeout(() => {
      $(".formulario").addClass("animar");
    }, 0);
    $("body").append(modal);
  }
})();
