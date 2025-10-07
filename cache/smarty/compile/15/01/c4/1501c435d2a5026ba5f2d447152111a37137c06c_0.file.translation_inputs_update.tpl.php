<?php
/* Smarty version 4.5.5, created on 2025-10-07 10:59:45
  from 'C:\wamp64\www\1.IDM\admin\themes\default\template\controllers\translations\helpers\view\translation_inputs_update.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f2a1cc1068_02322874',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1501c435d2a5026ba5f2d447152111a37137c06c' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin\\themes\\default\\template\\controllers\\translations\\helpers\\view\\translation_inputs_update.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f2a1cc1068_02322874 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
    $(document).ready(function(){
        $('#translations_form input:text,textarea').each(function(){
            $(this).data('name',$(this).attr('name'));
            $(this).removeAttr('name');
        });
        $('#translations_form').on('change','input:text,textarea',function(){
            var name = $(this).data('name');
            if(name) $(this).attr('name',name);
        });
    });
<?php echo '</script'; ?>
><?php }
}
