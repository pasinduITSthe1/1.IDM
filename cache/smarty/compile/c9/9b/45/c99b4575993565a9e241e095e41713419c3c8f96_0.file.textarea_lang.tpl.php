<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:40
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\products\textarea_lang.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29cddf4a7_72480125',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c99b4575993565a9e241e095e41713419c3c8f96' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\products\\textarea_lang.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29cddf4a7_72480125 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
	<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['languages']->value) > 1) {?>
		<div class="translatable-field row lang-<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
">
			<div class="col-lg-9">
	<?php }?>
	<?php if ((isset($_smarty_tpl->tpl_vars['maxchar']->value)) && $_smarty_tpl->tpl_vars['maxchar']->value) {?>
				<div class="input-group">
					<span id="<?php if ((isset($_smarty_tpl->tpl_vars['input_id']->value))) {
echo $_smarty_tpl->tpl_vars['input_id']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];
} else {
echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];
}?>_counter" class="input-group-addon">
						<span class="text-count-down"><?php echo intval($_smarty_tpl->tpl_vars['maxchar']->value);?>
</span>
					</span>
	<?php }?>
					<textarea id="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
" class="<?php if ((isset($_smarty_tpl->tpl_vars['class']->value))) {
echo $_smarty_tpl->tpl_vars['class']->value;
} else { ?>textarea-autosize<?php }?>"<?php if ((isset($_smarty_tpl->tpl_vars['maxlength']->value)) && $_smarty_tpl->tpl_vars['maxlength']->value) {?> maxlength="<?php echo intval($_smarty_tpl->tpl_vars['maxlength']->value);?>
"<?php }
if ((isset($_smarty_tpl->tpl_vars['maxchar']->value)) && $_smarty_tpl->tpl_vars['maxchar']->value) {?> data-maxchar="<?php echo intval($_smarty_tpl->tpl_vars['maxchar']->value);?>
"<?php }?>><?php if ((isset($_smarty_tpl->tpl_vars['input_value']->value[$_smarty_tpl->tpl_vars['language']->value['id_lang']]))) {
echo smarty_modifier_htmlentitiesUTF8($_smarty_tpl->tpl_vars['input_value']->value[$_smarty_tpl->tpl_vars['language']->value['id_lang']]);
}?></textarea>
					<span class="counter" data-max="<?php if ((isset($_smarty_tpl->tpl_vars['max']->value))) {
echo intval($_smarty_tpl->tpl_vars['max']->value);
}
if ((isset($_smarty_tpl->tpl_vars['maxlength']->value))) {
echo intval($_smarty_tpl->tpl_vars['maxlength']->value);
}
if (!(isset($_smarty_tpl->tpl_vars['max']->value)) && !(isset($_smarty_tpl->tpl_vars['maxlength']->value))) {?>none<?php }?>"></span>
			<?php if ((isset($_smarty_tpl->tpl_vars['maxchar']->value)) && $_smarty_tpl->tpl_vars['maxchar']->value) {?>
				</div>
			<?php }?>
	<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['languages']->value) > 1) {?>
			</div>
			<div class="col-lg-2">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<?php echo $_smarty_tpl->tpl_vars['language']->value['iso_code'];?>

					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
					<li><a href="javascript:tabs_manager.allow_hide_other_languages = false;hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
);"><?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
</a></li>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</ul>
			</div>
		</div>
	<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<?php echo '<script'; ?>
 type="text/javascript">
	<?php if ((isset($_smarty_tpl->tpl_vars['maxchar']->value)) && $_smarty_tpl->tpl_vars['maxchar']->value) {?>
		$(document).ready(function(){
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
			countDown($("#<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
"), $("#<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
_counter"));
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		});
	<?php }?>
	$(".textarea-autosize").autosize();
<?php echo '</script'; ?>
>

<?php }
}
