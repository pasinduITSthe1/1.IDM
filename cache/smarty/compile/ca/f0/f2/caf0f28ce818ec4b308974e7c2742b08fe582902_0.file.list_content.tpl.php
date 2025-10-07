<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:06
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\carriers\helpers\list\list_content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27a956e87_69962790',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'caf0f28ce818ec4b308974e7c2742b08fe582902' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\carriers\\helpers\\list\\list_content.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27a956e87_69962790 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_135785816668e4f27a8de5b7_60882210', "open_td");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/list/list_content.tpl");
}
/* {block "open_td"} */
class Block_135785816668e4f27a8de5b7_60882210 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'open_td' => 
  array (
    0 => 'Block_135785816668e4f27a8de5b7_60882210',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<td
					<?php if ((isset($_smarty_tpl->tpl_vars['params']->value['position']))) {?>
						id="td_<?php if (!empty($_smarty_tpl->tpl_vars['id_category']->value)) {
echo $_smarty_tpl->tpl_vars['id_category']->value;
} else { ?>0<?php }?>_<?php echo $_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['identifier']->value];?>
"
					<?php }?>
					class="<?php if (!$_smarty_tpl->tpl_vars['no_link']->value) {?>pointer<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['params']->value['position'])) && $_smarty_tpl->tpl_vars['order_by']->value == 'position' && $_smarty_tpl->tpl_vars['order_way']->value != 'DESC') {?> dragHandle<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['params']->value['align']))) {?> <?php echo $_smarty_tpl->tpl_vars['params']->value['align'];
}?>"
					<?php if ((!(isset($_smarty_tpl->tpl_vars['params']->value['position'])) && !$_smarty_tpl->tpl_vars['no_link']->value && !(isset($_smarty_tpl->tpl_vars['params']->value['remove_onclick'])))) {?>
						onclick="document.location = '<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminCarrierWizard',true), ENT_QUOTES, 'UTF-8', true);?>
&amp;<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['identifier']->value, ENT_QUOTES, 'UTF-8', true);?>
=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['tr']->value[$_smarty_tpl->tpl_vars['identifier']->value], ENT_QUOTES, 'UTF-8', true);?>
'">
					<?php } else { ?>
						>
					<?php }?>
			<?php
}
}
/* {/block "open_td"} */
}
