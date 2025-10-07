<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:13
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\employees\helpers\form\form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f281c76d42_11888043',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd27a29bf25aadfa12d68fdb9fdefa64ba77264af' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\employees\\helpers\\form\\form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f281c76d42_11888043 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_41918780068e4f281b43ac4_18447009', "field");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_125009405568e4f281b49408_57878294', "input");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_81811042968e4f281c3c698_64135306', 'script');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "helpers/form/form.tpl");
}
/* {block "field"} */
class Block_41918780068e4f281b43ac4_18447009 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'field' => 
  array (
    0 => 'Block_41918780068e4f281b43ac4_18447009',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

<?php
}
}
/* {/block "field"} */
/* {block "input"} */
class Block_125009405568e4f281b49408_57878294 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'input' => 
  array (
    0 => 'Block_125009405568e4f281b49408_57878294',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
?>

	<?php if ($_smarty_tpl->tpl_vars['input']->value['type'] == 'default_tab') {?>
	<select id="<?php echo $_smarty_tpl->tpl_vars['input']->value['name'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['input']->value['name'];?>
" class="chosen fixed-width-xxl">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['input']->value['options'], 'option');
$_smarty_tpl->tpl_vars['option']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->do_else = false;
?>
			<?php if ((isset($_smarty_tpl->tpl_vars['option']->value['children'])) && smarty_modifier_count($_smarty_tpl->tpl_vars['option']->value['children'])) {?>
				<optgroup label="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['option']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"></optgroup>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['option']->value['children'], 'children');
$_smarty_tpl->tpl_vars['children']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['children']->value) {
$_smarty_tpl->tpl_vars['children']->do_else = false;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['children']->value['id_tab'];?>
" <?php if ($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']] == $_smarty_tpl->tpl_vars['children']->value['id_tab']) {?>selected="selected"<?php }?>><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['children']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</option>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			<?php } else { ?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['option']->value['id_tab'];?>
" <?php if ($_smarty_tpl->tpl_vars['fields_value']->value[$_smarty_tpl->tpl_vars['input']->value['name']] == $_smarty_tpl->tpl_vars['option']->value['id_tab']) {?>selected="selected"<?php }?>><?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['option']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</option>
			<?php }?>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</select>
	<?php } else { ?>
		<?php 
$_smarty_tpl->inheritance->callParent($_smarty_tpl, $this, '{$smarty.block.parent}');
?>

	<?php }
}
}
/* {/block "input"} */
/* {block 'script'} */
class Block_81811042968e4f281c3c698_64135306 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_81811042968e4f281c3c698_64135306',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	$(document).ready(function(){
		$('select[name=id_profile]').change(function(){
			ifSuperAdmin($(this));

			$.ajax({
				url: "<?php echo addslashes($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminEmployees'));?>
",
				cache: false,
				data : {
					ajax : '1',
					action : 'getTabByIdProfile',
					id_profile : $(this).val()
				},
				dataType : 'json',
				success : function(resp,textStatus,jqXHR)
				{
					if (resp != false)
					{
						$('select[name=default_tab]').html('');
						$.each(resp, function(key, r){
							if (r.id_parent == 0)
							{
								$('select[name=default_tab]').append('<optgroup label="'+r.name+'"></optgroup>');
								$.each(r.children, function(k, value){
									$('select[name=default_tab]').append('<option value="'+r.id_tab+'">'+value.name+'</option>')
								});
							}
						});
					}
				}
			});
		});
		ifSuperAdmin($('select[name=id_profile]'));
	});

	function ifSuperAdmin(el)
	{
		var val = $(el).val();

		if (!val || val == <?php echo (defined('_PS_ADMIN_PROFILE_') ? constant('_PS_ADMIN_PROFILE_') : null);?>
)
		{
			$('.assoShop input[type=checkbox]').attr('disabled', true);
			$('.assoShop input[type=checkbox]').attr('checked', true);
		}
		else
			$('.assoShop input[type=checkbox]').attr('disabled', false);
	}
<?php
}
}
/* {/block 'script'} */
}
