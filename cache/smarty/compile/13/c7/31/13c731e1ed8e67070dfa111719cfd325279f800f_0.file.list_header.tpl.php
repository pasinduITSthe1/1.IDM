<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:44
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\supply_orders_receipt_history\helpers\list\list_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a074ce82_15540699',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13c731e1ed8e67070dfa111719cfd325279f800f' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\supply_orders_receipt_history\\helpers\\list\\list_header.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a074ce82_15540699 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_105215825668e4f2a07487c1_65818390', 'override_header');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/list/list_header.tpl");
}
/* {block 'override_header'} */
class Block_105215825668e4f2a07487c1_65818390 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'override_header' => 
  array (
    0 => 'Block_105215825668e4f2a07487c1_65818390',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
 type="text/javascript">
$(document).ready(function() {
	$('input.quantity_received_today').live('click', function() {
		/* checks checkbox when the input is clicked */
		$(this).parents('tr:eq(0)').find('input[type=checkbox]').attr('checked', true);
	});
});
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'override_header'} */
}
