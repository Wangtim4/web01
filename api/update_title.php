<?php
include_once "../base.php";
// print_r($_FILES['img']['tmp_name']);

if (is_uploaded_file($_FILES['img']['tmp_name'])) {
    $img = $_FILES["img"];
    //獲取數組裡面的值
    $name = $img["name"]; //上傳文件的文件名
    $type = $img["type"]; //上傳文件的類型
    $size = $img["size"]; //上傳文件的大小
    $tmp_name = $img["tmp_name"]; //上傳文件的臨時存放路徑

    //判斷是否為圖片
    switch ($type) {
        case 'image/pjpeg':
            $okType = true;
            break;
        case 'image/jpeg':
            $okType = true;
            break;
        case 'image/gif':
            $okType = true;
            break;
        case 'image/png':
            $okType = true;
            break;
    }

    if ($okType) {
        /**
         * 0:文件上傳成功<br/>
         * 1：超過了文件大小，在php.ini文件中設置<br/>
         * 2：超過了文件的大小MAX_FILE_SIZE選項指定的值<br/>
         * upload_max_filesize=1M
         * 
         * 3：文件只有部分被上傳<br/>
         * 4：沒有文件被上傳<br/>
         * 5：上傳文件大小為0
         * 
         */
        
        
        $error = $img["error"]; //上傳後系統返回的值
        echo "================<br/>";
        echo "上傳文件名稱是：" . $name . "<br/>";
        echo "上傳文件類型是：" . $type . "<br/>";
        echo "上傳文件大小是：" . $size . "<br/>";
        echo "上傳後系統返回的值是：" . $error . "<br/>";
        echo "上傳文件的臨時存放路徑是：" . $tmp_name . "<br/>";

        echo "開始移動上傳文件<br/>";

        //把上傳的臨時文件移動到upload目錄下面(upload是在根目錄下已經創建好的！！！)
        move_uploaded_file($tmp_name, '../img/' . $name);
        $destination = '../img/' . $name;
        echo "================<br/>";
        echo "上傳信息：<br/>";
        if ($error == 0) {
            echo "文件上傳成功啦！";
            echo "<br>圖片預覽:<br>";
            echo "<img src=" . $destination . ">";
            //echo " alt=\"圖片預覽:\r文件名:".$destination."\r上傳時間:\">";
        } elseif ($error == 1) {
            echo "超過了文件大小，在php.ini文件中設置";
        } elseif ($error == 2) {
            echo "超過了文件的大小MAX_FILE_SIZE選項指定的值";
        } elseif ($error == 3) {
            echo "文件只有部分被上傳";
        } elseif ($error == 4) {
            echo "沒有文件被上傳";
        } else {
            echo "上傳文件大小為0";
        }
    } else {
        echo "請上傳jpg,gif,png等格式的圖片！";
    }

    $img = $_FILES['img']['name'];
}

    // if(isset($_FILES['img']['tmp_name'])){
    //     move_uploaded_file($_FILES['img']['tmp_name'],'../img/'.$_FILES['img']['name']);

    //     $img = $_FILES['img']['name'];
    // }

    $id=$_POST['id'];
    $row=$Title->find($id);
    $row['img']=$img;
    
    $Title->save($row);

    to("../back.php?do=title");
    ?>
