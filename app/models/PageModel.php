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
            page_mime_type VARCHAR(500) NOT NULL ,
            page_portal VARCHAR(200) NOT NULL,
            page_portal VARCHAR(200) NOT NULL)
             ");
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
        $this->db->query("INSERT into $TableToInsert Values(:page_id,   :page_title, :page_name, :page_content,:post_status, :parentPage,:type, :pageDate,:page_mime_type, :page_users, :page_portal, :page_login)");
        $this->db->bind(":page_id", $data['page_iD']);
        $this->db->bind(":page_content", $data['page_content']);
        $this->db->bind(":page_name", $data['page_name']);
        $this->db->bind(":page_title", $data['page_title']);
        $this->db->bind(":page_mime_type", $data['page_mime_type']);
        $this->db->bind(":post_status", $data['page_status']);
        $this->db->bind(":parentPage", $data['parent_page']);
        $this->db->bind(":type", $data['page_type']);
        $this->db->bind(":pageDate", $data['page_date']);
        $this->db->bind(":page_users", $data['page_users']);
        $this->db->bind(":page_portal", $data['page_portal']);
        $this->db->bind(":page_login", $data['page_login']);
        $this->db->execute();
    }

    public function mulSelector($whatToSelect, $TableToSelect)
    {
        $this->db->query("SELECT $whatToSelect from $TableToSelect");
        $result = $this->db->resultSet();
        return $result;
    }
    public function mulSelector_opt($whatToSelect, $TableToSelect, $option)
    {
        $this->db->query("SELECT $whatToSelect from $TableToSelect :option ");
        $this->db->bind(":option", $option);
        $result = $this->db->resultSet();
        return $result;
    }

    public function mul_sel_opt($whatToSelect, $TableToSelect, $whereToSelect,  $data)
    {
        $this->db->query("SELECT $whatToSelect from $TableToSelect where  $whereToSelect = :data ");
        $this->db->bind(":data", $data);
        $result = $this->db->resultSet();
        return $result;
    }
    public function grab_login_details($data)
    {
        $this->db->query(" SELECT * from en_members where members_group_users = :users && members_name = :username;");
        $this->db->bind(":username", $data['username']);
        $this->db->bind(":users", $data['group_user']);
        $result = $this->db->resultSet();
        return $result;
    }

    public function G_userInsert($data)
    {
        $this->db->query("INSERT INTO en_users VALUES(:usersID, :group_user_name, :allowed_members)");
        $this->db->bind(":usersID", $data['group_user_id']);
        $this->db->bind(":group_user_name", $data['group_user_name']);
        $this->db->bind(":allowed_members", $data['allowed_members']);
        $result = $this->db->execute();
    }
}
