<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:36
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\products\features.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f298ce73b8_73416030',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d80232254f8c9285722f9b6c7f831bc94526c90' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\products\\features.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f298ce73b8_73416030 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['product']->value->id))) {?>
<div id="product-features" class="panel product-tab">
	<input type="hidden" name="submitted_tabs[]" value="Features" />
	<h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Assign features to this room type'),$_smarty_tpl ) );?>
</h3>

	<div class="alert alert-info">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can specify a value for each relevant feature regarding this room type. Empty fields will not be displayed.'),$_smarty_tpl ) );?>
<br/>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can either create a specific value, or select among the existing pre-defined values you\'ve previously added.'),$_smarty_tpl ) );?>

	</div>

	<table class="table">
		<thead>
			<tr>
				<th></th>
				<th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Feature'),$_smarty_tpl ) );?>
</span></th>
				<th><span class="title_box"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Feature Image'),$_smarty_tpl ) );?>
</span></th>
				<!-- <th><span class="title_box"><u><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'or'),$_smarty_tpl ) );?>
</u> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customized value'),$_smarty_tpl ) );?>
</span></th> --><!-- by webkul -->
			</tr>
		</thead>

		<tbody>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['available_features']->value, 'available_feature');
$_smarty_tpl->tpl_vars['available_feature']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['available_feature']->value) {
$_smarty_tpl->tpl_vars['available_feature']->do_else = false;
?>

			<tr>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['available_feature']->value['featureValues'], 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
				<td>
					<input type="checkbox" class="checkbox select_hotel_feature" name="feature_<?php echo $_smarty_tpl->tpl_vars['available_feature']->value['id_feature'];?>
_check" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id_feature_value'];?>
" <?php if ($_smarty_tpl->tpl_vars['available_feature']->value['current_item'] == $_smarty_tpl->tpl_vars['value']->value['id_feature_value']) {?>checked="checked"<?php }?>/>
				</td>
				<td><?php echo $_smarty_tpl->tpl_vars['available_feature']->value['name'];?>
</td>
				<td>
					<input type="hidden" id="feature_<?php echo $_smarty_tpl->tpl_vars['available_feature']->value['id_feature'];?>
_value" name="feature_<?php echo $_smarty_tpl->tpl_vars['available_feature']->value['id_feature'];?>
_value" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id_feature_value'];?>
">
					<img class="img img-responsive" width="15px" src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
img/rf/<?php echo $_smarty_tpl->tpl_vars['value']->value['value'];?>
" title="Room image" />
				</td>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<!-- By Webkul -->
				</td>
				<!-- By Webkul -->

			</tr>
			<?php
}
if ($_smarty_tpl->tpl_vars['available_feature']->do_else) {
?>
			<tr>
				<td colspan="3" style="text-align:center;"><i class="icon-warning-sign"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No features have been defined'),$_smarty_tpl ) );?>
</td>
			</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</tbody>
	</table>

	<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminFeatures'), ENT_QUOTES, 'UTF-8', true);?>
&amp;addfeature" class="btn btn-link confirm_leave button">
		<i class="icon-plus-sign"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add a new feature'),$_smarty_tpl ) );?>
 <i class="icon-external-link-sign"></i>
	</a>
	<div class="panel-footer">
		<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminProducts'), ENT_QUOTES, 'UTF-8', true);
if ((isset($_REQUEST['page'])) && $_REQUEST['page'] > 1) {?>&amp;submitFilterproduct=<?php echo intval($_REQUEST['page']);
}?>" class="btn btn-default"><i class="process-icon-cancel"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel'),$_smarty_tpl ) );?>
</a>
		<button type="submit" name="submitAddproduct" class="btn btn-default pull-right" disabled="disabled"><i class="process-icon-loading"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save'),$_smarty_tpl ) );?>
</button>
		<button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right" disabled="disabled"><i class="process-icon-loading"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save and stay'),$_smarty_tpl ) );?>
</button>
	</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
	if (tabs_manager.allow_hide_other_languages)
		hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['default_form_language']->value;?>
);

	$(".textarea-autosize").autosize();

	function all_languages(pos)
	{

<?php if ((isset($_smarty_tpl->tpl_vars['languages']->value)) && is_array($_smarty_tpl->tpl_vars['languages']->value)) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language', false, 'k');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
			pos.parents('td').find('.lang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
').addClass('nolang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
').removeClass('lang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
');
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>
		pos.parents('td').find('.translatable-field').hide();
		pos.parents('td').find('.lang-0').show();

	}

	function restore_lng(pos,i)
	{

<?php if ((isset($_smarty_tpl->tpl_vars['languages']->value)) && is_array($_smarty_tpl->tpl_vars['languages']->value)) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language', false, 'k');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
			pos.parents('td').find('.nolang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
').addClass('lang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
').removeClass('nolang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
');
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>

		pos.parents('td').find('.lang-0').hide();
		hideOtherLanguage(i);
	}
<?php echo '</script'; ?>
>


<?php }
}
}
