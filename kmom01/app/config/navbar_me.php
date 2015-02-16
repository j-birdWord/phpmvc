<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Hem',
            'url'   => '',
            'title' => 'Hem'
        ],

        // This is a menu item
        'redovisning'  => [
            'text'  => 'Redovisning',
            'url'   => 'redovisning',//$this->di->get('url')->create('redovisning'),
            'title' => 'Visa alla redovisningar',

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    'kmom01'  => [
                        'text'  => 'Kmom01',
                        'url'   => 'redovisning/kmom01',
                        'title' => 'Kmom01',
                        'class' => 'italic'
                    ],

                    // This is a menu item of the submenu
                    'kmom02'  => [
                        'text'  => 'Kmom02',
                        'url'   => 'redovisning/kmom02',
                        'title' => 'Kmom02',
                        'class' => 'italic'
                    ],

                    // This is a menu item of the submenu
                    'kmom03'  => [
                        'text'  => 'Kmom04',
                        'url'   => 'redovisning/kmom03',
                        'title' => 'Kmom03',
                        'class' => 'italic'
                    ],

                    // This is a menu item of the submenu
                    'kmom04'  => [
                        'text'  => 'Kmom04',
                        'url'   => 'redovisning/kmom04',
                        'title' => 'Kmom04',
                        'class' => 'italic'
                    ],

                    // This is a menu item of the submenu
                    'kmom05'  => [
                        'text'  => 'Kmom05',
                        'url'   => 'redovisning/kmom05',
                        'title' => 'Kmom05',
                        'class' => 'italic'
                    ],

                    // This is a menu item of the submenu
                    'kmom06'  => [
                        'text'  => 'Kmom06',
                        'url'   => 'redovisning/kmom06',
                        'title' => 'Kmom06',
                        'class' => 'italic'
                    ],

                    // This is a menu item of the submenu
                    'kmom07/10'  => [
                        'text'  => 'Kmom07/10',
                        'url'   => 'redovisning/kmom07',
                        'title' => 'Kmom07/10',
                        'class' => 'italic'
                    ],
                ],
            ],
        ],

        // This is a menu item
        'kallkod'  => [
            'text'  => 'Källkod',
            'url'   => 'source',
            'title' => 'Källkod för filer'
        ],
    ],
 


    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    'callback' => function ($url) {
        if ($this->di->get('request')->getCurrentUrl($url) == $this->di->get('url')->create($url)) {
            return true;
        }
    },



    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting 'mark-if-parent' set to true.
     *
     */
    'is_parent' => function ($parent) {
        $route = $this->di->get('request')->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },



   /**
     * Callback to create the url, if needed, else comment out.
     *
     */
   
    'create_url' => function ($url) {
        return $this->di->get('url')->create($url);
    },
    
];
