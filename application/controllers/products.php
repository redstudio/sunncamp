<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('captcha_model');
        $this->load->model('products_model');
    }

    function index() {
        redirect('products/main', 'refresh');
    }

    /**
     * Main product page
     */
    function main() {
        $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();
        $data['sidebox'] = "sidebox/product_cats";
        $data['content'] = $this->content_model->get_content('products');
        $data['main_content'] = "global/sunncamp/content";

        $this->load->vars($data);
        $this->load->view('template/main');
    }

    function show($product_id) {

        $segment_active = $this->uri->segment(3);
        if ($segment_active != NULL) {
            $data['menu'] = $this->uri->segment(3);
        } else {
            $data['menu'] = $this->uri->segment(1);
        }

        //get product
        $data['images'] = $this->products_model->get_product_images($product_id);
         $data['defaultimage'] = $this->products_model->get_default_image($product_id);
        $data['product'] = $this->products_model->get_product($product_id);
         foreach ($data['product'] as $row):

            $data['product_name'] = $row->product_name;
        

        endforeach;
        
        
        $data['categories'] = $this->products_model->get_product_categories($product_id);
        $data['attributes'] = $this->products_model->get_attributes($product_id);

        $data['imagezoom'] = TRUE;
        $data['content'] = $this->content_model->get_content($data['menu']);
        $data['captcha'] = $this->captcha_model->initiate_captcha();
        foreach ($data['content'] as $row):

            $data['title'] = $row->title;
            $data['sidebox'] = $row->sidebox;
            $data['metatitle'] = $row->meta_title;
            $data['meta_description'] = $row->meta_desc;
            $data['slideshow'] = $row->slideshow;

        endforeach;
         $data['categories'] = $this->products_model->get_all_product_cats();
        $data['sidebox'] = "sidebox/product_cats";
        $data['sidebar'] = "sidebox/side";
        $data['main_content'] = "pages/view_product";

        $data['section2'] = 'global/links';
        $data['seo_links'] = $this->content_model->get_seo_links();
        if ($this->session->flashdata('message')) {
            $data['message'] = $this->session->flashdata('message');
        }


        $this->load->vars($data);
        $this->load->view('template/main');
    }

    function category($category_name) {

        $data['title'] = $category_name;
        $data['products'] = $this->products_model->get_products_by_cat($category_name);
        foreach($data['products'] as $row):
            
            $data['cat_id'] = $row->parent;
            
        endforeach;
        $data['categories'] = $this->products_model->get_all_product_cats();
        $data['category_parents'] = $this->products_model->get_all_product_parents();
        $data['sidebox'] = "sidebox/product_cats";
        $data['content'] = $this->content_model->get_content('product_category');
        $data['main_content'] = "pages/product_category";

        $this->load->vars($data);
        $this->load->view('template/main');
    }

}