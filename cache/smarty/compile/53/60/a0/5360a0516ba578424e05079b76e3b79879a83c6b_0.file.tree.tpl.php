<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:51
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\helpers\tree\tree.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a72457e7_94987686',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5360a0516ba578424e05079b76e3b79879a83c6b' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\helpers\\tree\\tree.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a72457e7_94987686 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_175390065768e4f2a71c03b8_09488909', "tree_panel");
?>

<?php echo '<script'; ?>
 type="text/javascript">
	<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_27145450368e4f2a71ea5c1_74506271', "script");
?>

<?php echo '</script'; ?>
><?php }
/* {block "tree_header"} */
class Block_97339410168e4f2a71c5d48_76697969 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php if ((isset($_smarty_tpl->tpl_vars['header']->value))) {
echo $_smarty_tpl->tpl_vars['header']->value;
}?>
		<?php
}
}
/* {/block "tree_header"} */
/* {block "tree"} */
class Block_100698531868e4f2a71d1a27_76994963 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			<?php if ((isset($_smarty_tpl->tpl_vars['nodes']->value))) {?>
				<ul id="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="tree top cattree" style="max-height: <?php echo $_smarty_tpl->tpl_vars['max_height']->value;?>
px;">
				<?php echo $_smarty_tpl->tpl_vars['nodes']->value;?>

				</ul>
			<?php }?>
		<?php
}
}
/* {/block "tree"} */
/* {block "tree_panel"} */
class Block_175390065768e4f2a71c03b8_09488909 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'tree_panel' => 
  array (
    0 => 'Block_175390065768e4f2a71c03b8_09488909',
  ),
  'tree_header' => 
  array (
    0 => 'Block_97339410168e4f2a71c5d48_76697969',
  ),
  'tree' => 
  array (
    0 => 'Block_100698531868e4f2a71d1a27_76994963',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


	<div class="panel">
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_97339410168e4f2a71c5d48_76697969', "tree_header", $this->tplIndex);
?>

		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_100698531868e4f2a71d1a27_76994963', "tree", $this->tplIndex);
?>

	</div>
<?php
}
}
/* {/block "tree_panel"} */
/* {block "script"} */
class Block_27145450368e4f2a71ea5c1_74506271 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_27145450368e4f2a71ea5c1_74506271',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

		<?php if ((isset($_smarty_tpl->tpl_vars['use_checkbox']->value)) && $_smarty_tpl->tpl_vars['use_checkbox']->value == true) {?>
			function checkAll($tree)
			{
				$tree.find(":input[type=checkbox]:not([hidden])").each(
					function()
					{
						$(this).prop("checked", true);
						$(this).parent().addClass("tree-selected");
					}
				);
			}

			function uncheckAll($tree)
			{
				$tree.find(":input[type=checkbox]:not([hidden])").each(
					function()
					{
						$(this).prop("checked", false);
						$(this).parent().removeClass("tree-selected");
					}
				);
			}
		<?php }?>
		<?php if ((isset($_smarty_tpl->tpl_vars['use_search']->value)) && $_smarty_tpl->tpl_vars['use_search']->value == true) {?>
			$("#<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
-search").bind("typeahead:selected", function(obj, datum) {
				var suffix = '<?php if ((isset($_smarty_tpl->tpl_vars['use_checkbox']->value)) && $_smarty_tpl->tpl_vars['use_checkbox']->value == true) {?>[]<?php }?>';
				$("#<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
").find('[name="'+datum.input_name + suffix + '"]:input').each(
					function()
					{
						if ($(this).val() == datum.value)
						{
							<?php if ((!((isset($_smarty_tpl->tpl_vars['use_checkbox']->value)) && $_smarty_tpl->tpl_vars['use_checkbox']->value == true))) {?>
								$("#<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
 label").removeClass("tree-selected");
							<?php }?>
							$(this).prop("checked", true);
							$(this).parent().addClass("tree-selected");
							$(this).parents('ul.tree').each(function(){
								$(this).show();
								$(this).prev().find('.icon-folder-close').removeClass('icon-folder-close').addClass('icon-folder-open');
							});

							<?php if ((isset($_smarty_tpl->tpl_vars['auto_select_children']->value)) && $_smarty_tpl->tpl_vars['auto_select_children']->value == true) {?>
								if ($(this).closest('.tree-item').length == 0) {
									$(this).closest('.tree-folder').find(':input[type=checkbox]').each(function(){
										$(this).prop('checked', true);
										$(this).parent().addClass('tree-selected');
									});
								}
							<?php }?>
						}
					}
				);
			});
		<?php }?>

		<?php if ((isset($_smarty_tpl->tpl_vars['auto_select_children']->value)) && $_smarty_tpl->tpl_vars['auto_select_children']->value == true) {?>
			$('#<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
').find(':input[type=checkbox]').on('click', function(){
				if ($(this).closest('.tree-item').length == 0) {
					if ($(this).is(":checked")) {
						$(this).closest('.tree-folder').find(':input[type=checkbox]').each(function(){
							$(this).prop('checked', true);
							$(this).parent().addClass('tree-selected');
						});
					} else {
						$(this).closest('.tree-folder').find(':input[type=checkbox]').each(function(){
							$(this).prop('checked', false);
							$(this).parent().removeClass('tree-selected');
						});
					}
				}

				if ($(this).closest('.tree-item').length) {
					if (!$(this).is(":checked")) {
						$(this).parents('.tree-folder').find(':input[type=checkbox]:first').each(function(){
							$(this).prop('checked', false);
							$(this).parent().removeClass('tree-selected');
						});
					}
				}
			});
		<?php }?>

		function startTree(idElem) {
			if (typeof $.fn.tree === 'undefined') {
				setTimeout(startTree, 100);
				return;
			}

			let tree = $("#"+idElem).tree('collapseAll');
			if ($("#"+idElem).find(":input:checked").length > 1)
					$('#expand-all-'+idElem).hide();
				else
					$('#collapse-all-'+idElem).hide();

			$("#"+idElem).find(":input:checked").each(function(){
				$(this).parent().addClass("tree-selected");
				$(this).parents('ul.tree').each(function(){
					$(this).show();
					$(this).prev().find('.icon-folder-close').removeClass('icon-folder-close').addClass('icon-folder-open');
				});
			});
		}

		$(document).ready(function () {
			startTree("<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
");
		});
	<?php
}
}
/* {/block "script"} */
}
