<?php
include 'config.php';

// 連接資料庫
$link = db_open();


$sqlstr = "SELECT * FROM person ";

$result = mysqli_query($link, $sqlstr);

$total_rec = mysqli_num_rows($result);

$data = '';
while($row=mysqli_fetch_array($result))
{
   $uid      = $row['uid'];
   $usercode = $row['usercode'];
   $username = $row['username'];
   $address  = $row['address'];
   $birthday = $row['birthday'];
   $height   = $row['height'];
   $weight   = $row['weight'];
   $remark   = $row['remark'];
   
   $data .= '<tr>';
   $data .= '  <td>' . $uid      . '</td>';
   $data .= '  <td>' . $usercode . '</td>';
   $data .= '  <td>' . $username . '</td>';
   $data .= '  <td>' . $address  . '</td>';
   $data .= '  <td>' . date('Y-m-d', strtotime($birthday)) . '</td>';
   $data .= '  <td>' . $height   . '</td>';
   $data .= '  <td>' . $weight   . '</td>';
   $data .= '  <td>' . $remark   . '</td>';
   $data .= '  <td><a href="display.php?uid=' . $uid . '">詳細</a></Ttd>';
   $data .= '  <td><a href="edit.php?uid=' . $uid . '">修改</a></td>';
   $data .= '  <td><a href="delete.php?uid=' . $uid . '" onClick="return confirm(' . "'" . '確定要刪除嗎？' . "'" . ');">刪除</a></td>';
   $data .= '</tr>';
}

db_close($link);



$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>基本資料庫系統</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<p><a href="index.php">回首頁</a></p>
<h2 align="center" align="center">共有 {$total_rec} 筆記錄</h2>
<table border="1" align="center">
   <tr>
      <th>序號</th>
      <th>代碼</th>
      <th>姓名</th>
      <th>地址</th>
      <th>生日</th>
      <th>身高</th>
      <th>體重</th>
      <th>備註</th>
      <td colspan="3" align="center">操作 [<a href="add.php">新增記錄</a>]</td>
   </tr>
{$data}
</table>

</body>
</html>
HEREDOC;

echo $html;
?>