<?php
include('lib/Settings.php');
$title = '';
$link = '';
$description = '';
if (isset($_POST['save'])) {
    extract($_POST);
    if (isset($_REQUEST['id'])) {
        $sql = 'UPDATE demos SET title = "' . $title . '", link = "' . $link . '", description = "' . $description . '" WHERE id = "'.$_REQUEST['id'].'" ';
    } else {
        $sql = 'INSERT INTO demos SET title = "' . $title . '", link = "' . $link . '", description = "' . $description . '" ';
    }
    mysql_query($sql);

    header('Location:index.php');
}
if (isset($_REQUEST['id'])) {
    $query = "SELECT * FROM demos WHERE id = '" . $_REQUEST['id'] . "' ";
    $result = getResult($query);
    $title = $result[0]['title'];
    $link = $result[0]['link'];
    $description = $result[0]['description'];
}
?>
<form method="post" action="">
    <table>
        <tr>
            <td>Title</td>
            <td><input type="text" name="title" value="<?php echo($title); ?>"></td>
        </tr>        
        <tr>
            <td>link</td>
            <td><input type="text" name="link" value="<?php echo($link); ?>"></td>
        </tr>        
        <tr>
            <td>Description</td>
            <td><textarea name="description"><?php echo($description); ?></textarea></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="save" value="Save"></td>
        </tr>
    </table>
</form>