<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:18
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\order-opc-advanced-payment-option.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2868989c0_31950840',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f240d09a6a9a8e22d875814c72a124de210d5827' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\order-opc-advanced-payment-option.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2868989c0_31950840 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php if ((isset($_smarty_tpl->tpl_vars['advance_payment_active']->value))) {?>
	<div class="opc_advance_payment_block">
		<p class="block-small-header"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'PAYMENT TYPES'),$_smarty_tpl ) );?>
</p>
		<div class="row adv_payment_type_form">
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_126140743868e4f28682b348_18152740', 'order_opc_advanced_payment_option_form');
?>

		</div>
	</div>
<?php }
}
/* {block 'order_opc_advanced_payment_option_submit'} */
class Block_64109883968e4f286881885_69030239 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

							<button class="opc-button-small opc-btn-primary" name="submitAdvPayment" type="submit">
								<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'OK'),$_smarty_tpl ) );?>
</span>
							</button>
						<?php
}
}
/* {/block 'order_opc_advanced_payment_option_submit'} */
/* {block 'order_opc_advanced_payment_option_form'} */
class Block_126140743868e4f28682b348_18152740 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_opc_advanced_payment_option_form' => 
  array (
    0 => 'Block_126140743868e4f28682b348_18152740',
  ),
  'order_opc_advanced_payment_option_submit' => 
  array (
    0 => 'Block_64109883968e4f286881885_69030239',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<form method="POST" action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('order-opc'), ENT_QUOTES, 'UTF-8', true);?>
" id="advanced-payment">
					<div class="col-sm-12 col-xs-12">
						<label>
							<input type="radio" value="1" name="payment_type" class="payment_type" <?php if (!(isset($_smarty_tpl->tpl_vars['is_advance_payment']->value))) {?>checked="checked"<?php }?>>
							<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Full Payment'),$_smarty_tpl ) );?>
</span>
						</label>
					</div>
					<div class="col-sm-12 col-xs-12">
						<label>
							<input type="radio" value="2" name="payment_type" class="payment_type" <?php if ((isset($_smarty_tpl->tpl_vars['is_advance_payment']->value))) {?>checked="checked"<?php }?>>
							<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Partial Payment'),$_smarty_tpl ) );?>
</span>
						</label>

						<div class="row" id="partial_data">
							<div class="row margin-lr-0">
								<div class="col-xs-12 partial_subcont">
									<span class="partial_txt"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Advance Payment Amount'),$_smarty_tpl ) );?>
 - </span>
									<span class="partial_min_cost"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['advPaymentAmount']->value),$_smarty_tpl ) );?>
</span>
								</div>
							</div>

							<?php if ((isset($_smarty_tpl->tpl_vars['is_advance_payment']->value))) {?>
								<div class="row margin-lr-0">
									<div class="col-xs-12 partial_subcont">
										<span class="partial_txt"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Due Amount'),$_smarty_tpl ) );?>
 - </span>
										<span class="partial_min_cost"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['dueAmount']->value),$_smarty_tpl ) );?>
</span>
									</div>
								</div>
							<?php }?>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12 margin-top-10">
						<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_64109883968e4f286881885_69030239', 'order_opc_advanced_payment_option_submit', $this->tplIndex);
?>

					</div>
				</form>
			<?php
}
}
/* {/block 'order_opc_advanced_payment_option_form'} */
}
