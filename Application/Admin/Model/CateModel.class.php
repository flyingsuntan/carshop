<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/21
 * Time: 15:45
 */
namespace Admin\Model;
use Think\Model;

class CateModel extends Model{
    protected $_validate = array(
        array('name','require','栏目名称不得为空！',1),  // 都有时间都验证
        array('name','','栏目名称不得重复！',1,'unique',3),
    );
    public function cate_tree(){
        $data = $this->select();
        return $this->_tree($data);

    }
    /*******************树形结构****************/
    protected function _tree($data,$pid =0,$level=0){
        static $tree = array();
        foreach ($data as $k => $v){
            if($v['parentid'] == $pid){
                $v['level'] = $level;
                $tree[] = $v;
                $this->_tree($data,$v['id'],$level+1);
            }
        }
        return $tree;
    }
}