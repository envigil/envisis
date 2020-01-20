<?php


trait Page
{

    // Accepted Pages;
    protected $AVAILPAGES =
    [
        "LOGINS" => "login",
        "PAGES" => "page",
        "PORTALS" => "portal",
        "BLOG" => "blog"
    ];


    public function en_register_link($location = null,  array $links)
    {
        global $page_links_sidebar;
        global $page_links_header;
        global $page_links;

        $func_links = function ()   use ($location,  $links) {
            global $page_links_sidebar;
            global $page_links_header;
            global $page_links;
            if (count($links) != 0) {

                if ($location == "header") {
                    $page_links_header[] =
                        $links;
                } elseif ($location == "sidebar") {
                    $page_links_sidebar[] =
                        $links;
                }
            }

            return $page_links[] =
                [
                    "header" => $page_links_header,
                    "sidebar" => $page_links_sidebar
                ];
        };

        $this->en_linker = $func_links();
    }

    //Checks Url  
    private static $array = [];
    public function EN_checkUrl($lastUrl)
    {
        // static $array = [];
        $result = $this->pagemodel->en_pager_selector("page_name", "en_pages", "page_name", $lastUrl);

        if ($result == true) :
            $parent = $this->pagemodel->en_pager_selector("parent_page", "en_pages", "page_name", $lastUrl, true);

            if (!empty($parent)) {
                $pageName = $this->pagemodel->en_pager_selector("page_name", "en_pages", "page_ID", $parent->parent_page, true);

                if (!empty($pageName)) {
                    self::$array[] = $pageName->page_name;
                } else {
                    return $lastUrl;
                }
            }
            $this->EN_checkUrl($pageName->page_name);
            return implode("/", array_reverse((array) self::$array)) . "/" . $lastUrl;


        else :
            return (bool) false;
        endif;
    }


    public function check_url_set(array $url): bool
    {
        $error = false;
        foreach ($url as $links) {
            if ($links == null) {
                $error = "true";
            } elseif (!isset($links)) {
                $error = "true";
            }
        }
        return (bool) $error;
    }


    static function  redirect($page)
    {
        header('location:'  . URLROOT . $page);
    }
}





function kill($output, bool  $die = true)
{
    echo " <style>  
    .killer{
    background:white; 
    border-radius: 5px;
      box-shadow: 0px 2px 7px gainsboro;
         padding: 3%;
         font-size: 15px;  
         margin: auto;
         margin-top:10%;
         display: block;
         white-space: pre-line;
         font-family: 'monospace';
         unicode-bidi: embed;
         width: 50%;
         
    } 
    
    html{
        background-color:#7B7B7B;
    }
    
    </style>";


    if ($die == true) {
        die("<body class='killer' >" .  $output .  "</body>");
    } elseif ($die == false) {

        echo "<body class='killer' >" .  $output .  "</body>";
    }
}
