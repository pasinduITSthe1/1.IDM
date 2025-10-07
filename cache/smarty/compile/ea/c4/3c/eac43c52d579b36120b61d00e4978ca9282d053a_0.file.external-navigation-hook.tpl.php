<?php
/* Smarty version 4.5.5, created on 2025-10-07 16:33:11
  from 'C:\wamp64\www\1.IDM\modules\blockcurrencies\views\templates\hook\external-navigation-hook.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f36f8ee420_63980672',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eac43c52d579b36120b61d00e4978ca9282d053a' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\blockcurrencies\\views\\templates\\hook\\external-navigation-hook.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f36f8ee420_63980672 (Smarty_Internal_Template $_smarty_tpl) {
if (count($_smarty_tpl->tpl_vars['currencies']->value) > 1) {?>
    <ul class="nav nav-pills nav-stacked visible-xs wk-nav-style">
        <li>
            <a class="btn-currency-selector-popup">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currencies']->value, 'currency');
$_smarty_tpl->tpl_vars['currency']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['currency']->value) {
$_smarty_tpl->tpl_vars['currency']->do_else = false;
?>
                    <?php if ($_smarty_tpl->tpl_vars['cookie']->value->id_currency == $_smarty_tpl->tpl_vars['currency']->value['id_currency']) {?>
                        <?php echo $_smarty_tpl->tpl_vars['currency']->value['iso_code'];?>

                        <span class="caret"></span>
                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </a>
        </li>
    </ul>

    <div id="currency-selector-popup" style="display: none;">
        <div class="list-group">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currencies']->value, 'currency');
$_smarty_tpl->tpl_vars['currency']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['currency']->value) {
$_smarty_tpl->tpl_vars['currency']->do_else = false;
?>
                <?php if (strpos($_smarty_tpl->tpl_vars['currency']->value['name'],('(').($_smarty_tpl->tpl_vars['currency']->value['iso_code']).(')')) === false) {?>
                    <?php ob_start();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%s (%s)','sprintf'=>array($_smarty_tpl->tpl_vars['currency']->value['name'],$_smarty_tpl->tpl_vars['currency']->value['iso_code'])),$_smarty_tpl ) );
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->_assignInScope('currency_name', $_prefixVariable1);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->_assignInScope('currency_name', $_smarty_tpl->tpl_vars['currency']->value['name']);?>
                <?php }?>

                <a class="list-group-item <?php if ($_smarty_tpl->tpl_vars['cookie']->value->id_currency == $_smarty_tpl->tpl_vars['currency']->value['id_currency']) {?>active<?php }?>"
                    href="javascript:setCurrency(<?php echo $_smarty_tpl->tpl_vars['currency']->value['id_currency'];?>
);"
                    rel="nofollow"
                    title="<?php echo $_smarty_tpl->tpl_vars['currency_name']->value;?>
">
                    <span><?php echo $_smarty_tpl->tpl_vars['currency_name']->value;?>
</span>
                </a>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    </div>
<?php }
}
}
