<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class Blog extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->redirect = admin("blog");
        $this->config->set_item('global_xss_filtering', false);
	}

	private $name = 'blog';
    private $title = 'blog';
    private $table = "blog";

	protected $validate = [
        [
            'field' => 'cat_id',
            'label' => 'Category',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'title',
            'label' => 'Blog Title',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'details',
            'label' => 'Blog details',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ]
    ];

    public function slug_check($str)
    {   

        $id = $this->session->updateId;
        
        if ((!empty($id) && $this->main->check($this->table, ['blog_slug' => $str, 'id != ' => d_id($id)], 'id')) || (empty($id) && $this->main->check($this->table, ['blog_slug' => $str], 'id')))
        {
            $this->form_validation->set_message('slug_check', 'The %s is already in use');
            return FALSE;
        } else{
            return TRUE;
        }
    }

	public function index()
	{
		$data['name'] = $this->name;
		$data['title'] = $this->title;
        $data['url'] = $this->redirect;
        $data['dataTables'] = TRUE;
        /*set_time_limit(0);
        $blogs = $this->main->getall('blog', 'id, image', ['image != ' => 'No Image'], 'id DESC');
        
        foreach($blogs as $blog){
            $img = $blog['image'];
            $ext = explode('.', $img);
            $start = reset($ext);
            $ext = end($ext);
            
            if($ext == 'jpg' || $ext == 'jpeg')
            {
                $image = imagecreatefromjpeg("assets/blog/".$img);    
            }
            if($ext == 'png')
            {
                $image = imagecreatefrompng("assets/blog/".$img);
            }

            if($image){
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                imagewebp($image, "assets/blog/$start.webp", 100);
                imagedestroy($image);
                $this->main->update(['id' => $blog['id']], ['image' => "$start.webp"], "blog");
                unlink("assets/blog/".$img);
            }
        }*/
        /*$blogs = $this->main->getall('blog', 'id, image', [], 'id DESC');
        foreach ($blogs as $v) {
            if (file_exists("assets/blog/".str_replace("webp", 'png', $v['image']))) {
                $img = str_replace("webp", 'png', $v['image']);
                $this->main->update(['id' => $v['id']], ['image' => $img], $this->table);
            }
            if (file_exists("assets/blog/".str_replace("webp", 'jpg', $v['image']))) {
                $img = str_replace("webp", 'jpg', $v['image']);
                $this->main->update(['id' => $v['id']], ['image' => $img], $this->table);
            }
            if (file_exists("assets/blog/".str_replace("webp", 'jpeg', $v['image']))) {
                $img = str_replace("webp", 'jpeg', $v['image']);
                $this->main->update(['id' => $v['id']], ['image' => $img], $this->table);
            }
        }*/

        $this->template->load(admin('template'), $this->redirect.'/home', $data);
	}

	public function get()
    {
        $fetch_data = $this->main->make_datatables('blog_model');
        $sr = $_POST['start'] + 1;
        $data = array();

        foreach($fetch_data as $row)  
        {  
            $sub_array = array();
            $sub_array[] = $sr;
            $sub_array[] = $row->title;
            $sub_array[] = $row->cat_name;
            $sub_array[] = $row->views;
            $sub_array[] = date("d-m-Y h:i A", strtotime($row->created_at));
            $sub_array[] = '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" onclick="newsLink(\''.base_url('news/'.e_id($row->id).'/'.$row->slug).'\')">Preview</button>';

            $sub_array[] = '<div class="ml-0 table-display row">'.anchor($this->redirect.'/upload/'.e_id($row->id), '<i class="fa fa-image"></i>', 'class="btn btn-outline-info mr-2"').anchor($this->redirect.'/update/'.e_id($row->id), '<i class="fa fa-edit"></i>', 'class="btn btn-outline-primary mr-2"').
                    form_open($this->redirect.'/delete', ['id' => e_id($row->id)], ['id' => e_id($row->id)]).form_button([ 'content' => '<i class="fas fa-trash"></i>','type'  => 'button','class' => 'btn btn-outline-danger', 'onclick' => "remove(".e_id($row->id).")"]).form_close().'</div>';

            $data[] = $sub_array;  
            $sr++;
        }
        
        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();  

        $output = array(  
            "draw"              => intval($_POST["draw"]),  
            "recordsTotal"      => $this->main->count($this->table, ['is_deleted' => 0]),
            "recordsFiltered"   => $this->main->get_filtered_data('blog_model'),
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
            $data['cats'] = $this->main->getall('blog_category', 'id, cat_name', ['is_deleted' => 0]);
            return $this->template->load(admin('template'), $this->redirect.'/add', $data);
        }
        else
        {
            if ($this->input->post('gallery_image')):
                $new = explode('.', $this->input->post('gallery_image'));
                $img = time().'.'.end($new);
                copy("assets/gallery/".$this->input->post('gallery_image'), "assets/blog/".$img);
            else:
                $img = $this->uploadImage();
            endif;
            
        	$post = [
        		'cat_id'        => $this->input->post('cat_id'),
                'title'         => $this->input->post('title'),
                'slug'          => $this->clean($this->input->post('title')),
                'details'       => $this->input->post('details'),
                'created_at'    => date('Y-m-d H:i:s'),
                'image'         => $img
        	];
            
        	$id = $this->main->add($post, $this->table);

            if (!$id && file_exists("assets/blog/".$img)):
                unlink("assets/blog/".$img);
            endif;

            if($id):
                $this->postFb($post['title'], e_id($id));
            endif;

        	flashMsg($id, ucwords($this->title)." Added Successfully.", ucwords($this->title)." Not Added. Try again.", $this->redirect);
        }
	}

	public function view($id)
    {
        $data['name'] = $this->name;
        $data['title'] = $this->title;
        $data['operation'] = "view";
        $data['url'] = $this->redirect;
        $data['data'] = $this->main->get($this->table, 'title, details, image, audio, video, created_at, cat_id, sub_title, created_by, whatsapp_url, facebook_url, insta_url, tweeter_url, blog_slug, blogger_image', ['id' => d_id($id)]);

        if ($data['data']) 
            return $this->template->load(admin('template'), $this->redirect.'/view', $data);
        else
            return $this->error_404();
    }

	public function update($id)
	{
		$this->form_validation->set_rules($this->validate);
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['name'] = $this->name;
            $data['id'] = $id;
			$data['title'] = $this->title;
			$data['operation'] = "update";
	        $data['select'] = TRUE;
            $data['url'] = $this->redirect;
            $data['cats'] = $this->main->getall('blog_category', 'id, cat_name', ['is_deleted' => 0]);
			$data['data'] = $this->main->get($this->table, 'id, title, details, image, created_at, cat_id', ['id' => d_id($id)]);
			
			if ($data['data']) 
			{
				return $this->template->load(admin('template'), $this->redirect.'/update', $data);
			}
			else
				return $this->error_404();
        }
        else
        {
        	$unlink = $this->input->post('image');

            if ($this->input->post('gallery_image')):
                $new = explode('.', $this->input->post('gallery_image'));
                $img = time().'.'.end($new);
                copy("assets/gallery/".$this->input->post('gallery_image'), "assets/blog/".$img);
                
                if ($unlink && $unlink != 'No Image' && file_exists("assets/blog/".$unlink)):
                    unlink("assets/blog/".$unlink);
                endif;
            else:
                $img = $this->uploadImage($unlink);
            endif;
            
            $post = [
                'cat_id'        => $this->input->post('cat_id'),
                'title'         => $this->input->post('title'),
                'slug'          => $this->clean($this->input->post('title')),
                'details'       => $this->input->post('details'),
                'image'         => $img
            ];

        	$uid = $this->main->update(['id' => d_id($id)], $post, $this->table);
            
            if($uid):
                $this->postFb($post['title'], $id);
            endif;

            flashMsg($uid, ucwords($this->title)." Updated Successfully.", ucwords($this->title)." Not Updated. Try again.", $this->redirect);
        }
	}

    private function clean($string) {
        $this->load->helper(array('text', 'string'));
        $string = strtolower(url_title(convert_accented_characters($string), '-'));
        return reduce_multiples($string, '-', TRUE);
    }

	public function delete()
	{
		$id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);

		flashMsg($id, ucwords($this->title)." Deleted Successfully.", ucwords($this->title)." Not Deleted. Try again.", $this->redirect);
	}

    public function upload($id)
    {
        $images = $this->main->get($this->table, 'images', ['id' => d_id($id)]);
        if (!$this->input->is_ajax_request()) {
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['url'] = $this->redirect;
            $data['upload'] = TRUE;
            $data['imagepicker'] = TRUE;
            $data['operation'] = 'upload';
            $data['id'] = $id;
            $data['limit'] = 3;

            if ($images)
                return $this->template->load(admin('template'), $this->redirect.'/upload', $data);
            else
                return $this->error_404();
        }else{
            $this->load->library('upload');
            $dataInfo = array();
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
                    $dataInfo[$i] = $this->upload->data('file_name');
                endif;
            }
            if ($images['images']) {
                $image = explode(',', $images['images']);
                $image = array_merge($image, $dataInfo);
            }else{
                $image = $dataInfo;
            }

            if ($this->main->update(['id' => d_id($id)], ['images' => implode(',', $image)], $this->table))
                $return = ['error' => false, 'message' => "Images uploaded."];
            else
                $return = ['error' => true, 'message' => "Images not uploaded."];

            echo json_encode($return); die();
        }
    }

    public function showImages($id)
    {
        $images = $this->main->get($this->table, 'images', ['id' => d_id($id)]);
        if ($images['images']) {
            $return = '';
            foreach (explode(',', $images['images']) as $v)
                $return .= '<div class="col-3"><img src="'.base_url('assets/blog/').$v.'" class="img-fluid p-absolute d-block text-center" onclick="removeImage(\''.$id.'\', \''.$v.'\')"></div>';
        }else
            $return = '<div class="col-12"><div class="alert alert-danger">No Image uploaded.</div></div>';
        echo $return; die();
    }

    public function removeImage()
    {
        $id = d_id($this->input->post('id'));
        $img = $this->input->post('image');
        $images = $this->main->check($this->table, ['id' => $id], 'images');
        $images = explode(',', $images);
        $key = array_search($this->input->post('image'), $images);
        unset($images[$key]);
        if ($this->main->update(['id' => $id], ['images' => implode(',', $images)], $this->table)){
            unlink("assets/blog/".$img);
            $return = ['error' => false, 'message' => "Image removed."];
        }
        else
            $return = ['error' => true, 'message' => "Image not removed."];

        echo json_encode($return); die();
    }

    public function uploadImages()
    {
        if (!$this->input->is_ajax_request()): return error_404(); endif;
        $id = d_id($this->input->post('id'));
        $img = $this->input->post('image');
        if ($img):
            foreach ($img as $k => $i):
                $new = explode('.', $i);
                $new = reset($new).$this->input->post('id').'.'.end($new);
                $img[$k] = $new;
                copy("assets/gallery/".$i, "assets/blog/".$new);
            endforeach;
            
            $images = $this->main->check($this->table, ['id' => $id], 'images');
            if ($images):
                $image = explode(',', $images);
                $image = array_merge($image, $img);
            else:
                $image = $img;
            endif;
            
            $image = array_unique($image);

            if ($this->main->update(['id' => $id], ['images' => implode(',', $image)], $this->table))
                $return = ['error' => false, 'message' => "Images uploaded."];
            else
                $return = ['error' => true, 'message' => "Images not uploaded."];

        else:
            $return = ['error' => true, 'message' => "Select images to upload."];
        endif;

        echo json_encode($return); die();

    }

    private function set_upload_options()
    {
        $config = [
                'upload_path'      => "assets/blog/",
                'allowed_types'    => 'jpg|jpeg|png',
                'file_name'        => time(),
                'file_ext_tolower' => TRUE
            ];

        return $config;
    }

    public function getGallery()
    {
        if (!$this->input->is_ajax_request()): return error_404(); endif;
        $data['gallery'] = $this->main->getall('gallery', 'thumb, image', ['is_deleted' => 0]);
        return $this->load->view($this->redirect.'/multi_img', $data);
    }

    public function postFb($title, $id)
    {
        return true;
        /*$appId = '338557840957387';
        $appSecret = '1bdfead21cbf3a96400f6646236afdd9';
        $pageId = 'morbitodaynews';
        $userAccessToken = 'EAAEz6qPYn8sBAHW8JG2nY5xLSvdbGZC4FYApJk9VkPWCKrzGYPDH7tRRekR6KFZBZBtnyYnhqygzuSiaXidtVc7aNkbgg0z1vZAbrjcyBkpyURk9xsd6CPIrZAAbPbd26CdWnTQE1IOfAGnkMG1wASQSz7SPkXNLkN6AyTOR8CWwUGHY63bT7Rktpa3cWgnZC237CsTAro31qSeh9oE4lDKy6x1bM4xQkZD';*/
        $appId = '501670351157473';
        $appSecret = '7d13a3aade2feb8806000f91d7f2e6e7';
        $pageId = '101139828876073';
        $userAccessToken = 'EAAHIRDsTOOEBAASKIjPjZBggrCXdA9f3WnZCeW2jayIdJFa2LsbHnBf7rZCKsHJyfU1RNUZAPTHZB3OSeqBRR3aZCryIRhaoZBoaoJty59i2oLAyQIVanY7kY10byl5g4TlupyTSWYtb8YNqC5RqbWQo7jSyYJ22CMxFZBN6ZCIiX4IoglsDi5ZBXw7z8WJe72a5DASkOcEZAQvgwZDZD';
        $fb = new Facebook([
            'app_id' => $appId,
            'app_secret' => $appSecret,
            'default_graph_version' => 'v2.5'
        ]);
        
        $longLivedToken = $fb->getOAuth2Client()->getLongLivedAccessToken($userAccessToken);
        
        $fb->setDefaultAccessToken($longLivedToken);
        
        $response = $fb->sendRequest('GET', $pageId, ['fields' => 'access_token'])
            ->getDecodedBody();
        
        $foreverPageAccessToken = $response['access_token'];
        
        $fb->setDefaultAccessToken($foreverPageAccessToken);
        $feed = $fb->sendRequest('POST', "$pageId/feed", [
            'message' => $title,
            'link' => "https://morbitoday.com/news/$id",
        ]);
    }

    protected function uploadImage($unlink='')
    {
        if (!empty($_FILES['image']['name'])) {
            $config = [
                'upload_path'      => "assets/blog/",
                'allowed_types'    => 'jpg|jpeg|png',
                'file_name'        => time(),
                'file_ext_tolower' => TRUE
            ];

            if ($unlink && $unlink != 'No Image' && file_exists($config['upload_path'].$unlink))
                unlink($config['upload_path'].$unlink);

            $this->upload->initialize($config);
            if ($this->upload->do_upload("image")){
                /*$conf['image_library'] = 'GD2';
                                        
                $conf['source_image']  = $this->upload->data('full_path');
                $conf['wm_type']       = 'overlay';
                $conf['wm_overlay_path'] = 'assets/images/watermark.png';
                $conf['wm_opacity']    = '5%';
                $conf['wm_x_transp']    = 80;
                $conf['wm_y_transp']    = 80;
                $conf['wm_vrt_alignment'] = 'center';
                $conf['wm_hor_alignment'] = 'center';*/
                                        
                $conf['source_image'] = $this->upload->data('full_path');
                $conf['wm_text'] = 'Morbi Today';
                $conf['wm_type'] = 'text';
                $conf['quality'] = '100%';
                // $conf['wm_font_size'] = '2000';
                $conf['wm_font_color'] = 'E3242B';
                $conf['wm_vrt_alignment'] = 'bottom';
                $conf['wm_hor_alignment'] = 'center';
                
                $this->load->library('image_lib', $conf);
                $this->image_lib->watermark();
                $this->image_lib->clear();
                /*// Create and save
                $img = imagecreatefromjpeg($this->upload->data('full_path'));
                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);
                imagewebp($img, $this->upload->data('full_path'), 100);
                imagedestroy($img);*/
                
                return $this->upload->data("file_name");
            }
            else
                return 'No Image';
        }else {
            if ($unlink)
                return $unlink;
            else 
                return 'No Image';
        }
    }
}