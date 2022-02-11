<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('seo_helper');
    }

    public $appId = '338557840957387';
    public $appSecret = '1bdfead21cbf3a96400f6646236afdd9';
    public $pageId = 'morbitodaynews';
    public $userAccessToken = 'EAAEz6qPYn8sBABcuM7uRvMeX60GYaS9GarC5adZCh9o4M27gZA7iVZAIi8ygRz80MvlbIQmp2uRXtLNPAVD9wNF9SjkvBc2DZAgmjGBmmgCWLjCkMoJnxZBO9LD5sXE1N3eC7rZBV8zmIsgoCjcetNktozWLt6vIPUnXACuFanKYZAWg6WC0ceZBWf7Oe44wAv8vXH78ZCtZCkNFgg93NquklWcwfPbuMHHlcZD';

	public function index()
    {
        $data['title'] = 'home';
        $data['name'] = 'Morbi Today';
        $this->load->model('blog_model');
        $this->load->library('pagination');
        $url = base_url();
        if ($this->input->get('search'))
            $url = $url.'?search='.$this->input->get('search');
            $config =   [
                            "base_url"              => $url,
                            "total_rows"            => $this->blog_model->get_blog_count(),
                            "per_page"              => 10,
                            "page_query_string"     => true,
                            "enable_query_strings"  => true,
                            "use_global_url_suffix" => true,
                            "query_string_segment"  => 'page',
                            "full_tag_open"         => '<ul class="pagination-list">',
                            "full_tag_close"        => '</ul>',
                            "first_tag_open"        => '<li>',
                            "first_tag_close"       => '</li>',
                            "last_tag_open"         => '<li>',
                            "last_tag_close"        => '</li>',
                            'next_link'             => 'Next',
                            "next_tag_open"         => '<li>',
                            "next_tag_close"        => '</li>',
                            "prev_link"             => "Prev",
                            "prev_tag_open"         => "<li>",
                            "prev_tag_close"        => "</li>",
                            "cur_tag_open"          => "<li><a class='active' href='javascript:void(0)'>",
                            "cur_tag_close"         => "</a></li>",
                            "num_tag_open"          => "<li>",
                            "num_tag_close"         => "</li>",
                            'first_link'            => "First",
                            'last_link'             => "Last"
                        ];

        $this->pagination->initialize($config);
        
        $page = ($this->input->get('page')) ? $this->input->get('page') : 0;
        
        $data['news'] = $this->blog_model->get_blogs($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['cats'] = $this->main->getall('blog_category', 'id, cat_name, CONCAT("'.assets('blog').'", cat_image) cat_image', ['is_deleted' => 0], 'id ASC');
        if ($this->input->get('search')) {
            return $this->template->load(front('template'), front('search'), $data);
        }else{
            $data['news_limit'] = $this->main->getall('blog', 'id, title, LEFT (details, 70) details, CONCAT("'.assets('blog/').'", image) image, cat_id, created_at', ['is_deleted' => 0], 'id DESC', '4');
            return $this->template->load(front('template'), front('home'), $data);
        }
    }

    public function news($id)
    {
        $id = d_id($id);
        $data['title'] = 'News';
        $data['name'] = 'Morbi Today';
        $data['id'] = $id;
        $data['cats'] = $this->main->getall('blog_category', 'id, cat_name, CONCAT("'.assets('blog').'", cat_image) cat_image', ['is_deleted' => 0], 'id ASC');
        $data['news'] = $data['seo'] = $this->main->get('blog', 'id, title, details, CONCAT("'.assets('blog/').'", image) image, created_at, images, views', ['id' => $id]);
        
        if ($data['news']) {
            $this->main->update(['id' => $id], ['views' => ($data['news']['views'] + 1)], 'blog');
            return $this->template->load(front('template'), front('news'), $data);
        }else{
            return error_404();
        }
    }

    public function category($id, $pag=0)
    {
        $data['title'] = 'News';
        $data['name'] = 'Morbi Today';
        $data['cats'] = $this->main->getall('blog_category', 'id, cat_name, CONCAT("'.assets('blog').'", cat_image) cat_image', ['is_deleted' => 0], 'id ASC');
        $this->load->model('blog_model');
        $this->load->library('pagination');

        $config =   [
                        "base_url"           => base_url() . "category/$id",
                        "total_rows"         => $this->blog_model->get_count(d_id($id)),
                        "per_page"           => 10,
                        "uri_segment"        => 3,
                        "full_tag_open"      => '<ul class="pagination-list">',
                        "full_tag_close"     => '</ul>',
                        "first_tag_open"     => '<li>',
                        "first_tag_close"    => '</li>',
                        "last_tag_open"      => '<li>',
                        "last_tag_close"     => '</li>',
                        'next_link'          => 'Next',
                        "next_tag_open"      => '<li>',
                        "next_tag_close"     => '</li>',
                        "prev_link"          => "Prev",
                        "prev_tag_open"      => "<li>",
                        "prev_tag_close"     => "</li>",
                        "cur_tag_open"       => "<li><a class='active' href='javascript:void(0)'>",
                        "cur_tag_close"      => "</a></li>",
                        "num_tag_open"       => "<li>",
                        "num_tag_close"      => "</li>",
                        'first_link'         => "First",
                        'last_link'          => "Last"
                    ];


        $id = d_id($id);
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["links"] = $this->pagination->create_links();

        $data['news'] = $this->blog_model->get_authors($config["per_page"], $page, $id);
        $data['category'] = $this->main->check('blog_category', ['id' => $id], 'cat_name');
        
        return $this->template->load(front('template'), front('category'), $data);
    }

    public function epaper()
    {
        $data['title'] = 'E paper';
        $data['name'] = 'Morbi Today';
        $data['cats'] = $this->main->getall('blog_category', 'id, cat_name, CONCAT("'.assets('blog').'", cat_image) cat_image', ['is_deleted' => 0], 'id ASC');
        $date = strtotime($this->input->get('paper-date'));
        $this->load->model('e_paper_model', 'epaper');
        if ($date)
            $data['papers'] = $this->epaper->getepaper($date);
        else
            $data['papers'] = [];
        
        return $this->template->load(front('template'), front('epaper'), $data);
    }

    public function paper($id)
    {
        $data['title'] = 'E paper';
        $data['name'] = 'Morbi Today';
        $data['cats'] = $this->main->getall('blog_category', 'id, cat_name, CONCAT("'.assets('blog').'", cat_image) cat_image', ['is_deleted' => 0], 'id ASC');
        $data['epaper'] = $this->main->get('e_paper', 'paper_date,  CONCAT("'.assets('epaper/').'", image) image', ['id' => d_id($id)]);
        
        if ($data['epaper']) {
            return $this->template->load(front('template'), front('paper'), $data);
        }else{
            return error_404();
        }
    }

    public function video()
    {
        $data['title'] = 'video News';
        $data['name'] = 'Morbi Today';
        $data['cats'] = $this->main->getall('blog_category', 'id, cat_name, CONCAT("'.assets('blog').'", cat_image) cat_image', ['is_deleted' => 0], 'id ASC');
        if ($vid = $this->input->get('vid')):
            $data['mainNews'] = $this->main->get('video', 'id, link, name', ['id' => d_id($vid)], 'id DESC');
        endif;
        $data['videos'] = $this->main->getall('video', 'id, name, link', ['is_deleted' => 0], 'id DESC');
        return $this->template->load(front('template'), front('videoNews'), $data);
    }

    public function about()
    {
        $data['title'] = 'About US';
        $data['name'] = 'Morbi Today';
        $data['cats'] = $this->main->getall('blog_category', 'id, cat_name, CONCAT("'.assets('blog').'", cat_image) cat_image', ['is_deleted' => 0], 'id ASC');
        
        return $this->template->load(front('template'), front('about'), $data);
    }

    public function contact()
    {
        $data['title'] = 'Contact US';
        $data['name'] = 'Morbi Today';
        $data['cats'] = $this->main->getall('blog_category', 'id, cat_name, CONCAT("'.assets('blog').'", cat_image) cat_image', ['is_deleted' => 0], 'id ASC');
        
        return $this->template->load(front('template'), front('contact'), $data);
    }

    public function submitNews()
    {
        $data['title'] = 'Submit News';
        $data['name'] = 'submitNews';
        $data['cats'] = $this->main->getall('blog_category', 'id, cat_name, CONCAT("'.assets('blog').'", cat_image) cat_image', ['is_deleted' => 0], 'id ASC');
        
        return $this->template->load(front('template'), front('submitNews'), $data);
    }

    public function submitNewsPost()
    {
        $this->form_validation->set_rules($this->submitNews);
        $this->form_validation->set_error_delimiters('<div class="text-danger" style="    margin-top: -10px;">', '</div>');

        if ($this->form_validation->run() == FALSE)
            return $this->submitNews();
        else{

            $post = [
                'name'    => $this->input->post('name'),
                'email'   => $this->input->post('email'),
                'place'   => $this->input->post('place'),
                'mobile'  => $this->input->post('mobile'),
                'article' => $this->input->post('article'),
                'image1'  => $this->uploadImage('image1'),
                'image2'  => $this->uploadImage('image2'),
                'image3'  => $this->uploadImage('image3'),
            ];

            $id = $this->main->add($post, 'submit_news');

            flashMsg($id, "News Submitted Successfully.", "News Not Submitted. Try again.", 'home/submitNews');
        }
    }

    /*public function video()
    {
        $data['title'] = 'video News';
        $data['name'] = 'Morbi Today';
        $data['cats'] = $this->main->getall('blog_category', 'id, cat_name, CONCAT("'.assets('blog').'", cat_image) cat_image', ['is_deleted' => 0], 'id ASC');
        
        return $this->template->load(front('template'), front('video'), $data);
    }*/

    public function facebook()
    {
        $data['title'] = 'facebook feeds';
        $data['name'] = 'facebook';
        $data['cats'] = $this->main->getall('blog_category', 'id, cat_name, CONCAT("'.assets('blog').'", cat_image) cat_image', ['is_deleted' => 0], 'id ASC');
        /*$fb = new Facebook([
            'app_id' => $this->appId,
            'app_secret' => $this->appSecret,
            'default_graph_version' => 'v3.1'
        ]);
        $userPosts = $fb->get("/$this->pageId/feed", $this->userAccessToken);
        $postBody = $userPosts->getDecodedBody();
        
        $data['facebook'] = $postBody["data"];*/
        
        return $this->template->load(front('template'), front('facebook'), $data);
    }

    protected function uploadImage($image)
    {
        $config = [
            'upload_path'      => "assets/news/",
            'allowed_types'    => 'jpg|jpeg|png',
            'file_name'        => time(),
            'file_ext_tolower' => TRUE
        ];

        $this->upload->initialize($config);
        
        if ($this->upload->do_upload($image))
            return $this->upload->data("file_name");
        else
            return 'No Image';
    }

    public function all_news($rowno=0)
    {
        $this->load->library('pagination');
        $this->load->model('blog_model');
        $rowperpage = 4;
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
  
        $config = [
            'base_url' => base_url(),
            'use_page_numbers' => TRUE,
            'total_rows' => $this->blog_model->get_blog_count(),
            'per_page' => $rowperpage,
            'display_pages' => FALSE,
            'first_link' => false,
            'last_link' => false,
            'next_link' => '',
            'next_tag_open' => '<div class="paginate-next">',
            'next_tag_close' => '</div>',
            'prev_link' => '',
            'prev_tag_open' => '<div class="paginate-prev">',
            'prev_tag_close' => '</div>'
        ];
 
        $this->pagination->initialize($config);
        $news = $this->blog_model->get_blogs($rowperpage, $rowno);
        foreach ($news as $k => $v):
            $news[$k]['id'] = e_id($v['id']);
            $news[$k]['link'] = base_url('news/'.e_id($v['id']));
            $news[$k]['date'] = date('d-m-Y h:i A', strtotime($v['created_at']));
        endforeach;
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $news;
        
        echo json_encode($data);
    }

    protected $submitNews = [
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => "%s is Required",
                'max_length' => "%s must less than 255 characters"
            ]
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => "%s is Required",
                'max_length' => "%s must less than 255 characters"
            ]
        ],
        [
            'field' => 'place',
            'label' => 'Place',
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => "%s is Required",
                'max_length' => "%s must less than 255 characters"
            ]
        ],
        [
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|exact_length[10]|is_natural',
            'errors' => [
                'required' => "%s is Required",
                'exact_length' => "%s is Invalid",
                'is_natural' => "%s is Invalid"
            ]
        ],
        [
            'field' => 'article',
            'label' => 'Article',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ]
    ];
}