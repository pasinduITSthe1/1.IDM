<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:07
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\carrier_wizard\summary.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27b642618_05271735',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '81c04a94da730ae000f3c91165498a25b45c030e' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\carrier_wizard\\summary.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27b642618_05271735 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	var summary_translation_undefined = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'[undefined]','js'=>1),$_smarty_tpl ) );?>
';
	var summary_translation_meta_informations = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This carrier is @s1 and the delivery announced is: @s2.','js'=>1),$_smarty_tpl ) );?>
';
	var summary_translation_free = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'free','js'=>1),$_smarty_tpl ) );?>
';
	var summary_translation_paid = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'not free','js'=>1),$_smarty_tpl ) );?>
';
	var summary_translation_range = '<span class="is_free"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This carrier can deliver orders from @s1 to @s2.','js'=>1),$_smarty_tpl ) );?>
</span>';
	var summary_translation_range_limit =  '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If the order is out of range, the behavior is to @s3.','js'=>1),$_smarty_tpl ) );?>
';
	var summary_translation_shipping_cost = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The shipping cost is calculated @s1 and the tax rule @s2 will be applied.','js'=>1),$_smarty_tpl ) );?>
';
	var summary_translation_price = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'according to the price','js'=>1),$_smarty_tpl ) );?>
';
	var summary_translation_weight = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'according to the weight','js'=>1),$_smarty_tpl ) );?>
';
<?php echo '</script'; ?>
>

<div class="defaultForm">
	<div class="panel">
		<div class="panel-heading"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Carrier name:'),$_smarty_tpl ) );?>
 <strong id="summary_name"></strong></div>
		<div class="panel-body">
			<p id="summary_meta_informations"></p>
			<p id="summary_shipping_cost"></p>
			<p id="summary_range"></p>
			<div>
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This carrier will be proposed for those delivery zones:'),$_smarty_tpl ) );?>

				<ul id="summary_zones"></ul>
			</div>
			<div>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'And it will be proposed for those client groups:'),$_smarty_tpl ) );?>

				<ul id="summary_groups"></ul>
			</div>
			<?php if ($_smarty_tpl->tpl_vars['is_multishop']->value) {?>
			<div>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Finally, this carrier will be proposed in those shops:'),$_smarty_tpl ) );?>

				<ul id="summary_shops"></ul>
			</div>
			<?php }?>
		</div>
	</div>
	<?php echo $_smarty_tpl->tpl_vars['active_form']->value;?>

</div>
<?php }
}
