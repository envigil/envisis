<?php
class Admin extends Controller
{
    use Page;
    public function __construct()
    {
        $this->postModel = $this->model('PageModel');
        $this->pages =  $this->postModel->mulSelector("page_name, page_ID", "en_pages");
    }
    public function index()
    {

        $data = [
            'title' => 'welcome',
            "pages" => $this->pages
        ];
        $this->view('admin/index',   $data);
    }
    public function page($action)
    {
        if ($action == "create-new") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $post = [
                $_POST['page_name'],
            ];
            $urlCheck = $this->check_url_set($post);

            if ($urlCheck == (bool) false) :
                print $urlCheck;
                $data = [
                    "page_iD" => null,
                    "page_title" => $_POST['page_title'],
                    "page_name" => $_POST['page_name'],
                    "page_content" => $_POST['page_content'],
                    "parent_page" => $_POST['parent_page'],
                    "page_type" => "page",
                    "page_date" => "",
                    "page_status" => $_POST['page_status'],
                    "page_mime_type" => "",
                ];
                $date = new DateTime();
                $data['page_date'] = (string) $date->format("Y-m-d h:i:s ");
                print  $data['page_date'];

                try {
                    $this->postModel->en_pager_inserter("en_pages", $data);
                } catch (PDOException $e) {
                    die($e->getMessage());
                }
                kill(var_dump($data));
            endif;
        }
    }
}
