<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:19
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\modules_catalog\modules_list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f287d69156_30694394',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0a58327506dfef98cd23a49cc918ad66ff546e41' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\modules_catalog\\modules_list.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f287d69156_30694394 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>

<div class="suggested-elements row">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['elements']->value, 'element');
$_smarty_tpl->tpl_vars['element']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['element']->value) {
$_smarty_tpl->tpl_vars['element']->do_else = false;
?>
        <div class="col-xs-12 col-sm-6 col-md-4 element-panel">
            <div class="panel">
                <div class="module-info-wrapper">
                    <div class="module-logo">
                        <img src="<?php if ((isset($_smarty_tpl->tpl_vars['element']->value->image))) {
echo $_smarty_tpl->tpl_vars['element']->value->image;
} else {
echo $_smarty_tpl->tpl_vars['modules_uri']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['element']->value->name;?>
/<?php echo $_smarty_tpl->tpl_vars['element']->value->logo;
}?>" title="<?php echo $_smarty_tpl->tpl_vars['element']->value->displayName;?>
">
                        <div>
                            <h4 class="name" data-name="<?php echo $_smarty_tpl->tpl_vars['element']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['element']->value->displayName;?>
</h4>
                            <p class="text-muted"><?php echo $_smarty_tpl->tpl_vars['element']->value->version;?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'By'),$_smarty_tpl ) );?>
 <?php echo $_smarty_tpl->tpl_vars['element']->value->author;?>
</p>
                        </div>
                    </div>
                    <p>
                        <?php if ($_smarty_tpl->tpl_vars['element']->value->description_full) {?>
                            <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['element']->value->description_full,90,"..." ));?>

                        <?php } else { ?>
                            <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['element']->value->description,90,"..." ));?>

                        <?php }?>
                    </p>
                    <div class="panel-action clearfix">
                        <span class="module-price"><?php if ((isset($_smarty_tpl->tpl_vars['element']->value->price))) {
if (floatval($_smarty_tpl->tpl_vars['element']->value->price) == 0) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Free'),$_smarty_tpl ) );
} else {
echo $_smarty_tpl->tpl_vars['element']->value->price_formatted;
}
} else {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Free'),$_smarty_tpl ) );
}?></span>
                        <?php if ((isset($_smarty_tpl->tpl_vars['element']->value->type)) && $_smarty_tpl->tpl_vars['element']->value->type == 'addonsMustHave' && !$_smarty_tpl->tpl_vars['element']->value->not_on_disk) {?>&nbsp;<span class="label label-primary"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'In Module Directory'),$_smarty_tpl ) );?>
</span><?php }?>
                        <?php if ((isset($_smarty_tpl->tpl_vars['element']->value->type)) && $_smarty_tpl->tpl_vars['element']->value->type == 'addonsMustHave' && $_smarty_tpl->tpl_vars['element']->value->not_on_disk) {?>
                            <a class="btn button-action pull-right btn-primary _blank" href="<?php echo htmlspecialchars((string)smarty_modifier_replace($_smarty_tpl->tpl_vars['element']->value->addons_buy_url,' ','+'), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Explore'),$_smarty_tpl ) );?>
</a>
                        <?php } else { ?>
                            <a class="btn button-action pull-right btn-primary<?php if (!$_smarty_tpl->tpl_vars['element']->value->trusted) {?> untrustedaddon<?php }?>" <?php if (!$_smarty_tpl->tpl_vars['element']->value->trusted) {?> data-target="#moduleNotTrusted"  data-toggle="modal"<?php }?> data-link="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['element']->value->options['install_url'], ENT_QUOTES, 'UTF-8', true);?>
" data-module-display-name="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['element']->value->displayName, ENT_QUOTES, 'UTF-8', true);?>
" data-module-name="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['element']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" data-module-image="<?php if ((isset($_smarty_tpl->tpl_vars['element']->value->image))) {
echo $_smarty_tpl->tpl_vars['element']->value->image;
} else {
echo $_smarty_tpl->tpl_vars['modules_uri']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['element']->value->name;?>
/<?php echo $_smarty_tpl->tpl_vars['element']->value->logo;
}?>" data-author-name="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['element']->value->author, ENT_QUOTES, 'UTF-8', true);?>
" data-author-uri="<?php if ((isset($_smarty_tpl->tpl_vars['element']->value->author_uri))) {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['element']->value->author_uri, ENT_QUOTES, 'UTF-8', true);
}?>" href="<?php if (!$_smarty_tpl->tpl_vars['element']->value->trusted) {?>#<?php } else {
echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['element']->value->options['install_url'], ENT_QUOTES, 'UTF-8', true);
}?>" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Install'),$_smarty_tpl ) );?>
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
