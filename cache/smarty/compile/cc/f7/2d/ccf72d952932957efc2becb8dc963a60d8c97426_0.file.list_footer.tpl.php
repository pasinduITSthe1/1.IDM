<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:35
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\products\combination\helpers\list\list_footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f297b3c425_13533663',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ccf72d952932957efc2becb8dc963a60d8c97426' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\products\\combination\\helpers\\list\\list_footer.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f297b3c425_13533663 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_145292658768e4f297b28d79_40744303', "after");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_198888751968e4f297b394f4_82657882', "endForm");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/list/list_footer.tpl");
}
/* {block "after"} */
class Block_145292658768e4f297b28d79_40744303 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'after' => 
  array (
    0 => 'Block_145292658768e4f297b28d79_40744303',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="alert alert-info" style="display:block">
		<ul>
			<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The blue row indicates the default combination.'),$_smarty_tpl ) );?>
</li>
			<li><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Each product that has combinations must have one default combination.'),$_smarty_tpl ) );?>
</li>
		</ul>
	</div>
<?php
}
}
/* {/block "after"} */
/* {block "endForm"} */
class Block_198888751968e4f297b394f4_82657882 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'endForm' => 
  array (
    0 => 'Block_198888751968e4f297b394f4_82657882',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php
}
}
/* {/block "endForm"} */
}
