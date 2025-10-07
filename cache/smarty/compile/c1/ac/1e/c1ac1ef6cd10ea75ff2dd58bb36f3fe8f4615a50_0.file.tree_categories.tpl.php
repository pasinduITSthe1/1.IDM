<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:21
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\normal_products\helpers\tree\tree_categories.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f289f1dce4_18684536',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1ac1ef6cd10ea75ff2dd58bb36f3fe8f4615a50' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\normal_products\\helpers\\tree\\tree_categories.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f289f1dce4_18684536 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.implode.php','function'=>'smarty_modifier_implode',),));
?>
<div class="panel">
	<?php if ((isset($_smarty_tpl->tpl_vars['header']->value))) {
echo $_smarty_tpl->tpl_vars['header']->value;
}?>
	<div id="block_category_tree"<?php if (!$_smarty_tpl->tpl_vars['is_category_filter']->value) {?> style="display:none"<?php }?>>
		<?php if ((isset($_smarty_tpl->tpl_vars['nodes']->value))) {?>
		<ul id="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="cattree tree">
			<?php echo $_smarty_tpl->tpl_vars['nodes']->value;?>

		</ul>
		<?php }?>
	</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
	var currentToken="<?php echo addslashes($_smarty_tpl->tpl_vars['token']->value);?>
";
	var treeClickFunc = function() {
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		var queryString = window.location.search.replace(/&id_category=[0-9]*/, "") + "&id_category=" + $(this).val();
		location.href = newURL+queryString; // hash part is dropped: window.location.hash
	};
	<?php if ((isset($_smarty_tpl->tpl_vars['use_checkbox']->value)) && $_smarty_tpl->tpl_vars['use_checkbox']->value == true) {?>
		function checkAllAssociatedCategories($tree)
		{
			$tree.find(":input[type=checkbox]").each(
				function()
				{
					$(this).prop("checked", true);
					$(this).parent().addClass("tree-selected");
				}
			);
		}

		function uncheckAllAssociatedCategories($tree)
		{
			$tree.find(":input[type=checkbox]").each(
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
-categories-search").bind("typeahead:selected", function(obj, datum) {
		    $("#<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
").find(":input").each(
				function()
				{
					if ($(this).val() == datum.id_category)
					{
						$(this).prop("checked", true);
						$(this).parent().addClass("tree-selected");
						$(this).parents("ul.tree").each(
							function()
							{
								$(this).children().children().children(".icon-folder-close")
									.removeClass("icon-folder-close")
									.addClass("icon-folder-open");
								$(this).show();
							}
						);
					}
				}
			);
		});
	<?php }?>
	$(document).ready(function () {
		var tree = $("#<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
").tree("collapseAll");

		tree.on('collapse', function() {
			$('#expand-all-<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
').show();
		});

		tree.on('expand', function() {
			$('#collapse-all-<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
').show();
		});

		$('#collapse-all-<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
').hide();
		$("#<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
").find(":input[type=radio]").click(treeClickFunc);

		<?php if ((isset($_smarty_tpl->tpl_vars['selected_categories']->value))) {?>
			<?php $_smarty_tpl->_assignInScope('imploded_selected_categories', smarty_modifier_implode('","',$_smarty_tpl->tpl_vars['selected_categories']->value));?>
			var selected_categories = new Array("<?php echo $_smarty_tpl->tpl_vars['imploded_selected_categories']->value;?>
");

			$("#<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
").find(":input").each(
				function()
				{
					if ($.inArray($(this).val(), selected_categories) != -1)
					{
						$(this).prop("checked", true);
						$(this).parent().addClass("tree-selected");
						$(this).parents("ul.tree").each(
							function()
							{
								$(this).children().children().children(".icon-folder-close")
									.removeClass("icon-folder-close")
									.addClass("icon-folder-open");
								$(this).show();
							}
						);
					}
				}
			);
		<?php }?>
	});
<?php echo '</script'; ?>
>
<?php }
}
