<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:24
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\normal_products\multishop\check_fields.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f28c3b8b43_66729736',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87802f8bb88de64287dc3cbe297ab593f26e8582' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\normal_products\\multishop\\check_fields.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f28c3b8b43_66729736 (Smarty_Internal_Template $_smarty_tpl) {
if ((isset($_smarty_tpl->tpl_vars['display_multishop_checkboxes']->value)) && $_smarty_tpl->tpl_vars['display_multishop_checkboxes']->value) {?>
	<div class="panel clearfix">
		<label class="control-label col-lg-3">
			<i class="icon-sitemap"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Multistore'),$_smarty_tpl ) );?>

		</label>
		<div class="col-lg-9">
			<div class="row">
				<div class="col-lg-4">
					<span class="switch prestashop-switch">
						<input type="radio" name="multishop_<?php echo $_smarty_tpl->tpl_vars['product_tab']->value;?>
" id="multishop_<?php echo $_smarty_tpl->tpl_vars['product_tab']->value;?>
_on" value="1" onclick="$('#product-tab-content-<?php echo $_smarty_tpl->tpl_vars['product_tab']->value;?>
 input[name^=\'multishop_check[\']').attr('checked', true); ProductMultishop.checkAll<?php echo $_smarty_tpl->tpl_vars['product_tab']->value;?>
()">
						<label for="multishop_<?php echo $_smarty_tpl->tpl_vars['product_tab']->value;?>
_on">
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes'),$_smarty_tpl ) );?>

						</label>
						<input type="radio" name="multishop_<?php echo $_smarty_tpl->tpl_vars['product_tab']->value;?>
" id="multishop_<?php echo $_smarty_tpl->tpl_vars['product_tab']->value;?>
_off" value="0" checked="checked" onclick="$('#product-tab-content-<?php echo $_smarty_tpl->tpl_vars['product_tab']->value;?>
 input[name^=\'multishop_check[\']').attr('checked', false); ProductMultishop.checkAll<?php echo $_smarty_tpl->tpl_vars['product_tab']->value;?>
()">
						<label for="multishop_<?php echo $_smarty_tpl->tpl_vars['product_tab']->value;?>
_off">
							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No'),$_smarty_tpl ) );?>

						</label>
						<a class="slide-button btn"></a>
					</span>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p class="help-block">
						<strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check / Uncheck all'),$_smarty_tpl ) );?>
</strong> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(If you are editing this page for several shops, some fields may be disabled. If you need to edit them, you will need to check the box for each field)'),$_smarty_tpl ) );?>

					</p>
				</div>
			</div>
		</div>
	</div>
<?php }
}
}
