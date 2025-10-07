<?php
/* Smarty version 4.5.5, created on 2025-10-07 16:49:49
  from 'C:\wamp64\www\1.IDM\admin134miqa0b\themes\default\template\recomended-banner.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f7553295e5_55919135',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '77fe815933ac58135eb7c5b59e82a2ce3f1449e3' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\admin134miqa0b\\themes\\default\\template\\recomended-banner.tpl',
      1 => 1759835419,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f7553295e5_55919135 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="recommendation-wrapper-skeleton" style="display:none">
    <?php echo '<script'; ?>
>
        loadRecommendation();
    <?php echo '</script'; ?>
>
    <div class="col-sm-12">
        <div class="banner panel">
            <div class="row">
                <div class="col-sm-12">
                    <div class="skeleton-loading-pulse loading-container-bar"></div>
                    <div class="loading-container-bar"></div>
                    <div class="skeleton-loading-pulse loading-container-bar"></div>
                    <div class="loading-container-bar"></div>
                    <div class="skeleton-loading-pulse loading-container-bar"></div>
                    <div class="loading-container-bar"></div>
                    <div class="skeleton-loading-pulse loading-container-bar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="recommendation-wrapper" style="display:none">
</div><?php }
}
