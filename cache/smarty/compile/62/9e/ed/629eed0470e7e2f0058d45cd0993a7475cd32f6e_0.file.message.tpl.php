<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:12
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\customer_threads\helpers\view\message.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2805375d7_57619227',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '629eed0470e7e2f0058d45cd0993a7475cd32f6e' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\customer_threads\\helpers\\view\\message.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2805375d7_57619227 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['message']->value['id_employee']) {?>
	<?php $_smarty_tpl->_assignInScope('type', "customer");
} else { ?>
	<?php $_smarty_tpl->_assignInScope('type', "employee");
}?>

<div class="message-item<?php if ($_smarty_tpl->tpl_vars['initial']->value) {?>-initial-body<?php }?>">
<?php if (!$_smarty_tpl->tpl_vars['initial']->value) {?>
	<div class="message-avatar">
		<div class="avatar-md">
			<?php if ($_smarty_tpl->tpl_vars['type']->value == 'customer') {?>
				<i class="icon-user icon-3x"></i>
			<?php } else { ?>
				<?php if ((isset($_smarty_tpl->tpl_vars['current_employee']->value->firstname))) {?><img src="<?php echo $_smarty_tpl->tpl_vars['message']->value['employee_image'];?>
" alt="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['current_employee']->value->firstname, ENT_QUOTES, 'UTF-8', true);?>
" /><?php }?>
			<?php }?>
		</div>
	</div>
<?php }?>
	<div class="message-body">
		<?php if (!$_smarty_tpl->tpl_vars['initial']->value) {?>
			<h4 class="message-item-heading">
				<i class="icon-mail-reply text-muted"></i>
				<?php if ($_smarty_tpl->tpl_vars['type']->value == 'customer') {?>
					<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value['customer_name'], ENT_QUOTES, 'UTF-8', true);?>

				<?php } else { ?>
					<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value['employee_name'], ENT_QUOTES, 'UTF-8', true);?>

				<?php }?>
			</h4>
		<?php }?>
		<span class="message-date">&nbsp;<i class="icon-calendar"></i> - <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['message']->value['date_add'],'full'=>0),$_smarty_tpl ) );?>
 - <i class="icon-time"></i> <?php echo substr((string) $_smarty_tpl->tpl_vars['message']->value['date_add'], (int) 11, (int) 5);?>
</span>
		<?php if ($_smarty_tpl->tpl_vars['message']->value['private']) {?><span class="badge badge-info"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Private'),$_smarty_tpl ) );?>
</span><?php }?>
		<?php if ((isset($_smarty_tpl->tpl_vars['message']->value['file_name']))) {?> <span class="message-product">&nbsp;<i class="icon-link"></i> <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value['file_name'], ENT_QUOTES, 'UTF-8', true);?>
" class="_blank"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Attachment"),$_smarty_tpl ) );?>
</a></span><?php }?>
		<?php if ((isset($_smarty_tpl->tpl_vars['message']->value['product_name']))) {?> <span class="message-attachment">&nbsp;<i class="icon-book"></i> <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value['product_link'], ENT_QUOTES, 'UTF-8', true);?>
" class="_blank"><?php if ((isset($_smarty_tpl->tpl_vars['message']->value['booking_product'])) && $_smarty_tpl->tpl_vars['message']->value['booking_product']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Room type:"),$_smarty_tpl ) );
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Product:"),$_smarty_tpl ) );
}?> <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value['product_name'], ENT_QUOTES, 'UTF-8', true);?>
 </a></span><?php }?>
		<p class="message-item-text"><?php echo nl2br((string) htmlspecialchars((string)$_smarty_tpl->tpl_vars['message']->value['message'], ENT_QUOTES, 'UTF-8', true), (bool) 1);?>
</p>
	</div>
</div>
<?php }
}
