<?php
include('lib/Settings.php');
include('lib/CacheMemcache.php');

$query = "SELECT * FROM demos";
$result = '';

if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action']; 
    if($action == 'delete' && isset($_REQUEST['id'])){
        $id = (int)$_REQUEST['id'];
        $sql = 'DELETE FROM demos WHERE id = "'.$id.'" ';
        mysql_query($sql);
        header('Location:index.php');
    }
    if($action == 'clearCache'){
        $cache = new CacheMemcache('localhost', 11211, IS_CACHE_ENABLED);
        $cacheKey = md5($query);
        $cache->delData($cacheKey);
        header('Location:index.php');
    }
}

if (IS_CACHE_ENABLED) {
    $cache = new CacheMemcache('localhost', 11211, IS_CACHE_ENABLED);
    $cacheKey = md5($query);
    $result = $cache->getData($cacheKey);
    if (empty($result)) {
        $result = getResult($query);
        $cache->setData($cacheKey, $result);
    }
} else {
    $result = getResult($query);
}


?>
<a href="add-edit.php">Add New</a>&nbsp;|&nbsp;
<a href="?action=clearCache">Clear Cache</a>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
        <td>ID</td>
        <td>Title</td>
        <td>Description</td>
        <td>Link</td>
        <td>&nbsp;</td>
    </tr>
    <?php
    if ($result) {
        foreach ($result as $res) {
            ?>
            <tr>
                <td><?php echo($res['id']) ?></td>
                <td><?php echo($res['title']) ?></td>
                <td><?php echo($res['description']) ?></td>
                <td><?php echo($res['link']) ?></td>
                <td>
                    <a href="add-edit.php?id=<?php echo($res['id']) ?>">Edit</a>&nbsp;|&nbsp;
                    <a href="?action=delete&id=<?php echo($res['id']) ?>">Delete</a>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</table>