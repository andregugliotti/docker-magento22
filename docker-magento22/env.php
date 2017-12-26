<?php
return array (
    'backend' =>
        array (
            'frontName' => 'admin',
        ),
    'crypt' =>
        array (
            'key' => '5dd3ac7b9036d0671b13e05caadea892',
        ),
    'db' =>
        array (
            'table_prefix' => '',
            'connection' =>
                array (
                    'default' =>
                        array (
                            'host' => 'mysql',
                            'dbname' => 'magento2',
                            'username' => 'magento2',
                            'password' => 'a123456',
                            'active' => '1',
                        ),
                ),
        ),
    'resource' =>
        array (
            'default_setup' =>
                array (
                    'connection' => 'default',
                ),
        ),
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'default',
    'session' =>
        array (
            'save' => 'files',
        ),
    'cache_types' =>
        array (
            'config' => 1,
            'layout' => 1,
            'block_html' => 1,
            'collections' => 1,
            'reflection' => 1,
            'db_ddl' => 1,
            'eav' => 1,
            'customer_notification' => 1,
            'full_page' => 1,
            'config_integration' => 1,
            'config_integration_api' => 1,
            'translate' => 1,
            'config_webservice' => 1,
        ),
    'install' =>
        array (
            'date' => 'Tue, 26 Dec 2017 15:18:41 +0000',
        ),
);