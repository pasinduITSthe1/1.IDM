<?php
/* Smarty version 4.5.5, created on 2025-10-29 12:32:04
  from 'C:\wamp64\www\1.IDM\modules\blocklanguages\views\templates\hook\external-navigation-hook.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901bbeccb3ec2_52185399',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '99dfbe1403fbfbf97447ba100936eaa01a4af56a' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\blocklanguages\\views\\templates\\hook\\external-navigation-hook.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901bbeccb3ec2_52185399 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.regex_replace.php','function'=>'smarty_modifier_regex_replace',),));
?>

<?php if (count($_smarty_tpl->tpl_vars['languages']->value) > 1) {?>
    <ul class="nav nav-pills nav-stacked visible-xs wk-nav-style">
        <li>
            <a class="btn-language-selector-popup">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
                    <?php if ($_smarty_tpl->tpl_vars['language']->value['iso_code'] == $_smarty_tpl->tpl_vars['lang_iso']->value) {?>
                        <?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['language']->value['name'],"/\s\(.*\)"."$"."/",'');?>

                        <span class="caret"></span>
                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </a>
        </li>
    </ul>

    <div id="language-selector-popup" style="display: none;">
        <div class="list-group">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language', false, 'k');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
                <?php $_smarty_tpl->_assignInScope('indice_lang', $_smarty_tpl->tpl_vars['language']->value['id_lang']);?>
                <a class="list-group-item <?php if ($_smarty_tpl->tpl_vars['language']->value['iso_code'] == $_smarty_tpl->tpl_vars['lang_iso']->value) {?>active<?php }?>"
                    <?php if ($_smarty_tpl->tpl_vars['language']->value['iso_code'] != $_smarty_tpl->tpl_vars['lang_iso']->value) {?>
                        <?php if ((isset($_smarty_tpl->tpl_vars['lang_rewrite_urls']->value[$_smarty_tpl->tpl_vars['indice_lang']->value]))) {?>
                            href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['lang_rewrite_urls']->value[$_smarty_tpl->tpl_vars['indice_lang']->value], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
"
                        <?php } else { ?>
                            href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getLanguageLink($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
"
                        <?php }?>
                    <?php }?>
                    >
                    <span><?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['language']->value['name'],"/\s\(.*\)"."$"."/",'');?>
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
