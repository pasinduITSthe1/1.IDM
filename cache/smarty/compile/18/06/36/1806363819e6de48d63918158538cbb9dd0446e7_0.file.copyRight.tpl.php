<?php
/* Smarty version 4.5.5, created on 2025-10-29 12:32:34
  from 'C:\wamp64\www\1.IDM\modules\hotelreservationsystem\views\templates\hook\copyRight.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901bc0a830226_48607740',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1806363819e6de48d63918158538cbb9dd0446e7' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\hotelreservationsystem\\views\\templates\\hook\\copyRight.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901bc0a830226_48607740 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="copyRightWrapper">
	<p class="copyRight">
		&copy;<?php if ((isset($_smarty_tpl->tpl_vars['WK_HTL_ESTABLISHMENT_YEAR']->value)) && $_smarty_tpl->tpl_vars['WK_HTL_ESTABLISHMENT_YEAR']->value) {?> <?php echo $_smarty_tpl->tpl_vars['WK_HTL_ESTABLISHMENT_YEAR']->value;?>
-<?php echo date('Y');?>
&nbsp;<?php }?><a href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
">&nbsp;<?php echo $_smarty_tpl->tpl_vars['WK_HTL_CHAIN_NAME']->value;?>
</a>.&nbsp;<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>' All rights reserved.','mod'=>'hotelreservationsystem'),$_smarty_tpl ) );?>

	</p>
</div><?php }
}
