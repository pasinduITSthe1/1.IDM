<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:08
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\cart_rules\form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f27c8b2d14_27793029',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8d0a8ae361678a3a401dd5121908dfbd1139fae8' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\cart_rules\\form.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:controllers/cart_rules/informations.tpl' => 1,
    'file:controllers/cart_rules/conditions.tpl' => 1,
    'file:controllers/cart_rules/actions.tpl' => 1,
    'file:footer_toolbar.tpl' => 1,
  ),
),false)) {
function content_68e4f27c8b2d14_27793029 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="panel">
	<h3><i class="icon-tag"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cart rule'),$_smarty_tpl ) );?>
</h3>
	<div class="productTabs">
		<ul class="tab nav nav-tabs">
			<li class="tab-row">
				<a class="tab-page" id="cart_rule_link_informations" href="javascript:displayCartRuleTab('informations');"><i class="icon-info"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Information'),$_smarty_tpl ) );?>
</a>
			</li>
			<li class="tab-row">
				<a class="tab-page" id="cart_rule_link_conditions" href="javascript:displayCartRuleTab('conditions');"><i class="icon-random"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Conditions'),$_smarty_tpl ) );?>
</a>
			</li>
			<li class="tab-row">
				<a class="tab-page" id="cart_rule_link_actions" href="javascript:displayCartRuleTab('actions');"><i class="icon-wrench"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Actions'),$_smarty_tpl ) );?>
</a>
			</li>
		</ul>
	</div>
	<form action="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['currentIndex']->value, ENT_QUOTES, 'UTF-8', true);?>
&amp;token=<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['currentToken']->value, ENT_QUOTES, 'UTF-8', true);?>
&amp;addcart_rule" id="cart_rule_form" class="form-horizontal" method="post">
		<?php if ($_smarty_tpl->tpl_vars['currentObject']->value->id) {?><input type="hidden" name="id_cart_rule" value="<?php echo intval($_smarty_tpl->tpl_vars['currentObject']->value->id);?>
" /><?php }?>
		<input type="hidden" id="currentFormTab" name="currentFormTab" value="<?php if ((isset($_POST['currentFormTab']))) {
echo preg_replace("%(?<!\\\\)'%", "\'", (string)$_POST['currentFormTab']);
} else { ?>informations<?php }?>" />
		<div id="cart_rule_informations" class="panel cart_rule_tab">
			<?php $_smarty_tpl->_subTemplateRender('file:controllers/cart_rules/informations.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		</div>
		<div id="cart_rule_conditions" class="panel cart_rule_tab">
			<?php $_smarty_tpl->_subTemplateRender('file:controllers/cart_rules/conditions.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		</div>
		<div id="cart_rule_actions" class="panel cart_rule_tab">
			<?php $_smarty_tpl->_subTemplateRender('file:controllers/cart_rules/actions.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		</div>
		<button type="submit" class="btn btn-default pull-right" name="submitAddcart_rule" id="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['table']->value, ENT_QUOTES, 'UTF-8', true);?>
_form_submit_btn"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save'),$_smarty_tpl ) );?>

		</button>
		<!--<input type="submit" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save and stay'),$_smarty_tpl ) );?>
" class="button" name="submitAddcart_ruleAndStay" id="" />-->
	</form>

	<?php echo '<script'; ?>
 type="text/javascript">
		var product_rule_groups_counter = <?php if ((isset($_smarty_tpl->tpl_vars['product_rule_groups_counter']->value))) {
echo intval($_smarty_tpl->tpl_vars['product_rule_groups_counter']->value);
} else { ?>0<?php }?>;
		var product_rule_counters = new Array();
		var currentToken = '<?php echo preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['currentToken']->value);?>
';
		var currentFormTab = '<?php if ((isset($_POST['currentFormTab']))) {
echo preg_replace("%(?<!\\\\)'%", "\'", (string)$_POST['currentFormTab']);
} else { ?>informations<?php }?>';
		var currentText = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Now','js'=>1),$_smarty_tpl ) );?>
';
		var closeText = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Done','js'=>1),$_smarty_tpl ) );?>
';
		var timeOnlyTitle = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Choose Time','js'=>1),$_smarty_tpl ) );?>
';
		var timeText = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Time','js'=>1),$_smarty_tpl ) );?>
';
		var hourText = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Hour','js'=>1),$_smarty_tpl ) );?>
';
		var minuteText = '<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Minute','js'=>1),$_smarty_tpl ) );?>
';

		var languages = new Array();
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language', false, 'k');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
			languages[<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
] = {
				id_lang: <?php echo $_smarty_tpl->tpl_vars['language']->value['id_lang'];?>
,
				iso_code: '<?php echo preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['language']->value['iso_code']);?>
',
				name: '<?php echo preg_replace("%(?<!\\\\)'%", "\'", (string)$_smarty_tpl->tpl_vars['language']->value['name']);?>
'
			};
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		displayFlags(languages, <?php echo $_smarty_tpl->tpl_vars['id_lang_default']->value;?>
);
	<?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="themes/default/template/controllers/cart_rules/form.js"><?php echo '</script'; ?>
>
	<?php $_smarty_tpl->_subTemplateRender("file:footer_toolbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</div>
<?php }
}
