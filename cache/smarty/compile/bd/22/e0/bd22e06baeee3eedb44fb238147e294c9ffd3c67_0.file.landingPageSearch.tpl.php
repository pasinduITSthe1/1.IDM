<?php
/* Smarty version 4.5.5, created on 2025-10-07 16:33:16
  from 'C:\wamp64\www\1.IDM\modules\wkroomsearchblock\views\templates\hook\landingPageSearch.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f37449e450_96029949',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd22e06baeee3eedb44fb238147e294c9ffd3c67' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\wkroomsearchblock\\views\\templates\\hook\\landingPageSearch.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./searchForm.tpl' => 1,
  ),
),false)) {
function content_68e4f37449e450_96029949 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_104871352668e4f374485076_42096970', 'landing_page_search_panel');
?>

<?php }
/* {block 'search_form'} */
class Block_118843047568e4f3744925e2_42277683 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <?php $_smarty_tpl->_subTemplateRender("file:./searchForm.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                            <?php
}
}
/* {/block 'search_form'} */
/* {block 'landing_page_search_panel'} */
class Block_104871352668e4f374485076_42096970 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'landing_page_search_panel' => 
  array (
    0 => 'Block_104871352668e4f374485076_42096970',
  ),
  'search_form' => 
  array (
    0 => 'Block_118843047568e4f3744925e2_42277683',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((isset($_smarty_tpl->tpl_vars['is_index_page']->value)) && $_smarty_tpl->tpl_vars['is_index_page']->value) {?>
        <div class="header-rmsearch-container header-rmsearch-hide-xs hidden-xs">
            <?php if ((isset($_smarty_tpl->tpl_vars['hotels_info']->value)) && count($_smarty_tpl->tpl_vars['hotels_info']->value)) {?>
                <div class="header-rmsearch-wrapper" id="xs_room_search_form">
                    <div class="header-rmsearch-primary">
                        <div class="fancy_search_header_xs" style="display:none;">
                            <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search Rooms','mod'=>'wkroomsearchblock'),$_smarty_tpl ) );?>
</p>
                            <hr>
                        </div>
                        <div class="container">
                            <div class="header-rmsearch-inner-wrapper">
                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_118843047568e4f3744925e2_42277683', 'search_form', $this->tplIndex);
?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    <?php }
}
}
/* {/block 'landing_page_search_panel'} */
}
