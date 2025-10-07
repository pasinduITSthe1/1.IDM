<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:40
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\products\occupancy.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29c105b91_38512691',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9007f3546527d8a921aba42d05ae402210714c9e' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\products\\occupancy.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29c105b91_38512691 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['product']->value->id))) {?>
    <input type="hidden" name="occupancy_loaded" value="1">
	<div id="product-occupancy" class="panel product-tab">
		<input type="hidden" name="submitted_tabs[]" value="Occupancy" />
		<h3 class="tab"> <i class="icon-users"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Occupancy'),$_smarty_tpl ) );?>
</h3>

        <div class="alert alert-info">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Below, enter the base occupancy of this room type.'),$_smarty_tpl ) );?>

            <p><b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Note'),$_smarty_tpl ) );?>
</b>: <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Minimum 1 adult is madatory in the base occupancy of the room type'),$_smarty_tpl ) );?>
</p>
        </div>

		<div class="form-group">
			<label class="control-label col-sm-2" for="base_adults">
                <span class="label-tooltip" data-toggle="tooltip"
				title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>''),$_smarty_tpl ) );?>
">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Base adults'),$_smarty_tpl ) );?>

                </span>
			</label>
			<div class="col-sm-3">
				<input id="base_adults" type="text" name="base_adults" class="form-control" value="<?php if ((isset($_POST['base_adults']))) {
echo htmlspecialchars((string)$_POST['base_adults'], ENT_QUOTES, 'UTF-8', true);
} elseif ((isset($_smarty_tpl->tpl_vars['roomTypeInfo']->value['adults']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['roomTypeInfo']->value['adults'], ENT_QUOTES, 'UTF-8', true);
} else { ?>2<?php }?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="base_children">
                <span class="label-tooltip" data-toggle="tooltip"
				title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>''),$_smarty_tpl ) );?>
">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Base children'),$_smarty_tpl ) );?>

                </span>
			</label>
			<div class="col-sm-3">
				<input id="base_children" type="text" name="base_children" class="form-control" value="<?php if ((isset($_POST['base_children']))) {
echo htmlspecialchars((string)$_POST['base_children'], ENT_QUOTES, 'UTF-8', true);
} elseif ((isset($_smarty_tpl->tpl_vars['roomTypeInfo']->value['children']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['roomTypeInfo']->value['children'], ENT_QUOTES, 'UTF-8', true);
} else { ?>0<?php }?>">
			</div>
		</div>
        <input id="is_occupancy_submit" type="hidden" name="is_occupancy_submit" class="form-control" value="0">

        <hr>

        <div class="alert alert-info">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Below, enter the maximum number of adults and children which can be accommodated in a room of this room type.'),$_smarty_tpl ) );?>

			<br>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'For maximum room occupancy, the total number of guests which can be accommodated in a room of this room type.'),$_smarty_tpl ) );?>

        </div>

        <div class="form-group">
			<label class="control-label col-sm-2" for="max_adults">
                <span class="label-tooltip" data-toggle="tooltip"
				title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter maximum number of adults can be accommodated in a room of this room type.'),$_smarty_tpl ) );?>
">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Maximum adults'),$_smarty_tpl ) );?>

                </span>
			</label>
			<div class="col-sm-3">
				<input id="max_adults" type="text" name="max_adults" class="form-control" value="<?php if ((isset($_POST['max_adults']))) {
echo htmlspecialchars((string)$_POST['max_adults'], ENT_QUOTES, 'UTF-8', true);
} elseif ((isset($_smarty_tpl->tpl_vars['roomTypeInfo']->value['max_adults']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['roomTypeInfo']->value['max_adults'], ENT_QUOTES, 'UTF-8', true);
}?>">
			</div>
		</div>
        <div class="form-group">
			<label class="control-label col-sm-2" for="max_children">
                <span class="label-tooltip" data-toggle="tooltip"
				title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter maximum number of children can be accommodated in a room of this room type.'),$_smarty_tpl ) );?>
">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Maximum children'),$_smarty_tpl ) );?>

                </span>
			</label>
			<div class="col-sm-3">
				<input id="max_children" type="text" name="max_children" class="form-control" value="<?php if ((isset($_POST['max_children']))) {
echo htmlspecialchars((string)$_POST['max_children'], ENT_QUOTES, 'UTF-8', true);
} elseif ((isset($_smarty_tpl->tpl_vars['roomTypeInfo']->value['max_children']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['roomTypeInfo']->value['max_children'], ENT_QUOTES, 'UTF-8', true);
}?>">
			</div>
		</div>
        <div class="form-group">
			<label class="control-label col-sm-2" for="max_guests">
                <span class="label-tooltip" data-toggle="tooltip"
				title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enter maximum number of guests can be accommodated in a room of this room type.'),$_smarty_tpl ) );?>
">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Maximum room occupancy'),$_smarty_tpl ) );?>

                </span>
			</label>
			<div class="col-sm-3">
				<input id="max_guests" type="text" name="max_guests" class="form-control" value="<?php if ((isset($_POST['max_guests']))) {
echo htmlspecialchars((string)$_POST['max_guests'], ENT_QUOTES, 'UTF-8', true);
} elseif ((isset($_smarty_tpl->tpl_vars['roomTypeInfo']->value['max_guests']))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['roomTypeInfo']->value['max_guests'], ENT_QUOTES, 'UTF-8', true);
}?>">
			</div>
		</div>

		<div class="panel-footer">
			<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminProducts'), ENT_QUOTES, 'UTF-8', true);
if ((isset($_REQUEST['page'])) && $_REQUEST['page'] > 1) {?>&amp;submitFilterproduct=<?php echo intval($_REQUEST['page']);
}?>" class="btn btn-default">
				<i class="process-icon-cancel"></i>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel'),$_smarty_tpl ) );?>

			</a>
			<button type="submit" name="submitAddproduct" class="btn btn-default pull-right checkOccupancySubmit" disabled="disabled">
				<i class="process-icon-loading"></i>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save'),$_smarty_tpl ) );?>

			</button>
			<button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right checkOccupancySubmit"  disabled="disabled">
				<i class="process-icon-loading"></i>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save and stay'),$_smarty_tpl ) );?>

			</button>
		</div>
	</div>
<?php }?>

<?php echo '<script'; ?>
>
    $(document).ready(function() {
        $(".checkOccupancySubmit").on("click", function() {
            $("#is_occupancy_submit").val(1);
            return true;
        });
    });
<?php echo '</script'; ?>
><?php }
}
