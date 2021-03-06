<?php

	class Usercart extends MY_Controller
	{

		function __Construct()
		{
			parent::__Construct();
			$this -> load -> library(array(
				'encrypt',
				'form_validation',
				'user_agent'
			));
			$this -> is_logged_in();
			$this -> load -> model('company_model');
			$this -> load -> model('content_model');
			$this -> load -> model('products_model');
			$this -> load -> model('cart_model');
			$this -> load -> model('menu_model');
		}

		function index()
		{
			echo "hello world.";
		}

		function view_cart()
		{
			
			if ($this -> session -> flashdata('message'))
			{
				$data['message'] = $this -> session -> flashdata('message');
			}
			$data['user_id'] = $this -> session -> userdata('user_id');
			$data['categories'] = $this -> products_model -> get_all_product_cats();
			$data['category_parents'] = $this -> products_model -> get_all_product_parents();
			// $data['sidebox'] = "sidebox/product_cats";
			$data['cart'] = $this -> cart_model -> list_cart_contents($data['user_id'], 0);
			$data['order'] = $this -> cart_model -> list_orders($data['user_id']);
			$data['order_ids'] = $this -> cart_model -> order_ids($data['user_id']);
			$data['main_content'] = "cart/view_cart";

			$this -> load -> vars($data);
			$this -> load -> view('template/main');
		}
		
		function checkout()
		{
			
			if ($this -> session -> flashdata('message'))
			{
				$data['message'] = $this -> session -> flashdata('message');
			}
			$data['user_id'] = $this -> session -> userdata('user_id');
			$data['categories'] = $this -> products_model -> get_all_product_cats();
			$data['category_parents'] = $this -> products_model -> get_all_product_parents();
			// $data['sidebox'] = "sidebox/product_cats";
			$data['cart'] = $this -> cart_model -> list_cart_contents($data['user_id'], 0);
			$data['order'] = $this -> cart_model -> list_orders($data['user_id']);
			$data['order_ids'] = $this -> cart_model -> order_ids($data['user_id']);
			$data['main_content'] = "cart/checkout";

			$this -> load -> vars($data);
			$this -> load -> view('template/main');
		}

		function your_account()
		{
			$data['user_id'] = $this -> session -> userdata('user_id');
			$data['user_data'] = $this ->company_model -> get_user_details($data['user_id']);
			$data['categories'] = $this -> products_model -> get_all_product_cats();
			$data['title'] = "Your Account";
			$data['category_parents'] = $this -> products_model -> get_all_product_parents();
			// $data['sidebox'] = "sidebox/product_cats";
			if ($this -> session -> flashdata('message'))
			{
				$data['message'] = $this -> session -> flashdata('message');
			}

			$data['main_content'] = "cart/view_account";

			$this -> load -> vars($data);
			$this -> load -> view('template/main');
		}
		
		function shipping_address()
		{
			$data['user_id'] = $this -> session -> userdata('user_id');
			$data['user_data'] = $this ->company_model -> get_user_details($data['user_id']);
			$data['categories'] = $this -> products_model -> get_all_product_cats();
			$data['title'] = "Address";
			$data['category_parents'] = $this -> products_model -> get_all_product_parents();
			// $data['sidebox'] = "sidebox/product_cats";
			if ($this -> session -> flashdata('message'))
			{
				$data['message'] = $this -> session -> flashdata('message');
			}

			$data['main_content'] = "cart/view_account";

			$this -> load -> vars($data);
			$this -> load -> view('template/main');
		}
		
		function choose_shipping()
		{
			$data['user_id'] = $this -> session -> userdata('user_id');
			$data['user_data'] = $this ->company_model -> get_user_details($data['user_id']);
			$data['categories'] = $this -> products_model -> get_all_product_cats();
			$data['title'] = "Shipping";
			$data['category_parents'] = $this -> products_model -> get_all_product_parents();
			// $data['sidebox'] = "sidebox/product_cats";
			if ($this -> session -> flashdata('message'))
			{
				$data['message'] = $this -> session -> flashdata('message');
			}

			$data['main_content'] = "cart/choose_shipping";

			$this -> load -> vars($data);
			$this -> load -> view('template/main');
		}

		function change_stock_level()
		{

			$user_id = $this -> input -> post('user_id');
			$option_id = $this -> input -> post('option_id');
			$sum = $this -> input -> post('sum');

			$query = $this -> cart_model -> update_stock($user_id, $option_id, $sum);
			echo $sum;
		}

		function change_cart_quantity()
		{

			$option_id = $this -> input -> post('option_id');
			$user_id = $this -> input -> post('user_id');
			$cart_value = $this -> input -> post('cart_value');

			$this -> cart_model -> update_cart($option_id, $user_id, $cart_value);
		}

		function process_payment()
		{

			$cost = $this -> input -> post('cost');
			$this -> session -> set_flashdata('cost', $cost);
			$params = array(
				'amount' => $cost,
				'currency' => $this->currencyval,
				'return_url' => base_url() . 'usercart/payment_return',
				'cancel_url' => base_url() . 'usercart/payment_cancel'
			);

			$response = $this -> merchant -> purchase($params);
			echo '<pre>';
			print_r($response);

		}

		function payment_return()
		{
			echo "success";
			$cost = $this -> session -> flashdata('cost');
			$params = array(
				'amount' => $cost,
				'currency' => 'EUR'
			);

			$response = $this -> merchant -> purchase_return($params);
			echo '<pre>';
			print_r($response);


			if ($response -> success())
			{
				// mark order as complete
				$gateway_reference = $response -> reference();
				
				$this->make_order($gateway_reference, 1);
				$this->session->set_flashdata('message', "Payment has been received.");
				redirect('usercart/view_cart', 'refresh');
				
			}
			else
			{
				$message = $response -> message();
				
				$this->session->set_flashdata('message', 'Error processing payment: ' . $message);
				
				redirect('usercart/view_cart', 'refresh');
				
			}
		}

		function payment_cancel()
		{
			$this->session->set_flashdata('message', 'Payment Processing Cancelled');
				
				redirect('usercart/view_cart', 'refresh');

		}

		function make_order($gateway_reference, $order_status)
		{
			$user_id = $this -> session -> userdata('user_id');

			//create order
			$this -> cart_model -> create_order($user_id, $gateway_reference, $order_status);

			//get inserted id
			$order_id = mysql_insert_id();

			//update user cart to an order

			//TODO check if item has been ordered  already and append
			$this -> cart_model -> convert_cart_to_order($user_id, $order_id);

			//  redirect($this->agent->referrer(), 'refresh');
		}

		function is_logged_in()
		{
			$is_logged_in = $this -> session -> userdata('is_logged_in');
			$role = $this -> session -> userdata('role');
			if ($is_logged_in == NULL || $role > 5)
			{
				$data['message'] = "You don't have permission";
				redirect('welcome/login', 'refresh');
			}
		}

	}
