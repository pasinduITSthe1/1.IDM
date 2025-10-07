<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:52
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\helpers\tree\tree_toolbar_search.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a816d411_40429633',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2652f3a5d25d47ba4df82ab550180eaac9e31a4b' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\helpers\\tree\\tree_toolbar_search.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a816d411_40429633 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- <label for="node-search"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>$_smarty_tpl->tpl_vars['label']->value),$_smarty_tpl ) );?>
</label> -->
<div class="pull-right">
	<input type="text"
		<?php if ((isset($_smarty_tpl->tpl_vars['id']->value))) {?>id="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>
		<?php if ((isset($_smarty_tpl->tpl_vars['name']->value))) {?>name="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>
		class="search-field<?php if ((isset($_smarty_tpl->tpl_vars['class']->value))) {?> <?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['class']->value, ENT_QUOTES, 'UTF-8', true);
}?>"
		placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'search...'),$_smarty_tpl ) );?>
" />
</div>

<?php if ((isset($_smarty_tpl->tpl_vars['typeahead_source']->value)) && (isset($_smarty_tpl->tpl_vars['id']->value))) {?>

<?php echo '<script'; ?>
 type="text/javascript">
	$(function() {

		function startTypeahead() {
			if (typeof $.fn.typeahead === 'undefined') {
				setTimeout(startTypeahead, 100);
				return;
			}
			$("#<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
").typeahead(
			{
				name: "<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
",
				valueKey: 'name',
				local: [<?php echo $_smarty_tpl->tpl_vars['typeahead_source']->value;?>
]
			});

			$("#<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8', true);?>
").keypress(function (event) {
				if (event.which == 13) {
					event.stopPropagation();
				}
			});
		}

		startTypeahead();
	});
<?php echo '</script'; ?>
>
<?php }
}
}
