<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->redirect = admin("gallery");
        $this->config->set_item('global_xss_filtering', false);
	}

	private $name = 'gallery';
    private $title = 'gallery';
    private $table = "gallery";

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
        $fetch_data = $this->main->make_datatables('gallery_model');
        $sr = $_POST['start'] + 1;
        $data = array();

        foreach($fetch_data as $row)  
        {  
            $sub_array = array();
            $sub_array[] = $sr;
            $sub_array[] = $row->title;
            $sub_array[] = img(['src' => $this->set_upload_options()['upload_path'].$row->thumb, 'onclick' => 'myCopyFunction(\''.base_url().$this->set_upload_options()['upload_path'].$row->image.'\')']);

            $sub_array[] = '<div class="ml-0 table-display row">'.
                    form_open($this->redirect.'/delete', ['id' => e_id($row->id)], ['id' => e_id($row->id)]).form_button([ 'content' => '<i class="fas fa-trash"></i>','type'  => 'button','class' => 'btn btn-outline-danger', 'onclick' => "remove(".e_id($row->id).")"]).form_close().'</div>';

            $data[] = $sub_array;  
            $sr++;
        }
        
        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();  

        $output = array(
            "draw"              => intval($_POST["draw"]),  
            "recordsTotal"      => $this->main->count($this->table, ['is_deleted' => 0]),
            "recordsFiltered"   => $this->main->get_filtered_data('gallery_model'),
            "data"              => $data,
            $csrf_name          => $csrf_hash
        );
        
        echo json_encode($output);
    }

    public function upload()
    {
        if (!$this->input->is_ajax_request()): return redirect($this->redirect); endif;
        if (!$title = $this->input->post('title')):
            echo json_encode(['error' => true, 'message' => "Enter title first"]); die();
        endif;
        $id = 0;
        $this->load->library('upload');
        $this->load->library('image_lib');
        $files = $_FILES;
        $cpt = count($_FILES['image']['name']);
        for($i=0; $i<$cpt; $i++)
        {           
            $_FILES['image']['name']= $files['image']['name'][$i];
            $_FILES['image']['type']= $files['image']['type'][$i];
            $_FILES['image']['tmp_name']= $files['image']['tmp_name'][$i];
            $_FILES['image']['error']= $files['image']['error'][$i];
            $_FILES['image']['size']= $files['image']['size'][$i];

            $this->upload->initialize($this->set_upload_options());
            if ($this->upload->do_upload("image")):
                $img = $this->upload->data('file_name');
                $thumb = explode('.', $img);
                $thumb = reset($thumb).'_thumb.'.end($thumb);
                
                $this->image_lib->initialize($this->set_watermark_options($this->upload->data('full_path')));
                $this->image_lib->watermark();
                $this->image_lib->clear();

                $this->image_lib->initialize($this->set_resize_options($this->upload->data('full_path')));
                $this->image_lib->resize();
                $this->image_lib->clear();

                $id = $this->main->add(['title' => $title, 'image' => $img, 'thumb' => $thumb], $this->table);
            endif;
        }

        if ($id)
            $return = ['error' => false, 'message' => "Images uploaded."];
        else
            $return = ['error' => true, 'message' => "Images not uploaded."];

        echo json_encode($return); die();
    }

    public function delete()
	{
		$id = d_id($this->input->post('id'));
        if ($image = $this->main->get($this->table, 'image, thumb', ['id' => $id])) {
            $del = $this->main->delete($this->table, ['id' => $id]);
            if($del && is_file("assets/gallery/".$image['image'])) unlink("assets/gallery/".$image['image']);
            if($del && is_file("assets/gallery/".$image['thumb'])) unlink("assets/gallery/".$image['thumb']);
        }else{
            $del = 0;
        }

		flashMsg($id, ucwords($this->title)." Deleted Successfully.", ucwords($this->title)." Not Deleted. Try again.", $this->redirect);
	}

    private function set_resize_options($path)
    {
        $conf['source_image'] = $path;
        $conf['create_thumb'] = TRUE;
        $conf['maintain_ratio'] = TRUE;
        $conf['width']         = 50;
        $conf['height']       = 50;

        return $conf;
    }

    private function set_watermark_options($path)
    {
        $conf['source_image'] = $path;
        $conf['wm_text'] = 'Morbi Today';
        $conf['wm_type'] = 'text';
        $conf['wm_font_size'] = '200';
        $conf['wm_font_color'] = 'E3242B';
        $conf['wm_vrt_alignment'] = 'bottom';
        $conf['wm_hor_alignment'] = 'center';

        return $conf;
    }

    private function set_upload_options()
    {
        $config = [
                'upload_path'      => "assets/gallery/",
                'allowed_types'    => 'jpg|jpeg|png',
                'file_name'        => time(),
                'file_ext_tolower' => TRUE
            ];

        return $config;
    }
}