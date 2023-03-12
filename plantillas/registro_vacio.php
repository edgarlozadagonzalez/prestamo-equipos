
<div class="form-group">
    <label>Número de identificación <font color="red">(*)</font></label>
    <input type="number" class="form-control" name="cod_per">
    
</div>
<div class="form-group">
    <label>Primer nombre <font color="red">(*)</font></label>
    <input type="text" class="form-control" name="pri_nombre">
</div>
<div class="form-group">
    <label>Segundo nombre</label>
    <input type="text" class="form-control" name="seg_nombre">
</div>
<div class="form-group">
    <label>Tercer nombre</label>
    <input type="text" class="form-control" name="ter_nombre">
</div>
<div class="form-group">
    <label>Primer apellido <font color="red">(*)</font></label>
    <input type="text" class="form-control" name="pri_apellido">
</div>
<div class="form-group">
    <label>Segundo apellido <font color="red">(*)</font></label>
    <input type="text" class="form-control" name="seg_apellido">
</div>
<div class="form-group">
    <label>Fecha de nacimiento <font color="red">(*)</font></label>
    <input type="date" class="form-control" name="fecha_nac">
</div>
<div class="form-group">
    <label>E-mail <font color="red">(*)</font></label>
    <input type="email" class="form-control" name="email" placeholder="example@email.com">
</div>
<div class="form-group">
    <label>Contraseña <font color="red">(*)</font></label>
    <input type="password" class="form-control" name="password1">
</div>
<div class="form-group">
    <label>Repite la contraseña <font color="red">(*)</font></label>
    <input type="password" class="form-control" name="password2">
</div>
<div class="form-group">
    <label>Teléfono <font color="red">(*)</font></label>
    <input type="number" class="form-control" name="telefono">
</div>
<div class="form-group">
    <label>Rol <font color="red">(*)</font></label>
    <select class="form-control" id="cbx_roles" name="cod_rol">
        <option value="0">Seleccionar opccion </option>
        <?php foreach($roles as $row) {?>
        <option value="<?php echo $row['cod_rol']; ?>"><?php echo $row['nombre_rol'];?>
        </option>
        <?php }?>
    </select>
</div>
<div class="form-group">
    <label>Facultad <font color="red">(*)</font></label>
    <select class="form-control" id="cbx_facultades" name="cod_fac">
        <option value="0">Seleccionar opccion </option>
        <?php foreach($facultades as $row) {?>
        <option value="<?php echo $row['cod_fac']; ?>"><?php echo $row['nombre_fac'];;?>
        </option>
        <?php }?>
    </select>
</div>
<button type="reset" class="btn btn-default btn-primary" >Limpiar formulario</button>
<button type="submit" class="btn btn-default btn-primary" name="registro">Enviar datos</button>