<?php
session_start();
class Pages extends Controller
{
    use Page;
    // const LOGGEDIN = "";
    private $UrlChecked;

    public function __construct()
    {

        $this->pagemodel = $this->model('PageModel');
    }

    public function page($pagging = "home")
    {

        //Explode URL and Get the End of array
        $explodedUrl = explode("/", $pagging);
        $lastUrlNum =  (int) count($explodedUrl) - 1;
        $lastUrl = trim($explodedUrl[$lastUrlNum]);

        // Function thta checks the URL for Accuracy, Correctness..
        $this->UrlChecked = $this->EN_checkUrl($lastUrl);

        //if not corrrect Returns a 404 Error Page
        if ($this->UrlChecked == (bool) false) :
            $this->view('admin/404');
        else :
            //CHeck if the derived url matches with the inputted URL
            if ($this->UrlChecked == $pagging) {

                //if correct, Grabs Information About that url
                $result =  $this->pagemodel->mul_sel_opt("*", "en_pages", "page_name", $lastUrl);
                $pageInfo = [];
                foreach ($result as $eachResult) {
                    $pageInfo =
                        [
                            "page_type" => $eachResult->page_type,
                            "page_name" => $eachResult->page_name,
                            "page_id" => $eachResult->page_ID,
                            "page_login" =>  $eachResult->page_login,
                            "page_user" => $eachResult->page_users,
                            "page_portal" => $eachResult->page_portal


                        ];
                }

                //checks if the Requested page is a portal page
                if ($pageInfo["page_type"] == $this->AVAILPAGES["PORTALS"]) {

                    //Checks if that page was logged into before
                    if (!isset($_COOKIE[$pageInfo["page_name"]])) {
                        page::redirect($pageInfo["page_login"]);
                    } else {
                        //Display portal page
                        $this->view("pages/index");
                    }

                    //Checks if page is a login page
                } elseif ($pageInfo["page_type"] == $this->AVAILPAGES["LOGINS"]) {
                    $data["loginPage"] = $lastUrl;

                    $logResult =  $this->pagemodel->mul_sel_opt("*", "en_pages", "page_login", $lastUrl);


                    $pageLogInfo = [];
                    foreach ($logResult as $eachLogResult) {
                        $pageLogInfo =
                            [
                                "page_type" => $eachLogResult->page_type,
                                "page_name" => $eachLogResult->page_name,
                                "page_id" => $eachLogResult->page_ID,
                                "page_login" =>  $eachLogResult->page_login,
                                "page_user" => $eachLogResult->page_users,
                                "page_portal" => $eachLogResult->page_portal


                            ];
                    }


                    if (isset($_COOKIE[$pageInfo["page_portal"]]) &&  $_COOKIE[$pageInfo["page_portal"]] != null) {
                        page::redirect($pageLogInfo["page_name"]);
                    }


                    //checks if inputs are set
                    if (isset($_POST["username"]) && isset($_POST["password"])) {
                        $data =
                            [
                                "username" => $_POST["username"],
                                "password" => $_POST["password"],
                                "passError" => "",
                                "error" => "",
                                "userError" => "",
                                "group_user" => $pageLogInfo["page_user"],
                                "page" => $pageLogInfo["page_name"],

                            ];
                        //Check for input errors
                        if ($data["username"] == null) {
                            $data['error'] = "username not inputted";
                        }
                        if ($data["password"] == null) {
                            $data["error"] = "password not inputted";
                        }
                        if ($data["error"] != null) {
                            echo $data["error"];
                            $this->view("pages/login", $data);

                            //if Errors free
                        } else {


                            //Grab login Details
                            $details =  $this->pagemodel->grab_login_details($data);

                            //check if correspond
                            if (count($details) == 0) {
                                echo $data["error"] = "username and password not correct";
                                $this->view("pages/login", $data);

                                //if Correspond
                            } else {
                                //Gets User information
                                $resultData = [];
                                foreach ($details as $eachDetails) {
                                    $resultData =
                                        [
                                            "username" => $eachDetails->members_name,
                                            "password" => $eachDetails->members_pass
                                        ];
                                }
                                //checks if password correspond
                                if ($data["password"] == $resultData["password"]) {

                                    //Create Session cookies using the portal page and user requesting access
                                    $cookie = (string) $pageInfo["page_portal"];
                                    setcookie($cookie, trim($data["username"]), time() + 60 * 60 * 24, '/');
                                }
                            }
                        }


                        $this->view("pages/login", $data);
                    }







                    $this->view("pages/login", $data);
                }
            } else {
                page::redirect($this->UrlChecked);
            }
        endif;
    }
}
