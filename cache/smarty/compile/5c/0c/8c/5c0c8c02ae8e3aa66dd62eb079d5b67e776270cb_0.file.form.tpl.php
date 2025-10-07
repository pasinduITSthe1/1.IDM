<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:15
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\languages\helpers\form\form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f283e8a407_24956435',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5c0c8c02ae8e3aa66dd62eb079d5b67e776270cb' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\languages\\helpers\\form\\form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f283e8a407_24956435 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11670810668e4f283da52c5_65994973', "input");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_41318356068e4f283dd6085_81075911', 'script');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_202884111768e4f283e05fd0_90103234', "other_fieldsets");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/form/form.tpl");
}
/* {block "input"} */
class Block_11670810668e4f283da52c5_65994973 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input' => 
  array (
    0 => 'Block_11670810668e4f283da52c5_65994973',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ($_smarty_tpl->tpl_vars['input']->value['type'] == 'special') {?>
		<div id="#resultCheckLangPack">
			<p id="lang_pack_loading" style="display:none"><img src="../img/admin/<?php echo $_smarty_tpl->tpl_vars['input']->value['img'];?>
" alt="" /> <?php echo $_smarty_tpl->tpl_vars['input']->value['text'];?>
</p>
			<p id="lang_pack_msg" style="display:none"></p>
		</div>
	<?php } else { ?>
		<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php }
}
}
/* {/block "input"} */
/* {block 'script'} */
class Block_41318356068e4f283dd6085_81075911 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_41318356068e4f283dd6085_81075911',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		var langPackOk = "<img src=\"<?php echo (defined('_PS_IMG_') ? constant('_PS_IMG_') : null);?>
admin/information.png\" alt=\"\" /> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'A language pack is available for this ISO.'),$_smarty_tpl ) );?>
";
		var langPackVersion = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The QloApps version compatible with this language and your system is:'),$_smarty_tpl ) );?>
";
		var langPackInfo = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'After creating the language, you can import the content of the language pack, which you can download under "Localization -- Translations."'),$_smarty_tpl ) );?>
";
		var noLangPack = "<img src=\"<?php echo (defined('_PS_IMG_') ? constant('_PS_IMG_') : null);?>
admin/information.png\" alt=\"\" /> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No language pack is available on prestashop.com for this ISO code'),$_smarty_tpl ) );?>
";
		var download = "<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Download'),$_smarty_tpl ) );?>
";

	$(document).ready(function() {
		$('#iso_code').keyup(function(e) {
			e.preventDefault();
			checkLangPack("<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['token']->value, ENT_QUOTES, 'UTF-8', true);?>
");
		});
	});

<?php
}
}
/* {/block 'script'} */
/* {block "other_fieldsets"} */
class Block_202884111768e4f283e05fd0_90103234 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'other_fieldsets' => 
  array (
    0 => 'Block_202884111768e4f283e05fd0_90103234',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ((isset($_smarty_tpl->tpl_vars['fields']->value['new']))) {?>
		<br /><br />
		<div class="panel" style="width:572px;">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fields']->value['new'], 'field', false, 'key');
$_smarty_tpl->tpl_vars['field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['field']->value) {
$_smarty_tpl->tpl_vars['field']->do_else = false;
?>
				<?php if ($_smarty_tpl->tpl_vars['key']->value == 'legend') {?>
					<legend>
						<?php if ((isset($_smarty_tpl->tpl_vars['field']->value['image']))) {?><img src="<?php echo $_smarty_tpl->tpl_vars['field']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>
" /><?php }?>
						<?php echo $_smarty_tpl->tpl_vars['field']->value['title'];?>

					</legend>
					<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This language pack is NOT complete and cannot be used in the front or back office because some files are missing.'),$_smarty_tpl ) );?>
</p>
					<br />
				<?php } elseif ($_smarty_tpl->tpl_vars['key']->value == 'list_files') {?>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['field']->value, 'list');
$_smarty_tpl->tpl_vars['list']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->do_else = false;
?>
						<label><?php echo $_smarty_tpl->tpl_vars['list']->value['label'];?>
</label>
						<div class="margin-form" style="margin-top:4px;">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list']->value['files'], 'file', false, 'key');
$_smarty_tpl->tpl_vars['file']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['file']->do_else = false;
?>
								<?php if (!file_exists($_smarty_tpl->tpl_vars['key']->value)) {?>
									<font color="red">
								<?php }?>
								<?php echo $_smarty_tpl->tpl_vars['key']->value;?>

								<?php if (!file_exists($_smarty_tpl->tpl_vars['key']->value)) {?>
									</font>
								<?php }?>
								<br />
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
						</div>
						<br style="clear:both;" />
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<?php }?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<br />
			<div class="small"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Missing files are marked in red'),$_smarty_tpl ) );?>
</div>
		</div>
	<?php }
}
}
/* {/block "other_fieldsets"} */
}
