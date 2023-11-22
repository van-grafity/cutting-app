<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'GHIM LI INDONESIA',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>GHIM LI INDONESIA</b>',
    'logo_img' => 'assets/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'assets/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'assets/img/AdminLTELogo.png',
            'alt' => 'Ghim Li Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-teal',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => '',
    'classes_auth_header' => 'bg-gradient-info',
    'classes_auth_body' => '',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-lg text-info',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        // [
        //     'type'         => 'navbar-search',
        //     'text'         => 'search',
        //     'topnav_right' => true,
        // ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        // [
        //     'type' => 'sidebar-menu-search',
        //     'text' => 'search',
        // ],
        [
            'text' => 'Dashboard',
            'url'  => '/home',
            'icon' => 'fas fa-fw fa-home',
            'can'  => 'clerk',
        ],
        [
            'text' => 'Master Data',
            'icon' => 'fas fa-fw fa-ruler-combined',
            'can'  => 'clerk-cutting',
            'submenu' => [
                [
                    'text' => 'User Management',
                    'url'  => '/user-management',
                    'classes'=> 'ml-3',
                    'icon' => 'fas fa-fw fa-users',
                    'can'  => 'admin-only',
                ],
                [
                    'text' => 'Cutting Group',
                    'url'  => '/user-cutting-group',
                    'classes'=> 'ml-3',
                    'icon'  => 'fas fa-fw fa fa-solid fa-object-group',
                    'can'  => 'admin-only',
                ],
                [
                    'text' => 'Buyer',
                    'url'  => '/buyer',
                    'classes'=> 'ml-3',
                    'icon' => 'fas fa-fw fa fa-user',
                    'can'  => 'clerk-cutting', 
                ],
                [
                    'text' => 'Size',
                    'url'  => '/size',
                    'classes'=> 'ml-3',
                    'icon' => 'fas fa-fw fa fa-solid fa-ruler',
                    'can'  => 'clerk-cutting', 
                ],
                [
                    'text' => 'Color',
                    'url'  => '/color',
                    'classes'=> 'ml-3',
                    'icon' => 'fas fa-fw fa fa-solid fa-fill-drip',
                    'can'  => 'clerk-cutting', 
                ],
                [
                    'text' => 'Remarks',
                    'url'  => '/remark',
                    'classes'=> 'ml-3',
                    'icon' => 'fas fa-fw fa fa-solid fa-sticky-note',
                    'can'  => 'clerk-cutting', 
                ],
                
            ],
        ],
        [
            'text' => 'Master Data Cutting',
            'icon' => 'fas fa-fw fa-industry',
            'can'  => 'clerk-cutting',
            'submenu' => [
                // [
                //     'text' => 'Fabric Usage',
                //     'url'  => '/fabric-usage',
                //     'classes'=> 'ml-3',
                //     'icon' => 'fas fa-fw fa fa-solid fa-drafting-compass',
                //     'can'  => 'clerk-cutting', 
                // ],
                [
                    'text' => 'Fabric Consumption',
                    'url'  => '/fabric-cons',
                    'classes'=> 'ml-3',
                    'icon' => 'fas fa-fw fa fa-solid fa-drafting-compass',
                    'can'  => 'clerk-cutting', 
                ],
                [
                    'text' => 'Fabric Type',
                    'url'  => '/fabric-type',
                    'classes'=> 'ml-3',
                    'icon' => 'fas fa-fw fa fa-solid fa-swatchbook',
                    'can'  => 'clerk-cutting', 
                ],
            ],
        ],
        [
            'text' => 'GL',
            'url'  => '/gl',
            'icon' => 'fas fa-fw fa fa-file-alt',
            'can'  => 'clerk-cutting', 
        ],
        // [
        //     'text' => 'Style',
        //     'url'  => '/style',
        //     'icon' => 'fas fa-fw fa fa-solid fa-palette',
        //     'can'  => 'admin-only', 
        // ],
        [
            'text' => 'Laying Planning',
            'icon' => 'fas fa-fw fa fa-solid fa-calendar-alt',
            'can'  => 'clerk',
            'submenu' => [
                [
                    'classes'   => 'ml-3',
                    'text' => 'Create Laying Planning',
                    'url' => '/laying-planning-create',
                ],
                [
                    'classes'   => 'ml-3',
                    'text' => 'Laying Planning List',
                    'url' => '/laying-planning',
                ],
            ],
        ],
        [
            'text' => 'Cutting Order Record',
            'url'  => '/cutting-order',
            'icon' => 'fas fa-fw fa fa-solid fa-cut',
            'can'  => 'clerk',
        ],
        // [
        //     'text' => 'Summary by Group',
        //     'url'  => '/subcon-cutting',
        //     'icon' => 'fas fa-fw fa fa-database',
        //     'can'  => 'clerk',
        // ],
        [
            'text' => 'Cutting Ticket',
            'icon' => 'fas fa-fw fa fa-object-ungroup',
            'can'  => 'clerk',
            'submenu' => [
                [
                    'classes'=> 'ml-3',
                    'text' => 'Create Cutting Ticket',
                    'url' => '/cutting-ticket/create',
                ],
                [
                    'classes'=> 'ml-3',
                    'text' => 'Cutting Ticket List',
                    'url' => '/cutting-ticket',
                ],
            ],
        ],
        [   'header'=> 'Forms',
            'can'   => 'form', 
        ],
        [
            'text' => 'Fabric Requisition',
            'url'  => '/fabric-requisition',
            'icon' => 'fas fa-fw fa fa-tasks',
            'can'  => 'form',
        ],
        // [
        //     'text' => 'Fabric Request Piping',
        //     'url'  => '/fabric-request-piping',
        //     'icon' => 'fas fa-fw fa fa-tasks',
        //     'can'  => 'form',
        // ],
        [
            'header'=> 'Warehouse',
            'can'   => 'warehouse',
        ],
        [
            'text' => 'Fabric Issuance',
            'url'  => '/fabric-issue',
            'icon' => 'fas fa-fw fa fa-tasks',
            'can'  => 'warehouse',
        ],
        [   'header'=> 'Reports'],
        // [
        //     'text' => 'Cut Piece Stock',
        //     'url'  => '/cut-piece-stock',
        //     'icon' => 'fas fa-fw fa fa-journal-whills',
        //     'can'  => 'cutting-record',
        // ],
        [
            'text' => 'Daily Cutting Report',
            'url'  => '/daily-cutting-report',
            'icon' => 'fas fa-fw fa fa-journal-whills',
            'can'  => 'cutting-record',
        ],
        [
            'text' => 'Cutting Status',
            'url'  => '/status-cutting-order-record',
            'icon' => 'fas fa-fw fa fa-chart-bar',
            'can'  => 'cutting-record',
        ],
        [
            'text' => 'Cutting Group Report',
            'url'  => '/cutting-print-subcon',
            'icon' => 'fas fa-fw fa fa-database',
            'can'  => 'cutting-record',
        ],
        [
            'text' => 'Cutting Order Completion',
            'url'  => '/cutting-order-completion',
            'icon' => 'fas fa-fw fa fa-database',
            'can'  => 'cutting-record',
        ],
        [
            'header'=> 'Lain-lain',
            'can'   => 'admin-only',
        ],
        [
            'text' => 'Pallet',
            'url'  => '/pallets',
            'icon' => 'fas fa-fw fa fa-solid fa-pallet',
            'can'  => 'admin-only',
        ],
        [
            'text' => 'Machine',
            'icon' => 'fas fa-fw fa fa-object-ungroup',
            'can'  => 'admin-only',
            'submenu' => [
                [
                    'classes'=> 'ml-3',
                    'text' => 'Machine List',
                    'url' => '/machine',
                ],
                [
                    'classes'=> 'ml-3',
                    'text' => 'Machine Qr Code',
                    'url' => '/machine-qr-code',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/jszip/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/vfs_fonts.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/responsive/css/responsive.bootstrap4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/responsive/js/dataTables.responsive.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/responsive/js/responsive.bootstrap4.min.js',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'Moment' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '.\vendor\moment\moment-with-locales.js',
                ],
            ],
        ],
        'Daterangepicker' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '.\vendor\daterangepicker\daterangepicker.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '.\vendor\daterangepicker\daterangepicker.css',
                ],
            ],
        ],
        'Tempusdominusbootstrap4' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '.\vendor\tempusdominus-bootstrap-4\js\tempusdominus-bootstrap-4.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '.\vendor\tempusdominus-bootstrap-4\css\tempusdominus-bootstrap-4.css',
                ],
            ],
        ],
        'Toastr' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '.\vendor\toastr\toastr.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '.\vendor\toastr\toastr.min.js',
                ],
            ],
        ],
        'JqueryValidation' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '.\vendor\jquery-validation\jquery.validate.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '.\vendor\jquery-validation\additional-methods.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];