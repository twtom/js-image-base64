// 基于 laravel框架 php服务端保存
public function upload(Request $request)
{
    if ($request->data) {
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $request->data, $result)){
            $type = $result[2];
            $path = public_path() . '/files/avatar/; // 保存目录
            if(!file_exists($new_file)) {
                mkdir($path, 0700); // 判断目录文件是否存在，不存在创建目录，权限 700
            }

            $filename = md5(date('Y-m-dH:i:s').uniqid()); // 生成唯一文件名            
            
            // 将图片存到制定目录
            if (file_put_contents($path.$filename, base64_decode(str_replace($result[1], '', $request->data)))){
                return response()->json(['msg' => '保存成功']);
            }else{
                return response()->json(['err' => '保存失败']);
            }
        }
    }
}
