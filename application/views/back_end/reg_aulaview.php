<section class="contenido">
   
    <form action="reg_aula.php" method="post">
        <h2>AULA</h2>
        <fieldset>
            <label for="lbl_aulanombre">Nombre: </label>
            <input type="text" name="inp_nombreaula" id="inp_nombreaula" placeholder="Nombre del Aula" required="" />

            <label for="lbl_plazaDisponible">Plaza Disponible: </label>
            <input type="number" name="inp_plazadisponible" id="inp_plazadisponible" placeholder="Ingrese un Numero" required="required"/>

            <label for="lbl_plazahabilitada">Plaza Disponible: </label>
            <input type="number" name="inp_plazahabilitada" id="inp_plazahabilitada" placeholder="Ingrese un Numero" required="required"/>

            <label for="lbl_carrera">Carrera: </label>
            <select>
                <option value="html">HTML</option>
                <option value="css">CSS</option>
                <option value="js">JavaScript</option>
                <option value="php">PHP</option>
            </select>
            
            <label for="lbl_plan">Plan de Estudio: </label>
            <select>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>

            <input type="submit" value="Guardar" />

        </fieldset>

    </form>
       
       


