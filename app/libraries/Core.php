<?php

/*
*   App core class
*   Creates url and loads core controllers
*    URL FORMAT - /controller/methods/params
*/

class Core extends Controller
{
    protected $currentController = "Pages";
    protected $databaseMethod;
    protected $databaseParam;
    protected $currentMethod = "page";
    protected $params = [];
    protected $pageRedirector;
    private $databasePageCheck;



    public function __construct()
    {

        //gets the PageModel Class
        $this->pagemodel = $this->model('PageModel');


        try {
            $this->pagemodel->createTable();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }



        //gets URL String
        $url    = $this->getUrl();

        //Trys The page Checker and gets Result
        try {
            $this->databasePageCheck = $this->pagemodel->en_pager_selector("page_name", "en_pages", "page_name", strtolower($url[0]));
        } catch (PDOException $e) {
            // throw new Exception("fatal error, Try Sending Email to your Administrator on the problem");
            die("Fatal Error from Your Core");
        }


        //look into the controller to check if the first part of Url exist as a file
        if (file_exists('../app/controller/' . ucwords($url[0]) . '.php')) {

            //redirect  Pages controller if the page was inputted in the URL.. 
            $this->currentController     =  ucwords($url[0]);

            //if admin page was requested, Register index page to it
            if (strtolower($this->currentController) == "admin") {
                $this->currentMethod = "index";
            }

            //unset o index
            unset($url[0]);

            //checks if the first part of Url page Exists in the Database
        } elseif ($this->databasePageCheck == (bool) true) {

            // if Page Exist Register the controller url class and Method as Pages
            $this->currentController = 'Pages';
            $this->databaseMethod = "page";

            //Passes the url string to DatabaseParam
            $this->databaseParam[0] = $url[0];
            unset($url[0]);
        }

        $this->currentController;
        //require the controller file to which url it grabs..
        require_once '../app/controller/' . $this->currentController . '.php';


        //instantiate the class url
        $this->currentController    =  new $this->currentController();

        //check for second part of the url
        if (!empty($url[1])) {

            //check to see if method exists in the controller class that was choosen
            if (method_exists($this->currentController,     $url[1])) {

                //if exist Grabs the url string
                $this->currentMethod = $url[1];

                //unset 1 index
                unset($url[1]);
            }

            //checks if the PAGE class and method was taken as url
            elseif (!empty($this->databaseMethod)) {

                //assigns the Page Method to the controller method
                $this->currentMethod =  $this->databaseMethod;

                //Passes the url string to DatabaseParam
                $this->databaseParam[1] = $url[1];

                //unset 1 index
                unset($url[1]);
            }

            //checks if the PAGE class and method was taken as url
        } elseif (!empty($this->databaseMethod)) {

            //assigns the Page Method to the controller method
            $this->currentMethod =  $this->databaseMethod;

            //unset 1 index
            unset($url[1]);
        }

        $this->currentMethod;

        //get remaining part of the url as params
        if ($url) {

            //check if database url was choosen  to grab all its url
            if (!empty($this->databaseMethod)) {

                $this->getDatabaseUrl($url);
            } else {

                //grabs the remaining url if database was choosen
                $this->params = array_values($url);
            }
        } else {
            //check if database url was choosen  to grab all its url
            if (!empty($this->databaseMethod)) {
                $this->getDatabaseUrl($url);
            }
        }

        //call a acallbackback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getDatabaseUrl($url)
    {
        $merge = array_merge($this->databaseParam, $url);
        $implode = implode("/", $merge);
        $urllist[] = $implode;
        $this->params = array_values($urllist);
    }

    public function getUrl()
    {

        if (isset($_GET['url'])) {
            $url     =  rtrim($_GET['url'],   '/');
            $url     =  filter_var($url,  FILTER_SANITIZE_URL);
            $url     =  explode('/',     $url);
            return $url;
        }
    }
}
