<?php
//--自定义函数--
/**
 * 检验验证码是否正确
 * @access public
 * @param  string $verify_code 验证码
 * @return boolean
 */
function checkVerify($verify_code, $id='') {
    $verify = new \Think\Verify();
    return $verify->check($verify_code, $id);
}
