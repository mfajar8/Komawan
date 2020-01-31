<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class admin_model extends CI_Model
    {
        public $table = 'admin';
        public $id = 'id_user';
        public $order = array('id_user' => 'asc');
        public $select='nama_user, NIP';

        function __construct()
        {
            parent::__construct();
            $this->column_order=[];
            $this->column_search=[];
            $this->column_order[]=null;
							$this->column_order[]='username';
							$this->column_order[]='password';
							$this->column_order[]='nama_user';
							$this->column_order[]='NIP';
							$this->column_search[]='username';
							$this->column_search[]='password';
							$this->column_search[]='nama_user';
							$this->column_search[]='NIP';

        }

        // get all
        function get_all()
        {
            $this->db->order_by($this->id, 'DESC');
            return $this->db->get($this->table)->result();
        }

        function getDataTable(){
            $this->db->select($this->select);
            $this->db->order_by($this->id, 'DESC');
            return $this->db->get($this->table)->result();
        }

        //get field

        function get_field(){
          $table=$this->table;
          $this->db->select($this->select); //ganti * untuk custom field yang ditampilkan pada table
          $sql=$this->db->get($this->table); //ganti * untuk custom field yang ditampilkan pada table
          return $sql->list_fields();
        }

        // get data by id
        function get_by_id($id)
        {
            $this->db->where($this->id, $id);
            return $this->db->get($this->table)->row();
        }

        // insert data
        function insert($data)
        {
            $this->db->insert($this->table, $data);
        }

        // update data
        function update($id, $data)
        {
            $this->db->where($this->id, $id);
            $this->db->update($this->table, $data);
        }

        // delete data
        function delete($id)
        {
            $this->db->where($this->id, $id);
            $this->db->delete($this->table);
        }

        //Datatable
        private function _get_datatables_query()
          {
              $this->db->select($this->select);
              $this->db->from($this->table);

              $i = 0;

              foreach ($this->column_search as $item) // loop column
              {
                  if($_POST['search']['value']) // if datatable send POST for search
                  {

                      if($i===0) // first loop
                      {
                          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                          $this->db->like($item, $_POST['search']['value']);
                      }
                      else
                      {
                          $this->db->or_like($item, $_POST['search']['value']);
                      }

                      if(count($this->column_search) - 1 == $i) //last loop
                          $this->db->group_end(); //close bracket
                  }
                  $i++;
              }

              if(isset($_POST['order'])) // here order processing
              {
                  $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
              }
              else if(isset($this->order))
              {
                  $order = $this->order;
                  $this->db->order_by(key($order), $order[key($order)]);
              }
          }
        function get_datatables()
        {
            $this->_get_datatables_query();
            if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered()
        {
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all()
        {
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }

    }

    /* Crudlab by Kostlab */
    /* Please DO NOT modify this information : */
    /* Learn and Earn */
