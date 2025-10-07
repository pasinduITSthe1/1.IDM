<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:39
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\products\input_text_lang.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29b7e69a9_18583297',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f2036610b6003ee11d6f8cf2afb890a9ec08c2f8' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\products\\input_text_lang.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29b7e69a9_18583297 (Smarty_Internal_Template $_smarty_tpl) {
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
		<?php if ((isset($_smarty_tpl->tpl_vars['maxchar']->value))) {?>
		<div class="input-group">
			<span id="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
_counter" class="input-group-addon">
				<span class="text-count-down"><?php echo $_smarty_tpl->tpl_vars['maxchar']->value;?>
</span>
			</span>
			<?php }?>
			<input type="text"
			id="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
"
			class="form-control <?php if ((isset($_smarty_tpl->tpl_vars['input_class']->value))) {
echo $_smarty_tpl->tpl_vars['input_class']->value;?>
 <?php }?>"
			name="<?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
"
			value="<?php echo htmlspecialchars((string)(($tmp = $_smarty_tpl->tpl_vars['input_value']->value[$_smarty_tpl->tpl_vars['language']->value['id_lang']] ?? null)===null||$tmp==='' ? '' ?? null : $tmp), ENT_QUOTES, 'UTF-8', true);?>
"
			onkeyup="if (isArrowKey(event)) return ;updateFriendlyURL();"
			onblur="updateLinkRewrite();"
			<?php if ((isset($_smarty_tpl->tpl_vars['required']->value))) {?> required="required"<?php }?>
			<?php if ((isset($_smarty_tpl->tpl_vars['maxchar']->value))) {?> data-maxchar="<?php echo $_smarty_tpl->tpl_vars['maxchar']->value;?>
"<?php }?>
			<?php if ((isset($_smarty_tpl->tpl_vars['maxlength']->value))) {?> maxlength="<?php echo $_smarty_tpl->tpl_vars['maxlength']->value;?>
"<?php }?> />
			<?php if ((isset($_smarty_tpl->tpl_vars['maxchar']->value))) {?>
		</div>
		<?php }?>
	<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['languages']->value) > 1) {?>
		</div>
		<div class="col-lg-2">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" tabindex="-1">
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
				<li>
					<a href="javascript:tabs_manager.allow_hide_other_languages = false;hideOtherLanguage(<?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
);"><?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
</a>
				</li>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</ul>
		</div>
	</div>
	<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ((isset($_smarty_tpl->tpl_vars['maxchar']->value))) {
echo '<script'; ?>
 type="text/javascript">

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
<?php echo '</script'; ?>
>
<?php }
}
}
