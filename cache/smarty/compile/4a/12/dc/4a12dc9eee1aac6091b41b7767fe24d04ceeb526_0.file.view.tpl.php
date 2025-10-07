<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:41
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\request_sql\helpers\view\view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f29d7995e4_28175295',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a12dc9eee1aac6091b41b7767fe24d04ceeb526' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\request_sql\\helpers\\view\\view.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f29d7995e4_28175295 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_44227296668e4f29d751cb3_65513687', "override_tpl");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/view/view.tpl");
}
/* {block "override_tpl"} */
class Block_44227296668e4f29d751cb3_65513687 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'override_tpl' => 
  array (
    0 => 'Block_44227296668e4f29d751cb3_65513687',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="panel">
	<h3><i class="icon-cog"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'SQL query result'),$_smarty_tpl ) );?>
</h3>
	<?php if ((isset($_smarty_tpl->tpl_vars['view']->value['error']))) {?>
		<div class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This SQL query has no result.'),$_smarty_tpl ) );?>
</div>
	<?php } else { ?>
		<table class="table" id="viewRequestSql">
			<thead>
				<tr>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['view']->value['key'], 'key');
$_smarty_tpl->tpl_vars['key']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value) {
$_smarty_tpl->tpl_vars['key']->do_else = false;
?>
					<th><span class="title_box"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</span></th>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</tr>
			</thead>
			<tbody>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['view']->value['results'], 'result');
$_smarty_tpl->tpl_vars['result']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['result']->value) {
$_smarty_tpl->tpl_vars['result']->do_else = false;
?>
				<tr>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['view']->value['key'], 'name');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
						<?php if ((isset($_smarty_tpl->tpl_vars['view']->value['attributes'][$_smarty_tpl->tpl_vars['name']->value]))) {?>
							<td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['view']->value['attributes'][$_smarty_tpl->tpl_vars['name']->value], ENT_QUOTES, 'UTF-8', true);?>
</td>
						<?php } else { ?>
							<td><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['result']->value[$_smarty_tpl->tpl_vars['name']->value], ENT_QUOTES, 'UTF-8', true);?>
</td>
						<?php }?>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</tbody>
		</table>
	
		<?php echo '<script'; ?>
 type="text/javascript">
			$(function(){
				var width = $('#viewRequestSql').width();
				if (width > 990){
					$('#viewRequestSql').css('display','block').css('overflow-x', 'scroll');
				}
			});
		<?php echo '</script'; ?>
>
	<?php }?>
</div>
<?php
}
}
/* {/block "override_tpl"} */
}
