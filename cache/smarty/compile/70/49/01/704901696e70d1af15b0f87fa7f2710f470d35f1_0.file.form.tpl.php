<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:05
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\addresses\helpers\form\form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f279cc0f17_13118463',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '704901696e70d1af15b0f87fa7f2710f470d35f1' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\addresses\\helpers\\form\\form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f279cc0f17_13118463 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9195233168e4f279b45a48_24289880', "label");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_43440363768e4f279c8c0c3_10205239', "input");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/form/form.tpl");
}
/* {block "label"} */
class Block_9195233168e4f279b45a48_24289880 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'label' => 
  array (
    0 => 'Block_9195233168e4f279b45a48_24289880',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'vat_number') {?>
		<div id="vat_area" style="display: visible">
	<?php }?>
	<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

<?php
}
}
/* {/block "label"} */
/* {block "input"} */
class Block_43440363768e4f279c8c0c3_10205239 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input' => 
  array (
    0 => 'Block_43440363768e4f279c8c0c3_10205239',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ($_smarty_tpl->tpl_vars['input']->value['type'] == 'text_customer') {?>
		<?php if ((isset($_smarty_tpl->tpl_vars['customer']->value))) {?>
			<a class="btn btn-default" href="?tab=AdminCustomers&amp;id_customer=<?php echo intval($_smarty_tpl->tpl_vars['customer']->value->id);?>
&amp;viewcustomer&amp;token=<?php echo $_smarty_tpl->tpl_vars['tokenCustomer']->value;?>
">
				<i class="icon-eye-open"></i> <?php echo $_smarty_tpl->tpl_vars['customer']->value->lastname;?>
 <?php echo $_smarty_tpl->tpl_vars['customer']->value->firstname;?>
 (<?php echo $_smarty_tpl->tpl_vars['customer']->value->email;?>
)
			</a>
			<input type="hidden" name="id_customer" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value->id;?>
" />
			<input type="hidden" name="email" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value->email;?>
" />
		<?php }?>
	<?php } elseif ($_smarty_tpl->tpl_vars['input']->value['type'] == 'select' && $_smarty_tpl->tpl_vars['input']->value['name'] == 'id_customer') {?>
		<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

		<input type="hidden" name="email" id="email" value="">
		<?php echo '<script'; ?>
 type="text/javascript">
			$('#id_customer').on('change', function(e)
			{
				var id_customer = parseInt($(this).val());
				$('#email').val('');
				if (!isNaN(id_customer)) {
					var email = $(this).find('[value="'+id_customer+'"]').text();
					$('#email').val(email);
					var data = {};
					data.email = email;
					data.token = "<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['token']->value, ENT_QUOTES, 'UTF-8', true);?>
";
					data.ajax = 1;
					data.controller = "AdminAddresses";
					data.action = "loadNames";
					$.ajax({
						type: "POST",
						url: "ajax-tab.php",
						data: data,
						dataType: 'json',
						async : true,
						success: function(msg) {
							if (msg) {
								var infos = msg.infos.replace("\\'", "'").split('_');
								$('input[name=firstname]').val(infos[0]);
								$('input[name=lastname]').val(infos[1]);
								$('input[name=company]').val(infos[2]);
								$('input[name=id_customer]').val(infos[3]);
								$('input[name=phone]').val(infos[4]);
							} else {
								resetCustomerRelatedAddressFields();
							}
						}
					});
				} else {
					resetCustomerRelatedAddressFields();
				}
			});
			function resetCustomerRelatedAddressFields() {
				$('input[name=firstname]').val('');
				$('input[name=lastname]').val('');
				$('input[name=company]').val('');
				$('input[name=id_customer]').val('');
			}
		<?php echo '</script'; ?>
>
	<?php } else { ?>
		<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['input']->value['name'] == 'vat_number') {?>
		</div>
	<?php }
}
}
/* {/block "input"} */
}
