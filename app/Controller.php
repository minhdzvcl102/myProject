<?php

namespace App;

class Controller
{

    
    public function validate($validator, $data, $rules)
    {
        $validation = $validator->make($data, $rules);

        // then validate
        $validation->validate();

        if ($validation->fails()) {
            return $validation->errors()->firstOfAll();
        }

        return [];
    }
    

    public function logError($message)
    {
        $date = date('d-m-Y');
        // Type : 3 - Ghi vào file 
        error_log($message, 3, "storage/logs/$date.log");
    }

    public function uploadFile(array $file, $folder = null)
    {
        //Thông tin về file 
        $fileTmpPath = $file['tmp_name']; //Đường dẫn tạm thời
        $fileName = Time() . '-' . $file['name']; //Tên file chống trùng tên file bằng timeStamp

        $uploadDir = 'storage/uploads/' . $folder . '/'; //Thư mục lưu file

        // Tạo thư mục nếu chưa tồn tại
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Đường dẫn đầy đủ để lưu file 
        $destFile = $uploadDir . $fileName;
        if (move_uploaded_file($fileTmpPath, $destFile))  // Di chuyển file từ thư mục tạm thời đến thư mục đích 
        {
            return  $destFile;
        }
        throw new \Exception('Upload file thất bại');
    }
}
