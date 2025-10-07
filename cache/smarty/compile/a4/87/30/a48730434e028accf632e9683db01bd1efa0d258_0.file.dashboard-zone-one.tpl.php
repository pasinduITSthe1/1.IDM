<?php
/* Smarty version 4.5.5, created on 2025-10-07 16:49:34
  from 'C:\wamp64\www\1.IDM\modules\dashinsights\views\templates\hook\dashboard-zone-one.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68e4f7469a7c22_02986680',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a48730434e028accf632e9683db01bd1efa0d258' => 
    array (
      0 => 'C:\\wamp64\\www\\1.IDM\\modules\\dashinsights\\views\\templates\\hook\\dashboard-zone-one.tpl',
      1 => 1751632538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68e4f7469a7c22_02986680 (Smarty_Internal_Template $_smarty_tpl) {
?>
<section id="dashinsights" class="widget allow_push">
    <div class="panel">
        <div class="panel-heading">
            <i class="icon-area-chart"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Insights",'mod'=>'dashinsights'),$_smarty_tpl ) );?>

            <span><small class="text-muted" id="dashinsights_heading_zone_one"></small></span>
            <span class="panel-heading-action">
                <a class="list-toolbar-btn" href="#" onclick="refreshDashboard('dashinsights'); return false;" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Refresh",'mod'=>'dashinsights'),$_smarty_tpl ) );?>
">
                    <i class="process-icon-refresh"></i>
                </a>
            </span>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <p class="chart-label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Length of Stay (%)','mod'=>'dashinsights'),$_smarty_tpl ) );?>
</p>
                <div class="chart with-transitions insight-chart-wrap" id="dashinsights_length_of_stay">
                    <svg></svg>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }
}
