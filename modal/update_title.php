<h3 style="text-align: center;">更新網站標題圖片</h3>
<hr>
<form action="./api/update_title.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>標題區圖片</td>
            <td>
                <input type="file" name="img" id="">
            </td>
        </tr>
    </table>
    <div>
        <input type="submit" value="更新">
        <input type="hidden" name="MAX_FILE_SIZE">
        <input type="hidden" name="id" value="<?=$_GET['id'];?>">
        <input type="reset" value="重置">
    </div>
</form>