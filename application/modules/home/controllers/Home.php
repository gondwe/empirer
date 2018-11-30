<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/* 
	*	project:Basics of a saloon enteprise
	*	@author:ace
	*	@date 2018Nov
	*	just one controller is enough. No models !
 */

class Home extends MX_Controller {

	public function index()
	{
		$data = [];
		serve('dashboard', $data);
	}


	public function employees(){serve("employees");}
	public function customers(){
		$data['customers'] = $this->db->limit(10)->order_by('id', 'DESC')->get('customers')->result();
		serve('customers', $data);
	}

/* render our services page */	
	public function services(){
		$data['services'] = $this->db->select('id, service_name as product_name, unit_cost as price')->limit(10)->order_by('id', 'DESC')->get('services')->result();
		serve('services', $data);
	}


/* updating tables */
	public function update($table){
		$post = $this->input->post();
		$id = array_pop($post);

		$this->db->where('id',$id);
		$this->db->update($table, $post);
		redirect('/'. $table);
	}

/* adding data */
	public function add($table){
		$post = $this->input->post();
		$this->db->insert($table, $post);
		redirect('/'.$table);
	}


/* deleting things */
	public function delete($table, $id){
		$this->db->delete($table, ['id'=>$id]);
	}

/* retrieve a list of  paid employees  */
	function salaries(){
		$data['salaries'] = $this->db->select("e.id, concat(e.first_name, ' ', e.last_name) as name, s.amount" )
							->from('users e')
							->join('salaries s', 's.employee = e.id', 'LEFT')
							->get()
							->result();
		serve("salaries", $data);
	}

/* update salary za maemployee */
	function salary(){
		$post = $this->input->post();
		pf($post);
		$id = $post["id"];
		$amt = $post["unit_cost"];
		$count = $this->db->select('count(id) as c')->where("employee = '$id'")->get('salaries')->row('c');
		if($count){
			$this->db->where("employee = '$id'")->update("salaries",['amount'=>$amt]);
		}else{
			$data = ["employee"=>$id, "amount"=>$amt];
			$this->db->insert("salaries", $data);
		}

		redirect("salaries");
	}

	function sales(){
		$data['services'] = $this->db->get('services')->result();
		$data['clients'] = $this->db->get('customers')->result();
		$data['recent'] = $this->db->select('ch.id, s.service_name as service, s.unit_cost as cost, concat(c.first_name," ",c.last_name)as client')
							->from('charges ch')
							->join('services s', 's.id = ch.sid','LEFT')
							->join('customers c', 'c.id = ch.cid','LEFT')
							->group_by("ch.id")
							->order_by("ch.id", "desc")
							->get()
							->result()
							;
		
		serve("sales", $data);
	}


	/* save charges */

	function charge(){
		$p= $this->input->post();
		$this->db->insert("charges", $p);
		redirect("charges");
	}
	
	
	public function products(){
		$data['product_list'] = $this->db->limit(10)->order_by('date', 'DESC')->get('products')->result();
		serve("products", $data);
	}
	
	public function gallery(){
		
		serve("gallery");
	}
}
