<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:11
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\customer_threads\helpers\list\list_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27fde80d5_30188510',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14e5a4067328c934edf64959d546ad18f85661a6' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\customer_threads\\helpers\\list\\list_header.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27fde80d5_30188510 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_64263570568e4f27fdc03e5_54093999', "list_filter_items");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/list/list_header.tpl");
}
/* {block "list_filter_items"} */
class Block_64263570568e4f27fdc03e5_54093999 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'list_filter_items' => 
  array (
    0 => 'Block_64263570568e4f27fdc03e5_54093999',
  ),
);
public $append = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="pull-right col-xs-4 col-sm-3 col-md-2 col-lg-2">
		<div class="list_availibility_container">
			<button type="button" class="btn btn-default btn-left btn-block dropdown-toggle" data-toggle="dropdown" data-target="MeaningStatus">
				<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Thread Statuses'),$_smarty_tpl ) );?>

				<i class="icon-caret-down pull-right"></i>
			</button>
			<div id="MeaningStatus" class="dropdown-menu">
				<ul class="list-unstyled">
					<li><p><i class="icon-circle text-success"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Open'),$_smarty_tpl ) );?>
</p></li>
					<li><p><i class="icon-circle text-danger"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Closed'),$_smarty_tpl ) );?>
</p></li>
					<li><p><i class="icon-circle text-warning"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pending 1'),$_smarty_tpl ) );?>
</p></li>
					<li><p><i class="icon-circle text-warning"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pending 2'),$_smarty_tpl ) );?>
</p></li>
				</ul>
			</div>
		</div>
	</div>
<?php
}
}
/* {/block "list_filter_items"} */
}
