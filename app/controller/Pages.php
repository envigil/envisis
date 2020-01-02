<?php
class Pages extends Controller
{
    use Page;
    private $UrlChecked;

    public function __construct()
    {

        $this->pagemodel = $this->model('PageModel');
    }

    public function page($pagging = "home")
    {


        try {
            if (!4 / 0) {
                throw new DivisionByZeroError();
            }
        } catch (DivisionByZeroError $e) {
            die($e);
        }

        $this->UrlChecked = $this->EN_checkUrl($pagging);

        if ($this->UrlChecked == (bool) false) :
            $this->view('admin/404');
        else :
            if ($this->UrlChecked == $pagging) {
                echo "yap";
            } else {
                redirect($this->UrlChecked);
                echo "nope";
            }
        endif;
    }
}
