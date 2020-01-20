<?php
class Admin extends Controller
{

    use Page, pageContents;
    public  $test;
    private $en_linker;
    private $data;
    private  $pages;


    public function __construct()
    {
        $this->en_register_link("header", $this->D_Header2);
        $this->en_register_link("sidebar", $this->D_Sidebar);
        $this->postModel = $this->model('PageModel');
        $this->pages =  $this->postModel->mulSelector("*", "en_pages");

        $this->data["links"] = $this->en_linker;
        $this->data["pageData"] = "";
    }
    public function index()
    {
        $data = [
            'title' => 'welcome',
            "parent_page" => $this->pages,

        ];
        $this->view('admin/view',   $this->data);
    }
    public function pager($action = null, $sender = null)
    {

        if ($action == "create-new") {
            $this->data["create-new"] =
                [
                    "page_iD" => null,
                    "page_title" => "",
                    "page_name" => "",
                    "page_content" => "",
                    "parent_page" => "",
                    "page_type" => "",
                    "page_date" => "",
                    "page_status" => "",
                    "page_mime_type" => "",
                    "page_users" => "",
                    "page_portal" => " ",
                    "page_login" => " "
                ];
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $post = [
                $_POST['page_name'],
            ];
            $urlCheck = $this->check_url_set($post);

            if ($urlCheck == (bool) false) :
                print $urlCheck;
                $this->data["create-new"]["page_title"] =  $_POST['page_title'];
                $this->data["create-new"]["page_name"] =  $_POST['page_name'];
                $this->data["create-new"]["page_content"] =  $_POST['page_content'];
                $this->data["create-new"]["parent_page"] =  $_POST['parent_page'];
                $this->data["create-new"]["page_status"] =  $_POST['page_status'];
                $this->data["create-new"]['page_type'] = $sender;

                if ($sender == $this->AVAILPAGES["PORTALS"]) {
                    $this->data["create-new"]['page_portal'] = "";
                    $this->data["create-new"]['page_users'] = $_POST['page_users'];
                    $this->data["create-new"]["page_login"] = $_POST["page_login"];
                } elseif ($sender == $this->AVAILPAGES["LOGINS"]) {
                    $this->data["create-new"]["page_login"] = "";
                    $this->data["create-new"]['page_users'] = "";
                    $this->data["create-new"]['page_portal'] = $_POST['page_portal'];
                }


                $date = new DateTime();
                $this->data["create-new"]['page_date'] = (string) $date->format("Y-m-d h:i:s ");
                print  $this->data["create-new"]['page_date'];

                try {
                    $this->postModel->en_pager_inserter("en_pages", $this->data["create-new"]);
                } catch (PDOException $e) {
                    die($e->getMessage());
                }
                kill(var_dump($this->data));
            endif;
        }

        echo "admin";
    }

    public function pages()
    {
        $this->data["page_type"] = $this->AVAILPAGES["PAGES"];
        $this->data["pageData"] = $this->postModel->mulSelector_opt("*", "en_pages where  page_type = ",  $this->data["page_type"]);

        $this->view('admin/view', $this->data);
    }

    public function portal()
    {
        $this->data["page_type"] = $this->AVAILPAGES["PORTALS"];
        $this->data["pageData"] = $this->postModel->mulSelector_opt("*", "en_pages where  page_type = ",  $this->data["page_type"]);

        $this->view('admin/view', $this->data);
    }

    public function blog()
    {
        $this->data["page_type"] = $this->AVAILPAGES["BLOG"];
        $this->data["pageData"] = $this->postModel->mulSelector_opt("*", "en_pages where  page_type = ",  $this->data["page_type"]);

        $this->view('admin/view', $this->data);
    }

    public function logins()
    {
        $this->data["page_type"] = $this->AVAILPAGES["LOGINS"];
        $this->data["pageData"] = $this->postModel->mulSelector_opt("*", "en_pages where  page_type = ",  $this->data["page_type"]);
        $this->view('admin/view', $this->data);
    }

    public function users()
    {
        $this->data["usersData"] = [
            "group_user_id" => null,
            "group_user_name" => "",
            "allowed_members" => ""
        ];
        $post = [
            @$_POST['users_name'],
        ];

        $urlCheck = $this->check_url_set($post);

        if ($urlCheck ==  (bool) false) {

            $this->data["usersData"]["allowed_members"] = $_POST['all_mem'];
            $this->data["usersData"]["group_user_name"] = $_POST['users_name'];

            $this->postModel->G_userInsert($this->data["usersData"]);
        }
        $this->view('admin/users', $this->data);
    }

    public function members()
    {
    }
}
