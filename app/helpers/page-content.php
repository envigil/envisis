<?php


trait pageContents
{


    protected $D_Sidebar = [
        [
            "title" => "Dashboard",
            "link" => "admin/lll",
            "icon" => "home",
            "submenu" => [
                [
                    "name" => "Home",
                    "link" => "",
                ],
                [
                    "name" => "Activities",
                    "link" => "",
                ],
            ],
        ],


        [
            "title" => "Blogs",
            "link" => "blog",
            "icon" => "thumbtack",
            "submenu" => [
                [
                    "name" => "All Blogs",
                    "link" => "blog",
                ],
                [
                    "name" => "Add new Page",
                    "link" => "",
                ],
            ],
        ],

        [
            "title" => "Pages",
            "link" => "Pages",
            "icon" => "copy outline",
            "submenu" => [
                [
                    "name" => "All Pages",
                    "link" => "Pages",
                ],
                [
                    "name" => "Add new Page",
                    "link" => "",
                ],
            ],
        ],


        [
            "title" => "Portals",
            "link" => "Portal",
            "icon" => "sliders horizontal",
            "submenu" => [
                [
                    "name" => "All Portals",
                    "link" => "portal",
                ],
                [
                    "name" => "Add new Page",
                    "link" => "",
                ],
            ],
        ],

        [
            "title" => "Login's",
            "link" => "logins",
            "icon" => "venus mars",
            "submenu" => [
                [
                    "name" => "All Logins",
                    "link" => "logins",
                ],
                [
                    "name" => "Add new Page",
                    "link" => "",
                ],
            ],
        ],




    ];




    protected $D_Header = [


        "title" => "Login's",
        "link" => "admin/lll",
        "icon" => "sign in",
        "submenu" => [
            [
                "name" => "View Login's",
                "link" => "Add new Login's",
            ],
            [
                "name" => "Add new Login's",
                "link" => "",
            ],

        ],



    ];


    protected $D_Header2 = [


        [
            "title" => "portal",
            "link" => "admin/portal",
            "icon" => "users",
            "submenu" => [
                [
                    "name" => "dg",
                    "link" => "Add rgn's",
                ],
                [
                    "name" => "Add nseers",
                    "link" => "ear",
                ],

            ],
        ]



    ];
}
