<?php 


	
	//无极分类查询
	    function category(&$arr,$pid=0,$level=1){
	        $category=M("category");
	        $where['pid']=$pid;
	        $list=$category->where($where)->select();
	        foreach ($list as $v) {
	            $v['level']=$level;
	            $arr[]=$v;
	            category($arr,$v['cat_id'],$level+1);
	        }
	    }

	//另外一种无极分类查询其子类ID
	 function get_child_id($arr,$pid=0,$level=1){
	       
	        $res=array();
	        
	        foreach ($arr as $v) {
	           if($v['pid']==$pid){
	           		$v['level']=$level;
	           		$res[]=$v;
	           		$res=array_merge($res,get_child_id($arr,$v['cat_id'],$level+1));
	           }
	        }

	        return $res;
	    }

	

	  //通过pid查父级查栏目 
	    function getNameBytypeCatId($pid){
	    	
	    	if($pid>0){
	    		$db=M('category');
	    		$list=$db->find($pid);
	    		return $list['cat_name'];
	    	}else{
	    		return "顶级栏目";
	    	}


	    }

	   //通过type_id查询所在的类型
	   function getNameBytypeId($type_id){
		   	if($type_id>0){
		    		$db=M('type');
		    		$list=$db->find($type_id);
		    		return $list['type_name'];
		    	}else{
		    		return "所有分类";
		    	}
	   }

	   function getNameByCatId($cat_id){
		   	if($cat_id>0){
		    		$db=M('category');
		    		$list=$db->find($cat_id);
		    		return $list['cat_name'];
		    	}else{
		    		return "所有分类";
		    	}
	   }


	   //查询出所有的子类 递归调用 但是这个方法好像不怎么好用
	   function getAllChild($id){
	   		$db=M('category');
	   		$where['pid']=$id;
	   		$list=$db->where($where)->select();
	   		foreach ($list as $v) {
	   			getAllChild($v['id']);
	   		}
	   		return $list;
	   }



	   //有一个方法是我没有写的 就是那个返回那个父级什么的  那个没有用面向对象写
	  	//查询一个它父级的方法  
	   // 1.表名
	   // 2.传入的被检索字段
	   // 3.抛出的时候它的检索字段名称

	   //通过pid查父级查栏目 
	   /*
		传入的表名   传入的条件值  传入需要查找的字段
	   */
	    function getNameBytypePid($table,$pid,$field){



	    	
	    	$db=M($table);
	    	$list = $db->where($pid)->getField($field);

	    	if($table=="category"){
	    			if($pid>0){
	    				return $list;
	    			}else{
	    				return "顶级栏目";
	    			}
	    	}else if($table=="type"){
	    			if($pid>0){
	    				return $list;
	    			}else{
	    				return "所有分类";
	    			}

	    	}


	    	return $list;

	    }


	   //查询子类


	   

?>