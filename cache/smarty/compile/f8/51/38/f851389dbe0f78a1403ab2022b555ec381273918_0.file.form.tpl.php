<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:44
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\tags\helpers\form\form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a09bf356_90100819',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f851389dbe0f78a1403ab2022b555ec381273918' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\tags\\helpers\\form\\form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a09bf356_90100819 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_83805857968e4f2a0992a27_17416841', "other_input");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/form/form.tpl");
}
/* {block "other_input"} */
class Block_83805857968e4f2a0992a27_17416841 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'other_input' => 
  array (
    0 => 'Block_83805857968e4f2a0992a27_17416841',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php if ($_smarty_tpl->tpl_vars['key']->value == 'selects') {?>
<div class="row">
	<label class="control-label col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Products:'),$_smarty_tpl ) );?>
</label>

	<div class="col-lg-9">
		<div class="row">
			<div class="col-lg-6">
				<select multiple id="select_left">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['field']->value['products_unselected'], 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</option>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</select>
				<a href="#" id="move_to_right" class="btn btn-default btn-block multiple_select_add">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Add'),$_smarty_tpl ) );?>
 <i class="icon-arrow-right"></i>
				</a>
			</div>
			<div class="col-lg-6">
				<select multiple id="select_right" name="products[]">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['field']->value['products'], 'product');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
					<option selected="selected" value="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</option>
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</select>
				<a href="#" id="move_to_left" class="btn btn-default btn-block multiple_select_remove">
					<i class="icon-arrow-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove'),$_smarty_tpl ) );?>

				</a>
			</div>
		</div>
	</div>
</div>


	<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function(){
		$('#move_to_right').click(function(){
			return !$('#select_left option:selected').remove().appendTo('#select_right');
		})
		$('#move_to_left').click(function(){
			return !$('#select_right option:selected').remove().appendTo('#select_left');
		});
		$('#select_left option').live('dblclick', function(){
			$(this).remove().appendTo('#select_right');
		});
		$('#select_right option').live('dblclick', function(){
			$(this).remove().appendTo('#select_left');
		});
	});
	$('#tag_form').submit(function()
	{
		$('#select_right option').each(function(i){
			$(this).attr("selected", "selected");
		});
	});
	<?php echo '</script'; ?>
>
	<?php }
}
}
/* {/block "other_input"} */
}
