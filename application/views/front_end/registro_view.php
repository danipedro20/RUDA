<section class="contenido">

    <form>
        <h2>Registrarse</h2>
        
        <label for="usunombre">Nombre:</label>
        <input type="text" name="usunombre"/> <br/>

        <label for="usucedula">C.I. Nro.:</label>
        <input type="number" name="usucedula"/> <br/>

        <label for="usudireccion">Direccion:</label>
        <input type="text" name="usudireccion"/> <br/>

        <label for="usutelefono">Telefono:</label>
        <input type="tel" name="usutelefono"/> <br/>

        <label for="usuemail">Email:</label>
        <input type="email" name="usuemail"/> <br/>

        <label for="usuperfil">Perfil:</label>
        <select name="usuperfil"> 
            <option value="alumno">Alumno</option>
            <option value="profesor">Profesor</option>
            <option value="admin">Administrador</option>
        </select> <br/>

        <label for="usuturno">Turno:</label>
        <select name="usuturno"> 
            <option value="Manana">Mañana</option>
            <option value="tarde">Tarde</option>
            <option value="noche">Noche</option>

        </select><br/>

        <label for="Contraseña">Contraseña</label>
        <input type="password" name="pass"/> <br/>

        <input type="submit" value="Registrame" name="submit"/>     
    </form>
</section>