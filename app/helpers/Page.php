<?php


trait Page
{
    private static $array = [];
    //Checks Url  
    public function EN_checkUrl($url)
    {
        // static $array = [];

        //Explode URL and Get the End of array
        $explodedUrl = explode("/", $url);
        $lastUrlNum =  (int) count($explodedUrl) - 1;
        $lastUrl = trim($explodedUrl[$lastUrlNum]);


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

    public function insertPage()
    {
        if (isset($_POST[""]));
    }
}




function redirect($page)
{
    header('location:'  . URLROOT . $page);
}


function kill($output)
{

    echo
        die(" <style>  
  body{
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
         
  }  </style>" . "
  
  <!DOCTYPE html>
<html style='background-color: #e1e1e1;' lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link rel='stylesheet' href='http://localhost/Envisale/public/css/style.css'>
    <link rel='stylesheet' href='<?php echo URLROOT;?>/vendor/Semantic-UI-CSS-master/semantic.css'>
<link rel='stylesheet' href='<?php echo URLROOT;?>/vendor/Semantic-UI-CSS-master/semantic.min.css'>
<title>Error</title>


</head>


<body>" .  $output .
            "</body>

</html>");
}
