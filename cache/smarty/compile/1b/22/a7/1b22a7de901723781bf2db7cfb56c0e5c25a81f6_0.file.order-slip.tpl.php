<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:22
  from 'C:\wamp64\www\1.IDM\themes\hotel-reservation-theme\order-slip.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f28aa0fa22_11285149',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1b22a7de901723781bf2db7cfb56c0e5c25a81f6' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\themes\\hotel-reservation-theme\\order-slip.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f28aa0fa22_11285149 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_129724525968e4f28a752186_79479792', 'order_slip');
?>

<?php }
/* {block 'errors'} */
class Block_191513935968e4f28a782744_45632201 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
	<?php
}
}
/* {/block 'errors'} */
/* {block 'order_slip_list'} */
class Block_83904052068e4f28a7ce507_34678575 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.regex_replace.php','function'=>'smarty_modifier_regex_replace',),));
?>

		<div class="block-center" id="block-history">
			<?php if ($_smarty_tpl->tpl_vars['ordersSlip']->value && count($_smarty_tpl->tpl_vars['ordersSlip']->value)) {?>
				<table id="order-list" class="table table-bordered footab">
					<thead>
						<tr>
							<th data-sort-ignore="true" class="first_item"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Credit slip'),$_smarty_tpl ) );?>
</th>
							<th data-sort-ignore="true" class="item"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order'),$_smarty_tpl ) );?>
</th>
							<th class="item"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Date issued'),$_smarty_tpl ) );?>
</th>
							<th data-sort-ignore="true" data-hide="phone"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'View credit slip'),$_smarty_tpl ) );?>
</th>
							<th data-sort-ignore="true"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status'),$_smarty_tpl ) );?>
</th>
							<th data-sort-ignore="true" data-hide="phone" class="last_item"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Actions'),$_smarty_tpl ) );?>
</th>
						</tr>
					</thead>
					<tbody>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ordersSlip']->value, 'slip', false, NULL, 'myLoop', array (
  'first' => true,
  'last' => true,
  'index' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['slip']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['slip']->value) {
$_smarty_tpl->tpl_vars['slip']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['index'];
$_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['total'];
?>
							<tr class="<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['first'] : null)) {?>first_item<?php } elseif ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['last'] : null)) {?>last_item<?php } else { ?>item<?php }?> <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_myLoop']->value['index'] : null)%2) {?>alternate_item<?php }?>">
								<td class="bold">
									<span class="color-myaccount">
										#<?php echo Configuration::get('PS_CREDIT_SLIP_PREFIX',$_smarty_tpl->tpl_vars['lang_id']->value);
echo sprintf("%06d",$_smarty_tpl->tpl_vars['slip']->value['id_order_slip']);?>

									</span>
								</td>
								<td class="history_method">
									<a class="color-myaccount" href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['slip']->value['id_order']);
$_prefixVariable42=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('order-detail',true,NULL,"id_order=".$_prefixVariable42), ENT_QUOTES, 'UTF-8', true);?>
" target="_blank">
										#<?php echo sprintf("%06d",$_smarty_tpl->tpl_vars['slip']->value['id_order']);?>

									</a>
								</td>
								<td class="bold"  data-value="<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['slip']->value['date_add'],"/[\-\:\ ]/",'');?>
">
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['dateFormat'][0], array( array('date'=>$_smarty_tpl->tpl_vars['slip']->value['date_add'],'full'=>0),$_smarty_tpl ) );?>

								</td>
								<td class="history_invoice">
									<a class="link-button" href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['slip']->value['id_order_slip']);
$_prefixVariable43=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('pdf-order-slip',true,NULL,"id_order_slip=".$_prefixVariable43), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Credit slip'),$_smarty_tpl ) );?>
 #<?php echo Configuration::get('PS_CREDIT_SLIP_PREFIX',$_smarty_tpl->tpl_vars['lang_id']->value);
echo sprintf("%06d",$_smarty_tpl->tpl_vars['slip']->value['id_order_slip']);?>
">
										<i class="icon-file-text large"></i><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'PDF'),$_smarty_tpl ) );?>

									</a>
								</td>
								<td>
									<?php if ($_smarty_tpl->tpl_vars['slip']->value['redeem_status'] == OrderSlip::REDEEM_STATUS_REDEEMED) {?>
										<span class="badge badge-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Redeemed'),$_smarty_tpl ) );?>
</span>
									<?php } else { ?>
										<span class="badge badge-success"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Active'),$_smarty_tpl ) );?>
</span>
									<?php }?>
								</td>
								<td>
									<?php if ($_smarty_tpl->tpl_vars['slip']->value['redeem_status'] == OrderSlip::REDEEM_STATUS_ACTIVE && !$_smarty_tpl->tpl_vars['slip']->value['id_cart_rule']) {?>
										<a href="<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['slip']->value['id_order_slip']);
$_prefixVariable44=ob_get_clean();
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('order-slip',true,NULL,"generateVoucher=1&id_order_slip=".$_prefixVariable44), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Generate voucher for credit slip '),$_smarty_tpl ) );?>
 #<?php echo Configuration::get('PS_CREDIT_SLIP_PREFIX',$_smarty_tpl->tpl_vars['lang_id']->value);
echo sprintf("%06d",$_smarty_tpl->tpl_vars['slip']->value['id_order_slip']);?>
">
											<u><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Generate Voucher'),$_smarty_tpl ) );?>
</u>
										</a>
									<?php } elseif ($_smarty_tpl->tpl_vars['slip']->value['redeem_status'] == OrderSlip::REDEEM_STATUS_REDEEMED && $_smarty_tpl->tpl_vars['slip']->value['id_cart_rule']) {?>
										<span class="badge badge-danger"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Voucher Generated'),$_smarty_tpl ) );?>
</span>
									<?php } elseif ($_smarty_tpl->tpl_vars['slip']->value['redeem_status'] == OrderSlip::REDEEM_STATUS_REDEEMED && !$_smarty_tpl->tpl_vars['slip']->value['id_cart_rule']) {?>
										--
									<?php }?>
								</td>
							</tr>
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</tbody>
				</table>
				<div id="block-order-detail" class="unvisible">&nbsp;</div>
			<?php } else { ?>
				<p class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You have not received any credit slips.'),$_smarty_tpl ) );?>
</p>
			<?php }?>
		</div><!-- #block-history -->
	<?php
}
}
/* {/block 'order_slip_list'} */
/* {block 'order_slip_footer_links'} */
class Block_42212440668e4f28a9cc141_99689141 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<ul class="footer_links clearfix">
			<li>
				<a class="btn btn-default button button-small" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
">
					<span>
						<i class="icon-chevron-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Back to My account'),$_smarty_tpl ) );?>

					</span>
				</a>
			</li>
			<li>
				<a class="btn btn-default button button-small" href="<?php if ((isset($_smarty_tpl->tpl_vars['force_ssl']->value)) && $_smarty_tpl->tpl_vars['force_ssl']->value) {
echo $_smarty_tpl->tpl_vars['base_dir_ssl']->value;
} else {
echo $_smarty_tpl->tpl_vars['base_dir']->value;
}?>">
					<span>
						<i class="icon-chevron-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Home'),$_smarty_tpl ) );?>

					</span>
				</a>
			</li>
		</ul>
	<?php
}
}
/* {/block 'order_slip_footer_links'} */
/* {block 'order_slip'} */
class Block_129724525968e4f28a752186_79479792 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'order_slip' => 
  array (
    0 => 'Block_129724525968e4f28a752186_79479792',
  ),
  'errors' => 
  array (
    0 => 'Block_191513935968e4f28a782744_45632201',
  ),
  'order_slip_list' => 
  array (
    0 => 'Block_83904052068e4f28a7ce507_34678575',
  ),
  'order_slip_footer_links' => 
  array (
    0 => 'Block_42212440668e4f28a9cc141_99689141',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'path', null, null);?><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account',true), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My account'),$_smarty_tpl ) );?>
</a><span class="navigation-pipe"><?php echo $_smarty_tpl->tpl_vars['navigationPipe']->value;?>
</span><span class="navigation_page"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Credit slips'),$_smarty_tpl ) );?>
</span><?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>

	<h1 class="page-heading bottom-indent">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Credit slips'),$_smarty_tpl ) );?>

	</h1>
	<p class="info-title">
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Credit slips you have received after canceled orders'),$_smarty_tpl ) );?>
.
	</p>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_191513935968e4f28a782744_45632201', 'errors', $this->tplIndex);
?>


	<?php if ((isset($_GET['confirmation'])) && $_GET['confirmation']) {?>
		<p class="alert alert-success">
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your voucher has been generated successfully and sent via email.'),$_smarty_tpl ) );?>
 <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getPageLink('discount',true), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo 'Click here';?>
</a> <?php echo ' to see your all vouchers.';?>

		</p>
	<?php }?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_83904052068e4f28a7ce507_34678575', 'order_slip_list', $this->tplIndex);
?>

	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_42212440668e4f28a9cc141_99689141', 'order_slip_footer_links', $this->tplIndex);
?>

<?php
}
}
/* {/block 'order_slip'} */
}
