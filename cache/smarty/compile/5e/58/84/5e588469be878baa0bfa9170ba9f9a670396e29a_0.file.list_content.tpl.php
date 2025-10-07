<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:37
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\products\helpers\list\list_content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f299540257_11031494',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5e588469be878baa0bfa9170ba9f9a670396e29a' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\products\\helpers\\list\\list_content.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f299540257_11031494 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_136358977168e4f299467133_62858868', 'td_content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'helpers/list/list_content.tpl');
}
/* {block 'td_content'} */
class Block_136358977168e4f299467133_62858868 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'td_content' => 
  array (
    0 => 'Block_136358977168e4f299467133_62858868',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ((isset($_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value])) && (isset($_smarty_tpl->tpl_vars['params']->value['position']))) {?>
		<?php if ($_smarty_tpl->tpl_vars['order_by']->value == 'position' && $_smarty_tpl->tpl_vars['order_way']->value != 'DESC') {?>
			<?php $_smarty_tpl->_assignInScope('filters_has_value_no_location_hotel', false);?>

			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fields_display']->value, 'params', false, 'key');
$_smarty_tpl->tpl_vars['params']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['params']->value) {
$_smarty_tpl->tpl_vars['params']->do_else = false;
?>
				<?php if ($_smarty_tpl->tpl_vars['key']->value != 'id_category_default' && ((isset($_smarty_tpl->tpl_vars['params']->value['value'])) && $_smarty_tpl->tpl_vars['params']->value['value'] !== false && $_smarty_tpl->tpl_vars['params']->value['value'] !== '')) {?>
					<?php if (is_array($_smarty_tpl->tpl_vars['params']->value['value']) && trim(implode('',$_smarty_tpl->tpl_vars['params']->value['value'])) == '') {?>
						<?php continue 1;?>
					<?php }?>

					<?php $_smarty_tpl->_assignInScope('filters_has_value_no_location_hotel', true);?>
					<?php break 1;?>
				<?php }?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

			<?php if (!$_smarty_tpl->tpl_vars['filters_has_value_no_location_hotel']->value) {?>
				<div class="dragGroup">
					<div class="positions">
						<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]['position']+1;?>

					</div>
				</div>
			<?php } else { ?>
				<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]['position']+1;?>

			<?php }?>
		<?php } else { ?>
			<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['key']->value]['position']+1;?>

		<?php }?>
	<?php } else { ?>
		<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php }
}
}
/* {/block 'td_content'} */
}
