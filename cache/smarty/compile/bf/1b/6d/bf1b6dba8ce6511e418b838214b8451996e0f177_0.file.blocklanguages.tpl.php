<?php
/* Smarty version 4.5.5, created on 2025-10-29 12:32:31
  from 'C:\wamp64\www\1.IDM\modules\blocklanguages\views\templates\hook\blocklanguages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_6901bc075b7f56_66878426',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bf1b6dba8ce6511e418b838214b8451996e0f177' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\blocklanguages\\views\\templates\\hook\\blocklanguages.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901bc075b7f56_66878426 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8411602046901bc07575b67_41507438', 'block_languages');
?>

<?php }
/* {block 'block_languages'} */
class Block_8411602046901bc07575b67_41507438 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'block_languages' => 
  array (
    0 => 'Block_8411602046901bc07575b67_41507438',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\1.IDM\\tools\\smarty\\plugins\\modifier.regex_replace.php','function'=>'smarty_modifier_regex_replace',),));
?>

    <?php if (count($_smarty_tpl->tpl_vars['languages']->value) > 1) {?>
        <div id="languages-block-top" class="languages-block-wrap nav-main-item-right hidden-xs pull-right">
            <div class="dropdown">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language', false, 'k');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
                    <?php if ($_smarty_tpl->tpl_vars['language']->value['iso_code'] == $_smarty_tpl->tpl_vars['lang_iso']->value) {?>
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                            <?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['language']->value['name'],"/\s\(.*\)"."$"."/",'');?>

                            <span class="caret"></span>
                        </button>
                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                <ul class="dropdown-menu">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language', false, 'k');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
                        <li <?php if ($_smarty_tpl->tpl_vars['language']->value['iso_code'] == $_smarty_tpl->tpl_vars['lang_iso']->value) {?>class="disabled"<?php }?>>
                            <?php $_smarty_tpl->_assignInScope('indice_lang', $_smarty_tpl->tpl_vars['language']->value['id_lang']);?>
                            <?php if ((isset($_smarty_tpl->tpl_vars['lang_rewrite_urls']->value[$_smarty_tpl->tpl_vars['indice_lang']->value]))) {?>
                                <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['lang_rewrite_urls']->value[$_smarty_tpl->tpl_vars['indice_lang']->value], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
">
                            <?php } else { ?>
                                <a href="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['link']->value->getLanguageLink($_smarty_tpl->tpl_vars['language']->value['id_lang']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo $_smarty_tpl->tpl_vars['language']->value['name'];?>
">
                            <?php }?>
                                <span><?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['language']->value['name'],"/\s\(.*\)"."$"."/",'');?>
</span>
                            </a>
                        </li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
            </div>
        </div>
    <?php }
}
}
/* {/block 'block_languages'} */
}
