<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:09
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\categories\helpers\form\form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27d92f3c1_25285365',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c23e2a6c4d1ce451fc1cc9b030c03185c9261b63' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\categories\\helpers\\form\\form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27d92f3c1_25285365 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_76818431168e4f27d865dd1_74002057', "script");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_110372499968e4f27d86b037_17777215', "input");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_36660147868e4f27d8dbad5_27074428', "description");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_49945140968e4f27d91a518_46334505', "input_row");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/form/form.tpl");
}
/* {block "script"} */
class Block_76818431168e4f27d865dd1_74002057 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_76818431168e4f27d865dd1_74002057',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	var ps_force_friendly_product = false;
<?php
}
}
/* {/block "script"} */
/* {block "input"} */
class Block_110372499968e4f27d86b037_17777215 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input' => 
  array (
    0 => 'Block_110372499968e4f27d86b037_17777215',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == "link_rewrite") {?>
		<?php echo '<script'; ?>
 type="text/javascript">
		<?php if ((isset($_smarty_tpl->tpl_vars['PS_ALLOW_ACCENTED_CHARS_URL']->value)) && $_smarty_tpl->tpl_vars['PS_ALLOW_ACCENTED_CHARS_URL']->value) {?>
			var PS_ALLOW_ACCENTED_CHARS_URL = 1;
		<?php } else { ?>
			var PS_ALLOW_ACCENTED_CHARS_URL = 0;
		<?php }?>
		<?php echo '</script'; ?>
>
		<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php } else { ?>
		<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php }?>
	<?php if (in_array($_smarty_tpl->tpl_vars['input']->value['name'],array('image','thumb'))) {?>
		<div class="col-lg-6">
			<div class="help-block"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Recommended dimensions (for the default theme): %1spx x %2spx','sprintf'=>array($_smarty_tpl->tpl_vars['input']->value['format']['width'],$_smarty_tpl->tpl_vars['input']->value['format']['height'])),$_smarty_tpl ) );?>

			</div>
		</div>
	<?php }
}
}
/* {/block "input"} */
/* {block "description"} */
class Block_36660147868e4f27d8dbad5_27074428 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'description' => 
  array (
    0 => 'Block_36660147868e4f27d8dbad5_27074428',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php if (($_smarty_tpl->tpl_vars['input']->value['name'] == 'groupBox')) {?>
		<div class="alert alert-info">
			<h4><?php echo $_smarty_tpl->tpl_vars['input']->value['info_introduction'];?>
</h4>
			<p><?php echo $_smarty_tpl->tpl_vars['input']->value['unidentified'];?>
<br />
			<?php echo $_smarty_tpl->tpl_vars['input']->value['guest'];?>
<br />
			<?php echo $_smarty_tpl->tpl_vars['input']->value['customer'];?>
</p>
		</div>
	<?php }
}
}
/* {/block "description"} */
/* {block "input_row"} */
class Block_49945140968e4f27d91a518_46334505 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input_row' => 
  array (
    0 => 'Block_49945140968e4f27d91a518_46334505',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php if (($_smarty_tpl->tpl_vars['input']->value['name'] == 'thumb')) {?>
	<?php echo $_smarty_tpl->tpl_vars['displayBackOfficeCategory']->value;?>

	<?php }
}
}
/* {/block "input_row"} */
}
