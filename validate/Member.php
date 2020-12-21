<?php
namespace app\api\validate;

use think\Validate;

class Member extends Validate
{
    protected $rule=[
        'name|用户名'=>'require|unique:member',
        'email|邮箱'=>'require|email|unique:member',
        'phone|手机号'=>'regex:1[35789]\d{9}|unique:member',
        'id|会员ID'=>'require|gt:0|integer'
    ];
}