<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:42
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\search\helpers\view\view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29e22f005_07188312',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dc45a888eb52dc0e7f4e81e6ed41a7748b0019be' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\search\\helpers\\view\\view.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29e22f005_07188312 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

<?php echo '<script'; ?>
 type="text/javascript">
$(function() {
	$('#content .panel').highlight('<?php echo $_smarty_tpl->tpl_vars['query']->value;?>
');
});
<?php echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['query']->value) {?>
	<h2>
	<?php if ((isset($_smarty_tpl->tpl_vars['nb_results']->value)) && $_smarty_tpl->tpl_vars['nb_results']->value == 0) {?>
		<h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There are no results matching your query "%s".','sprintf'=>$_smarty_tpl->tpl_vars['query']->value),$_smarty_tpl ) );?>
</h2>
	<?php } elseif ((isset($_smarty_tpl->tpl_vars['nb_results']->value)) && $_smarty_tpl->tpl_vars['nb_results']->value == 1) {?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 result matches your query "%s".','sprintf'=>$_smarty_tpl->tpl_vars['query']->value),$_smarty_tpl ) );?>

	<?php } elseif ((isset($_smarty_tpl->tpl_vars['nb_results']->value))) {?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d results match your query "%s".','sprintf'=>array(intval($_smarty_tpl->tpl_vars['nb_results']->value),$_smarty_tpl->tpl_vars['query']->value)),$_smarty_tpl ) );?>

	<?php }?>
	</h2>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['query']->value && (isset($_smarty_tpl->tpl_vars['nb_results']->value)) && $_smarty_tpl->tpl_vars['nb_results']->value) {?>

	<?php if ((isset($_smarty_tpl->tpl_vars['features']->value))) {?>
	<div class="panel">
		<h3>
			<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['features']->value) == 1) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 feature'),$_smarty_tpl ) );?>

			<?php } else { ?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d features','sprintf'=>smarty_modifier_count($_smarty_tpl->tpl_vars['features']->value)),$_smarty_tpl ) );?>

			<?php }?>
		</h3>
		<table class="table">
			<tbody>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['features']->value, 'feature', false, 'key');
$_smarty_tpl->tpl_vars['feature']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['feature']->value) {
$_smarty_tpl->tpl_vars['feature']->do_else = false;
?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['feature']->value, 'val', false, 'k', 'feature_list', array (
  'first' => true,
  'index' => true,
));
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_feature_list']->value['index']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_feature_list']->value['first'] = !$_smarty_tpl->tpl_vars['__smarty_foreach_feature_list']->value['index'];
?>
					<tr>
						<td><a href="<?php echo $_smarty_tpl->tpl_vars['val']->value['link'];?>
"<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_feature_list']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_feature_list']->value['first'] : null)) {?>><strong><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</strong><?php }?></a></td>
						<td><a href="<?php echo $_smarty_tpl->tpl_vars['val']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['value'];?>
</a></td>
					</tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</tbody>
		</table>
	</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['modules']->value)) && $_smarty_tpl->tpl_vars['modules']->value) {?>
	<div class="panel">
		<h3>
			<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['modules']->value) == 1) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 module'),$_smarty_tpl ) );?>

			<?php } else { ?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d modules','sprintf'=>smarty_modifier_count($_smarty_tpl->tpl_vars['modules']->value)),$_smarty_tpl ) );?>

			<?php }?>
		</h3>
		<table class="table">
			<tbody>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['modules']->value, 'module', false, 'key');
$_smarty_tpl->tpl_vars['module']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->do_else = false;
?>
				<tr>
					<td><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['module']->value->linkto, ENT_QUOTES, 'UTF-8', true);?>
"><strong><?php echo $_smarty_tpl->tpl_vars['module']->value->displayName;?>
</strong></a></td>
					<td><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['module']->value->linkto, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->tpl_vars['module']->value->description;?>
</a></td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</tbody>
		</table>
	</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['categories']->value)) && $_smarty_tpl->tpl_vars['categories']->value) {?>
	<div class="panel">
		<h3>
			<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['categories']->value) == 1) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 category'),$_smarty_tpl ) );?>

			<?php } else { ?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d categories','sprintf'=>smarty_modifier_count($_smarty_tpl->tpl_vars['categories']->value)),$_smarty_tpl ) );?>

			<?php }?>
		</h3>
		<table class="table" style="border-spacing : 0; border-collapse : collapse;">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category', false, 'key');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
?>
				<tr>
					<td><?php echo $_smarty_tpl->tpl_vars['category']->value;?>
</td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</table>
	</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['num_hotels']->value)) && $_smarty_tpl->tpl_vars['num_hotels']->value) {?>
		<div class="panel">
			<h3>
				<?php if ($_smarty_tpl->tpl_vars['num_hotels']->value == 1) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 Hotel'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d Hotels','sprintf'=>$_smarty_tpl->tpl_vars['num_hotels']->value),$_smarty_tpl ) );?>

				<?php }?>
			</h3>
			<?php echo $_smarty_tpl->tpl_vars['hotels']->value;?>

		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['num_hotel_features']->value)) && $_smarty_tpl->tpl_vars['num_hotel_features']->value) {?>
		<div class="panel">
			<h3>
				<?php if ($_smarty_tpl->tpl_vars['num_hotel_features']->value == 1) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 hotel feature'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d hotel features','sprintf'=>$_smarty_tpl->tpl_vars['num_hotel_features']->value),$_smarty_tpl ) );?>

				<?php }?>
			</h3>
			<?php echo $_smarty_tpl->tpl_vars['hotel_features']->value;?>

		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['num_products']->value)) && $_smarty_tpl->tpl_vars['num_products']->value) {?>
		<div class="panel">
			<h3>
				<?php if ($_smarty_tpl->tpl_vars['num_products']->value == 1) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 room type'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d room types','sprintf'=>$_smarty_tpl->tpl_vars['num_products']->value),$_smarty_tpl ) );?>

				<?php }?>
			</h3>
			<?php echo $_smarty_tpl->tpl_vars['products']->value;?>

		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['num_catalog_features']->value)) && $_smarty_tpl->tpl_vars['num_catalog_features']->value) {?>
		<div class="panel">
			<h3>
				<?php if ($_smarty_tpl->tpl_vars['num_catalog_features']->value == 1) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 feature'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d features','sprintf'=>$_smarty_tpl->tpl_vars['num_catalog_features']->value),$_smarty_tpl ) );?>

				<?php }?>
			</h3>
			<?php echo $_smarty_tpl->tpl_vars['catalog_features']->value;?>

		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['num_service_products']->value)) && $_smarty_tpl->tpl_vars['num_service_products']->value) {?>
		<div class="panel">
			<h3>
				<?php if ($_smarty_tpl->tpl_vars['num_service_products']->value == 1) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 service product'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d service products','sprintf'=>$_smarty_tpl->tpl_vars['num_service_products']->value),$_smarty_tpl ) );?>

				<?php }?>
			</h3>
			<?php echo $_smarty_tpl->tpl_vars['service_products']->value;?>

		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['num_global_demands']->value)) && $_smarty_tpl->tpl_vars['num_global_demands']->value) {?>
		<div class="panel">
			<h3>
				<?php if ($_smarty_tpl->tpl_vars['num_global_demands']->value == 1) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 global demand'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d global demands','sprintf'=>$_smarty_tpl->tpl_vars['num_global_demands']->value),$_smarty_tpl ) );?>

				<?php }?>
			</h3>
			<?php echo $_smarty_tpl->tpl_vars['global_demands']->value;?>

		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['num_refund_rules']->value)) && $_smarty_tpl->tpl_vars['num_refund_rules']->value) {?>
		<div class="panel">
			<h3>
				<?php if ($_smarty_tpl->tpl_vars['num_refund_rules']->value == 1) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 refund rule'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d refund rules','sprintf'=>$_smarty_tpl->tpl_vars['num_refund_rules']->value),$_smarty_tpl ) );?>

				<?php }?>
			</h3>
			<?php echo $_smarty_tpl->tpl_vars['refund_rules']->value;?>

		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['num_customers']->value)) && $_smarty_tpl->tpl_vars['num_customers']->value) {?>
		<div class="panel">
			<h3>
				<?php if ($_smarty_tpl->tpl_vars['num_customers']->value == 1) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 customer'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d customers','sprintf'=>$_smarty_tpl->tpl_vars['num_customers']->value),$_smarty_tpl ) );?>

				<?php }?>
			</h3>
			<?php echo $_smarty_tpl->tpl_vars['customers']->value;?>

		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['num_groups']->value)) && $_smarty_tpl->tpl_vars['num_groups']->value) {?>
		<div class="panel">
			<h3>
				<?php if ($_smarty_tpl->tpl_vars['num_groups']->value == 1) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 group'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d groups','sprintf'=>$_smarty_tpl->tpl_vars['num_groups']->value),$_smarty_tpl ) );?>

				<?php }?>
			</h3>
			<?php echo $_smarty_tpl->tpl_vars['groups']->value;?>

		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['num_customer_address']->value)) && $_smarty_tpl->tpl_vars['num_customer_address']->value) {?>
		<div class="panel">
			<h3>
				<?php if ($_smarty_tpl->tpl_vars['num_customer_address']->value == 1) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 customer address'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d customer addresses','sprintf'=>$_smarty_tpl->tpl_vars['num_customer_address']->value),$_smarty_tpl ) );?>

				<?php }?>
			</h3>
			<?php echo $_smarty_tpl->tpl_vars['customer_address']->value;?>

		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['num_order_messages']->value)) && $_smarty_tpl->tpl_vars['num_order_messages']->value) {?>
		<div class="panel">
			<h3>
				<?php if ($_smarty_tpl->tpl_vars['num_order_messages']->value == 1) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 customer service message'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d customer service messages','sprintf'=>$_smarty_tpl->tpl_vars['num_order_messages']->value),$_smarty_tpl ) );?>

				<?php }?>
			</h3>
			<?php echo $_smarty_tpl->tpl_vars['order_messages']->value;?>

		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['num_orders']->value)) && $_smarty_tpl->tpl_vars['num_orders']->value) {?>
		<div class="panel">
			<h3>
				<?php if ($_smarty_tpl->tpl_vars['num_orders']->value == 1) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 order'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d orders','sprintf'=>$_smarty_tpl->tpl_vars['num_orders']->value),$_smarty_tpl ) );?>

				<?php }?>
			</h3>
			<?php echo $_smarty_tpl->tpl_vars['orders']->value;?>

		</div>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['addons']->value)) && $_smarty_tpl->tpl_vars['addons']->value) {?>
	<div class="panel">
		<h3>
			<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['addons']->value) == 1) {?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'1 addon'),$_smarty_tpl ) );?>

			<?php } else { ?>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%d addons','sprintf'=>smarty_modifier_count($_smarty_tpl->tpl_vars['addons']->value)),$_smarty_tpl ) );?>

			<?php }?>
		</h3>
		<table class="table">
			<tbody>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['addons']->value, 'addon', false, 'key');
$_smarty_tpl->tpl_vars['addon']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['addon']->value) {
$_smarty_tpl->tpl_vars['addon']->do_else = false;
?>
				<tr>
					<td><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['addon']->value['href'], ENT_QUOTES, 'UTF-8', true);?>
&amp;utm_source=back-office&amp;utm_medium=search&amp;utm_campaign=back-office-<?php echo mb_strtoupper((string) $_smarty_tpl->tpl_vars['lang_iso']->value ?? '', 'UTF-8');?>
&amp;utm_content=<?php if ($_smarty_tpl->tpl_vars['host_mode']->value) {?>cloud<?php } else { ?>download<?php }?>" class="_blank"><strong><i class="icon-external-link-sign"></i> <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['addon']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</strong></a></td>
					<td><a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['addon']->value['href'], ENT_QUOTES, 'UTF-8', true);?>
&amp;utm_source=back-office&amp;utm_medium=search&amp;utm_campaign=back-office-<?php echo mb_strtoupper((string) $_smarty_tpl->tpl_vars['lang_iso']->value ?? '', 'UTF-8');?>
&amp;utm_content=<?php if ($_smarty_tpl->tpl_vars['host_mode']->value) {?>cloud<?php } else { ?>download<?php }?>" class="_blank"><?php if (is_string($_smarty_tpl->tpl_vars['addon']->value['description'])) {
echo htmlspecialchars((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['addon']->value['description'],256,'...' )), ENT_QUOTES, 'UTF-8', true);
}?></a></td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</tbody>
			<tfoot>
				<tr>
					<td colspan="2" class="text-center"><a href="http://addons.prestashop.com/search.php?search_query=<?php echo urlencode($_smarty_tpl->tpl_vars['query']->value);?>
&amp;utm_source=back-office&amp;utm_medium=search&amp;utm_campaign=back-office-<?php echo mb_strtoupper((string) $_smarty_tpl->tpl_vars['lang_iso']->value ?? '', 'UTF-8');?>
&amp;utm_content=<?php if ($_smarty_tpl->tpl_vars['host_mode']->value) {?>cloud<?php } else { ?>download<?php }?>" class="_blank"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Show more results...'),$_smarty_tpl ) );?>
</strong></a></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<?php }?>

<?php }?>
<div class="row">
	<div class="col-lg-4">
		<div class="panel">
			<h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search qloapps.com/blog'),$_smarty_tpl ) );?>
</h3>
			<a href="https://qloapps.com/?s=<?php echo $_smarty_tpl->tpl_vars['query']->value;?>
" class="btn btn-default _blank"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Go to the documentation'),$_smarty_tpl ) );?>
</a>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="panel">
			<h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search qloapps.com/addons'),$_smarty_tpl ) );?>
</h3>
			<a href="https://qloapps.com/addons/?add=<?php echo $_smarty_tpl->tpl_vars['query']->value;?>
" class="btn btn-default _blank"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Go to Addons'),$_smarty_tpl ) );?>
</a>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="panel">
			<h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search forums.qloapps.com'),$_smarty_tpl ) );?>
</h3>
			<a href="https://forums.qloapps.com/search?term=<?php echo $_smarty_tpl->tpl_vars['query']->value;?>
" class="btn btn-default _blank"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Go to the Forum'),$_smarty_tpl ) );?>
</a>
		</div>
	</div>
</div>




<?php }
}
