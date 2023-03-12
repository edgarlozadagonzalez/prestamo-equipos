<div class="form-group">
    <label>Número de identificación <font color="red">(*)</font></label>
    <input type="number" class="form-control" name="cod_per" <?php $validador->mostrar_cod_per()?>>
    <?php
    $validador->mostrar_error_cod_per();
    ?>
</div>
<div class="form-group">
    <label>Primer nombre <font color="red">(*)</font></label>
    <input type="text" class="form-control" name="pri_nombre"<?php $validador->mostrar_pri_nombre()?>>
    <?php
    $validador->mostrar_error_pri_nombre();
    
    ?>
</div>
<div class="form-group">
    <label>Segundo nombre</label>
    <input type="text" class="form-control" name="seg_nombre"<?php $validador->mostrar_seg_nombre()?>>
    <?php
    $validador->mostrar_error_seg_nombre();
    ?>
</div>
<div class="form-group">
    <label>Tercer nombre</label>
    <input type="text" class="form-control" name="ter_nombre"<?php $validador->mostrar_ter_nombre()?>>
    <?php
    $validador->mostrar_error_ter_nombre();
    ?>
</div>
<div class="form-group">
    <label>Primer apellido <font color="red">(*)</font></label>
    <input type="text" class="form-control" name="pri_apellido"<?php $validador->mostrar_pri_apellido()?>>
    <?php
    $validador->mostrar_error_pri_apellido();
    ?>
</div>
<div class="form-group">
    <label>Segundo apellido <font color="red">(*)</font></label>
    <input type="text" class="form-control" name="seg_apellido"<?php $validador->mostrar_seg_apellido()?>>
    <?php
    $validador->mostrar_error_seg_apellido();
    ?>
</div>
<div class="form-group">
    <label>Fecha de nacimiento <font color="red">(*)</font></label>
    <input type="date" class="form-control" name="fecha_nac"<?php $validador->mostrar_fecha()?>>
    <?php
    $validador->mostrar_error_fecha();
    ?>
</div>
<div class="form-group">
    <label>E-mail <font color="red">(*)</font></label>
    <input type="email" class="form-control" name="email" placeholder="example@email.com"<?php $validador->mostrar_email()?>>
    <?php
    $validador->mostrar_error_email();
    ?>
</div>
<div class="form-group">
    <label>Contraseña <font color="red">(*)</font></label>
    <input type="password" class="form-control" name="password1">
    <?php
    $validador->mostrar_error_password1();
    ?>
</div>
<div class="form-group">
    <label>Repite la contraseña <font color="red">(*)</font></label>
    <input type="password" class="form-control" name="password2">
    <?php
    $validador->mostrar_error_password2();
    ?>
</div>
<div class="form-group">
    <label>Teléfono <font color="red">(*)</font></label>
    <input type="number" class="form-control" name="telefono"<?php $validador->mostrar_telefono()?>>
    <?php
    $validador->mostrar_error_telefono();
    ?>
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
    <?php
    $validador->mostrar_error_cod_rol();
    ?>
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
    <?php
    $validador->mostrar_error_cod_fac();
    ?>
</div>
<button type="reset" class="btn btn-default btn-primary" >Limpiar formulario</button>
<button type="submit" class="btn btn-default btn-primary" name="registro">Enviar datos</button>