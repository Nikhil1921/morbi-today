<?php defined('BASEPATH') OR exit('No direct script access allowed');

class EPaper extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->redirect = admin("ePaper");
    }

    private $name = 'e_paper';
    private $title = 'e paper';
    private $table = "e_paper";

    protected $validate = [
        [
            'field' => 'cat_name',
            'label' => 'Category',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'paper_date',
            'label' => 'E Paper Date',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ]
    ];

    public function index()
    {
        $data['name'] = $this->name;
        $data['title'] = $this->title;
        $data['url'] = $this->redirect;
        $data['dataTables'] = TRUE;

        $this->template->load(admin('template'), $this->redirect.'/home', $data);
    }

    public function get()
    {
        $fetch_data = $this->main->make_datatables('e_paper_model');
        $sr = $_POST['start'] + 1;
        $data = array();

        foreach($fetch_data as $row)  
        {  
            $sub_array = array();
            $sub_array[] = $sr;
            $sub_array[] = date('d-m-Y', $row->paper_date);
            $sub_array[] = $row->cat_name;

            $sub_array[] = '<div class="ml-0 table-display row">'.anchor($this->redirect.'/update/'.e_id($row->id), '<i class="fa fa-edit"></i>', 'class="btn btn-outline-primary mr-2"').
                    form_open($this->redirect.'/delete', ['id' => e_id($row->id)], ['id' => e_id($row->id)]).form_button([ 'content' => '<i class="fas fa-trash"></i>','type'  => 'button','class' => 'btn btn-outline-danger', 'onclick' => "remove(".e_id($row->id).")"]).form_close().'</div>';

            $data[] = $sub_array;  
            $sr++;
        }
        
        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();  

        $output = array(  
            "draw"              => intval($_POST["draw"]),  
            "recordsTotal"      => $this->main->count($this->table, ['is_deleted' => 0]),
            "recordsFiltered"   => $this->main->get_filtered_data('e_paper_model'),
            "data"              => $data,
            $csrf_name          => $csrf_hash
        );
        
        echo json_encode($output);
    }

    public function add()
    {
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['operation'] = "add";
            $data['select'] = TRUE;
            $data['url'] = $this->redirect;
            $data['cats'] = $this->main->getall('paper_category', 'id, cat_name', ['is_deleted' => 0]);
            return $this->template->load(admin('template'), $this->redirect.'/add', $data);
        }
        else
        {
            $img = $this->uploadImage();
            if (!file_exists("assets/epaper/$img")) {
                flashMsg(0, "", $img, $this->redirect.'/add');
            }else{
                $post = [
                    'cat_id' => $this->input->post('cat_name'),
                    'paper_date' => strtotime($this->input->post('paper_date')),
                    'image'    => $img
                ];

                $id = $this->main->add($post, $this->table);

                flashMsg($id, ucwords($this->title)." Added Successfully.", ucwords($this->title)." Not Added. Try again.", $this->redirect);
            }
        }
    }

    public function edit($id)
    {
        $data['name'] = $this->name;
        $data['id'] = $id;
        $data['title'] = $this->title;
        $data['operation'] = "update";
        $data['colorpicker'] = TRUE;
        $data['url'] = $this->redirect;
        $data['cats'] = $this->main->getall('paper_category', 'id, cat_name', ['is_deleted' => 0]);
        $data['data'] = $this->main->get($this->table, 'id, cat_id, image, paper_date', ['id' => d_id($id)]);
        
        if ($data['data']) 
        {
            $this->session->set_flashdata('updateId', $id);
            return $this->template->load(admin('template'), $this->redirect.'/update', $data);
        }
        else
            return $this->error_404();
    }
    public function update($id)
    {
        $this->form_validation->set_rules($this->validate);
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->edit($id);
        }
        else
        {
            $updateId = $this->session->updateId;
            $this->session->set_flashdata('updateId', $updateId);
            $img = $this->uploadImage($this->input->post('image'));
            if (!file_exists("assets/epaper/$img")) {
                flashMsg(0, "", $img, $this->redirect."/update($id)");
            }else{
                $post = [
                        'cat_id' => $this->input->post('cat_name'),
                        'paper_date' => strtotime($this->input->post('paper_date')),
                        'image'    => $img
                    ];

                $id = $this->main->update(['id' => d_id($updateId)], $post, $this->table);

                flashMsg($id, ucwords($this->title)." Updated Successfully.", ucwords($this->title)." Not Updated. Try again.", $this->redirect);
            }
        }
    }

    public function delete()
    {
        $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);

        flashMsg($id, ucwords($this->title)." Deleted Successfully.", ucwords($this->title)." Not Deleted. Try again.", $this->redirect);
    }

    protected function uploadImage($unlink='')
    {
        if (!empty($_FILES['image']['name'])) {
            $config = [
                'upload_path'      => "assets/epaper/",
                'allowed_types'    => 'pdf',
                'file_name'        => time(),
                'file_ext_tolower' => TRUE
            ];

            $this->upload->initialize($config);
            if ($this->upload->do_upload("image")){
                if ($unlink && $unlink != 'No Image' && file_exists($config['upload_path'].$unlink))
                    unlink($config['upload_path'].$unlink);
                return $this->upload->data("file_name");
            }
            else
                return $this->upload->display_errors();
        }else {
            if ($unlink)
                return $unlink;
            else
                return "Select E paper.";
        }
    }
}