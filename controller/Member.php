<?php

namespace app\api\controller;

use think\Controller;
use think\Loader;
use think\Request;

class Member extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //接收数据
        $keyword=input('keyword');
        //设置条件数组
        $where=[];
        //判断搜索条件是否为空
        if (!empty($keyword)){
            //用户名与手机号皆可查询
            $where['name|phone']=['like',"%$keyword%"];
        }
        //查询数据
        $info=model('Member')->where($where)->select();
        return json(['code'=>200,'msg'=>'查询成功','data'=>$info]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //接收数据
        $param=$request->param();
        //验证数据
        $validate=validate('Member');
        if (!$validate->check($param)){
            return json(['code'=>500,'msg'=>$validate->getError(),'data'=>[]]);
        }
        //入库保存
        $res=model('Member')::create($param,true);
        return json(['code'=>200,'msg'=>'添加成功','data'=>$res]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //接收数据
        $param=$request->param();
        //验证数据
        $validate=validate('Member');
        if (!$validate->check($param)){
            return json(['code'=>500,'msg'=>$validate->getError(),'data'=>[]]);
        }
        //更新数据
        $res=model('Member')::update($param,['id'=>$id],true);
        return json(['code'=>200,'msg'=>'修改成功','data'=>$res]);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //验证参数
        if (!is_numeric($id)||$id<=0){
            return json(['code'=>500,'msg'=>'参数格式错误','data'=>[]]);
        }
        //删除数据
        model('Member')::destroy($id);
        return json(['code'=>200,'msg'=>'删除成功','data'=>[]]);
    }
}
