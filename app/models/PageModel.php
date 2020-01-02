<?php
class PageModel
{
    private $db;

    public function  __construct()
    {
        $this->db = new Database;
    }

    public function createTable()
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS en_pages(page_ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            page_title VARCHAR(200) NOT NULL,
            page_name VARCHAR(200) NOT NULL,
            page_content  LONGTEXT NOT NULL ,
            page_status VARCHAR(200) NOT NULL,
            parent_page INT NOT NULL,
            page_type VARCHAR(200) NOT NULL,
            page_date DATETIME NOT NULL,
            page_mime_type VARCHAR(500) NOT NULL ) ");
        $this->db->execute();
    }

    //Check or Select Single Query Pages
    public function en_pager_selector($whatToSelect, $TableToSelect, $whereToSelect, $itemLocation, bool  $grab = false)
    {
        $this->db->query("SELECT $whatToSelect FROM $TableToSelect  where $whereToSelect  = :page");
        $this->db->bind(':page', $itemLocation);
        $result = $this->db->single();
        if ($grab == (bool)  false) {
            if ($this->db->rowCount()  > 0) {
                return  (bool) true;
            } else {
                return  (bool)  false;
            }
        } elseif ($grab ==  (bool) true) {
            // var_dump($result);
            return $result;
        }
    }


    //Insert Pages
    public function en_pager_inserter($TableToInsert, $data)
    {
        $this->db->query("INSERT into $TableToInsert Values(:page_id,   :page_title, :page_name, :page_content,:post_status, :parentPage,:type, :pageDate,:page_mime_type)");
        $this->db->bind(":page_id", $data['page_iD']);
        $this->db->bind(":page_content", $data['page_content']);
        $this->db->bind(":page_name", $data['page_name']);
        $this->db->bind(":page_title", $data['page_title']);
        $this->db->bind(":page_mime_type", $data['page_mime_type']);
        $this->db->bind(":post_status", $data['page_status']);
        $this->db->bind(":parentPage", $data['parent_page']);
        $this->db->bind(":type", $data['page_type']);
        $this->db->bind(":pageDate", $data['page_date']);
        $this->db->execute();
    }

    public function mulSelector($whatToSelect, $TableToSelect)
    {
        $this->db->query("SELECT $whatToSelect from $TableToSelect");
        $result = $this->db->resultSet();
        return $result;
    }
}
