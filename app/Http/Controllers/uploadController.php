<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\article;
require'function.php';//加载功能


class uploadController extends Controller
{

    //检查表单数据
    public function checkForm($request){
      $this->validate($request, [
         'title' => 'required|max:15',
         'keyword' => 'required|max:15',
         'copy'=>'required',
         'kind'=>'required',
     ]);
    }

    public function insert(Request $request){

      $this->checkForm($request);        //检查表单数据
      //dd($request);

      $file = $request->file('files');
      if ($file==NULL) {
          _alert_back("上传文件不能为空！");
      }
      $type= $file ->getClientMimeType();//
      $ruletype_docx_office="application/vnd.openxmlformats-officedocument.wordprocessingml.document";//office格式
      $ruletype_doc='application/octet-stream';//wps格式
      $ruletype_pdf='application/pdf';//pdf格式

    if($type!=$ruletype_pdf&&$type!=$ruletype_doc&&$type!= $ruletype_docx_office){
      $file_error="上传文件格式错误，只能上传docx，pdf文档文件！";
      _alert_back($file_error);     //弹窗函数定义在function.php中
    }
      if($request->isMethod('POST')){   //判断是否有post请求

        $file = $request->file('files');  //接收文件
        //var_dump($_FILES);
          if($file->isValid()){          //判断文件对象是否被创建
              $oldname = $file -> getClientOriginalExtension();  //获取原文件名
              $filename=date('Ymd--His--').rand(1000,9999).'.'.$oldname; //扩展文件名

             	$bool=Storage::disk('tvupload')->putFileAS('files',$file,$filename);    //上传到public/tvupload/files目录下
              //返回bool值
              if($bool){

                $url='public/tvupload/files/'.$filename;
             saveUpload($url,$request);   // 存入数据库 表单不完整 打开注释会出错 等表单完善后可用
                $uploadSuccess = '上传成功，请到'.$url.'下查看！';
                _alert_back($uploadSuccess);

              }else
              $uploadFail =  '上传失败！';
                _alert_back($uploadFail);
            }else
              $upload_error = '非法操作!';
                _alert_back($upload_error);
        }
    }
}
