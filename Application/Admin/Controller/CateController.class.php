<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Common;
class CateController extends Controller {
    public function lst(){
        $cateModel = D('cate');
        $data = $cateModel->select();
        $this->assign(array(
            'data'=>$data,
            ));
    	$this->display();
    }
    public function add(){
        if(IS_POST){
            $cateModel = D('cate');
            if($cateModel->create()) {
                $data = I('post.');
                if ($_FILES['pic']['tmp_name'] != '') {
                    $upload = new \Think\Upload();// 实例化上传类
                    $upload->maxSize = 3145728;// 设置附件上传大小
                    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->rootPath = './Public/Uploads/'; // 设置附件上传根目录
                    $upload->savePath = ''; // 设置附件上传（子）目录
                    // 上传文件
                    $info = $upload->upload();
                    if (!$info) {// 上传错误提示错误信息
                        $this->error($upload->getError());
                    } else {// 上传成功
                        $data['pic'] = $info['pic']['savepath'] . $info['pic']['savename'];
                    }
                }
                if($cateModel->add($data)){
                    $this->success('添加栏目成功',U('lst'));
                }else{
                    $this->error('添加栏目失败');
                }
            }else{
                $this->error($cateModel->getError());
            }

exit();
        }
        $this->display();
    }
    public function edit(){
        $this->display();
    }
}