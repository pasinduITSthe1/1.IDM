<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:09
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\categories\helpers\list\list_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27db95908_45953607',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0801b6ee08818d2639ee3a71e1c2b8fad5a2821' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\categories\\helpers\\list\\list_header.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f27db95908_45953607 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_112566133268e4f27da0caf4_76986836', 'override_header');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_104932800868e4f27dacd156_84433553', 'leadin');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/list/list_header.tpl");
}
/* {block 'override_header'} */
class Block_112566133268e4f27da0caf4_76986836 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'override_header' => 
  array (
    0 => 'Block_112566133268e4f27da0caf4_76986836',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<ul class="breadcrumb cat_bar2">
		<?php $_smarty_tpl->_assignInScope('i', 0);?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories_tree']->value, 'category', false, 'key');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
?>
		<li>
			<?php if ($_smarty_tpl->tpl_vars['i']->value++ == 0) {?>
				<i class="icon-home"></i>
				<?php $_smarty_tpl->_assignInScope('params_url', '');?>
			<?php } elseif ((isset($_smarty_tpl->tpl_vars['category']->value['id_category']))) {?>
				<?php ob_start();
echo intval($_smarty_tpl->tpl_vars['category']->value['id_category']);
$_prefixVariable3=ob_get_clean();
$_smarty_tpl->_assignInScope('params_url', "&id_category=".$_prefixVariable3."&viewcategory");?>
			<?php }?>
			<?php if ((isset($_smarty_tpl->tpl_vars['category']->value['id_category'])) && $_smarty_tpl->tpl_vars['category']->value['id_category'] == $_smarty_tpl->tpl_vars['categories_tree_current_id']->value) {?>
				<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

			<?php } else { ?>
				<a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['current']->value, ENT_QUOTES, 'UTF-8', true);
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['params_url']->value, ENT_QUOTES, 'UTF-8', true);?>
&amp;token=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['token']->value, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['category']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
			<?php }?>
		</li>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ul>
<?php
}
}
/* {/block 'override_header'} */
/* {block 'leadin'} */
class Block_104932800868e4f27dacd156_84433553 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'leadin' => 
  array (
    0 => 'Block_104932800868e4f27dacd156_84433553',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php if ((isset($_smarty_tpl->tpl_vars['delete_category']->value)) && $_smarty_tpl->tpl_vars['delete_category']->value) {?>
		<div class="panel">
			<form action="<?php echo $_smarty_tpl->tpl_vars['REQUEST_URI']->value;?>
" method="post">
			<div class="panel-heading">
				<?php if ($_smarty_tpl->tpl_vars['need_delete_mode']->value) {?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'What do you want to do with the products associated with this category?'),$_smarty_tpl ) );?>

				<?php } else { ?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Deleting multiple categories'),$_smarty_tpl ) );?>

				<?php }?>
			</div>

			<?php if ($_smarty_tpl->tpl_vars['need_delete_mode']->value) {?>
				<div class="radio">
					<label for="deleteMode_linkanddisable">
						<input type="radio" name="deleteMode" value="linkanddisable" id="deleteMode_linkanddisable" checked="checked" />
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'I want to associate the products without other categories to the parent category, then disable these products for now. I re-enable them when they are moved in their new category.'),$_smarty_tpl ) );?>
 <strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Recommended)'),$_smarty_tpl ) );?>
</strong>
					</label>
				</div>
				<div class="radio">
					<label for="deleteMode_link">
						<input type="radio" name="deleteMode" value="link" id="deleteMode_link" />
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'I want to associate the products without other categories to the parent category, and keep them enabled.'),$_smarty_tpl ) );?>

					</label>
				</div>
				<div class="radio">
					<label for="deleteMode_delete">
						<input type="radio" name="deleteMode" value="delete" id="deleteMode_delete" />
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'I want to remove the products which are listed only within this category and no others.'),$_smarty_tpl ) );?>

					</label>
				</div>
			<?php } else { ?>
				<div class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Deleting this category will remove products linked only within this category and no others. Are you sure you want to continue?'),$_smarty_tpl ) );?>
</div>
				<input type="hidden" name="deleteMode" value="delete" id="deleteMode_delete" />

			<?php }?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['POST']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
				<?php if ($_smarty_tpl->tpl_vars['key']->value != 'deleteMode') {?>
					<?php if (is_array($_smarty_tpl->tpl_vars['value']->value)) {?>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value']->value, 'val');
$_smarty_tpl->tpl_vars['val']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->do_else = false;
?>
							<input type="hidden" name="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true);?>
[]" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['val']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
						<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<?php } else { ?>
						<input type="hidden" name="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8', true);?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
					<?php }?>
				<?php }?>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<div class="panel-footer">
					<button type="submit" name="cancel" class="btn btn-default">
						<i class="icon-remove"></i>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel'),$_smarty_tpl ) );?>

					</button>
					<button type="submit" class="btn btn-default">
						<i class="icon-trash text-danger"></i>
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete'),$_smarty_tpl ) );?>

					</button>
				</div>
			</form>
		</div>
	<?php }
}
}
/* {/block 'leadin'} */
}
