<?php 
	class tag{
		public $db;
		public function __construct(){
			$this->db= new medoo([
    				'database_type' => 'mysql',
 				    'database_name' => 'tag',
 				    'server' => 'localhost',
 			        'username' => 'root',
  				    'password' => '',
			        'charset' => 'utf8',
   			 		'port' => 3306,
    				'prefix' => 'info_',
			]);
		}
		public function add_one($name){
			if($this->jugg($name)){
				$count=$this->count($name);
				$update['count']=$count+1;
				$update['name']=$name;
				$where['name']=$name;
				$this->db->update('tag',$update,$where);
			}else{
				$this->create_one($name);
			}

		}
		protected function jugg($name){
			$where['name']=$name;
			return $this->db->has('tag',$where);
		}
		protected function create_one($name){
			$add['name']=$name;
			$add['count']=1;
			$this->db->insert('tag',$add);
		}
		protected function count($name){
			$where['name']=$name;
			$cn=$this->db->select('tag','*',$where);
			return $cn[0]['count'];
		}
		public function all(){
			$where['id[>]']=0;
			$where['ORDER']='count';
		 	$info=$this->db->select('tag',"*",$where);
		 	$this->json($info);
		}
		protected function json($info){
			header('Content-type:text/json');
			echo json_encode($info);
		}
	}