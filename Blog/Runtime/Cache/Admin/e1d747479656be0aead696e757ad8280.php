<?php if (!defined('THINK_PATH')) exit();?><table border="3px" style="margin:0 auto; background-color: #fff;" cellspacing="0">
    <caption><h2>服务器信息</h2></caption>
    <tr>
        <td>服务器IP</td>
        <td><?php echo $_SERVER['HTTP_HOST']; ?></td>
    </tr>
    <tr>
        <td>服务器软件</td>
        <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
    </tr>
    <tr>
        <td>PHP版本</td>
        <td><?php echo phpversion(); ?></td>
    </tr>
    <tr>
        <td>你的IP</td>
        <td><?php echo $_SERVER['REMOTE_ADDR']; ?></td>
    </tr>
    <tr>
        <td>你的浏览器</td>
        <td><?php echo $_SERVER['HTTP_USER_AGENT']; ?></td>
    </tr>
</table>