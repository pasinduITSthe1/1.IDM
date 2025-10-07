<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:20
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\modules_catalog\theme_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f28815f277_40445355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '32888a7d18b911335a63e65882b2397ac231581e' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\modules_catalog\\theme_list.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f28815f277_40445355 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>

<div class="suggested-elements row">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['elements']->value, 'element');
$_smarty_tpl->tpl_vars['element']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->do_else = false;
?>
        <div class="col-sm-6 col-md-6 element-panel">
            <div class="panel">
                <div class="theme-info-wrapper">
                    <div class="theme-logo clearfix">
                        <img src="<?php if ((isset($_smarty_tpl->tpl_vars['element']->value->image))) {
echo $_smarty_tpl->tpl_vars['element']->value->image;
} else {
echo $_smarty_tpl->tpl_vars['modules_uri']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['element']->value->name;?>
/<?php echo $_smarty_tpl->tpl_vars['element']->value->logo;
}?>" title="<?php echo $_smarty_tpl->tpl_vars['element']->value->displayName;?>
">

                    </div>
                    <h4 class="name" data-name="<?php echo $_smarty_tpl->tpl_vars['element']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['element']->value->displayName;?>
</h4>
                    <p class="text-muted"><?php echo $_smarty_tpl->tpl_vars['element']->value->version;?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'By'),$_smarty_tpl ) );?>
 <?php echo $_smarty_tpl->tpl_vars['element']->value->author;?>
</p>
                    <p>
                        <?php if ($_smarty_tpl->tpl_vars['element']->value->description_full) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['element']->value->description_full,180,"..." ));
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['element']->value->description,180,"..." ));
}?>
                    </p>
                    <div class="panel-action clearfix">
                        <?php if ((isset($_smarty_tpl->tpl_vars['element']->value->type)) && $_smarty_tpl->tpl_vars['element']->value->type == 'addonsMustHave') {?>
                            <span class="theme-price"><?php if ((isset($_smarty_tpl->tpl_vars['element']->value->price))) {
if (floatval($_smarty_tpl->tpl_vars['element']->value->price) == 0) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Free'),$_smarty_tpl ) );
} elseif ((isset($_smarty_tpl->tpl_vars['element']->value->id_currency))) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0], array( array('price'=>$_smarty_tpl->tpl_vars['element']->value->price,'currency'=>$_smarty_tpl->tpl_vars['element']->value->id_currency),$_smarty_tpl ) );
}
}?></span>
                            <a class="btn button-action pull-right btn-primary _blank" href="<?php echo htmlspecialchars((string)smarty_modifier_replace($_smarty_tpl->tpl_vars['element']->value->addons_buy_url,' ','+'), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Explore'),$_smarty_tpl ) );?>
</a>
                        <?php } else { ?>
                            <a class="btn button-action pull-right btn-primary" href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['element']->value->options['install_url'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Install'),$_smarty_tpl ) );?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Install'),$_smarty_tpl ) );?>
</a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div><?php }
}
