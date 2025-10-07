<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:16
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\maintenance\helpers\options\options.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2849a4778_54170792',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '53252b870a0176043db8c83261aa907385d4fe7a' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\maintenance\\helpers\\options\\options.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2849a4778_54170792 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_108101686668e4f284933d98_64225791', "input");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/options/options.tpl");
}
/* {block "input"} */
class Block_108101686668e4f284933d98_64225791 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input' => 
  array (
    0 => 'Block_108101686668e4f284933d98_64225791',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ($_smarty_tpl->tpl_vars['field']->value['type'] == 'maintenance_ip') {?>
		<?php echo $_smarty_tpl->tpl_vars['field']->value['script_ip'];?>

		<div class="col-lg-9">
			<div class="row">
				<div class="col-lg-8">
					<input type="text"<?php if ((isset($_smarty_tpl->tpl_vars['field']->value['id']))) {?> id="<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
"<?php }?> size="<?php if ((isset($_smarty_tpl->tpl_vars['field']->value['size']))) {
echo intval($_smarty_tpl->tpl_vars['field']->value['size']);
} else { ?>5<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['field']->value['value'], ENT_QUOTES, 'UTF-8', true);?>
" />
				</div>
				<div class="col-lg-1">
					<?php echo $_smarty_tpl->tpl_vars['field']->value['link_remove_ip'];?>

				</div>
			</div>
		</div>
	<?php } else { ?>
		<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php }
}
}
/* {/block "input"} */
}
