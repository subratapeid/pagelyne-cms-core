<?php
// Example test plugin
function my_test_plugin_init() {
    file_put_contents(base_path('plugins/test_plugin_log.txt'), "Plugin executed at ".date('Y-m-d H:i:s')."\n", FILE_APPEND);
}

my_test_plugin_init();
