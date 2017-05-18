function ajaxPost(url,data,msgid) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(data);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 304)) {
            var response = JSON.parse(xhr.responseText);
            if (response.flag) { //成功的话,刷新当前页面
                alert(response.message);
                window.location.reload();
            } else {
                console.log(response.message);
                document.getElementById(msgid).innerHTML = response.message;
            }
        }
    }
}
function ajaxAddCate() {
    var cate_name = document.getElementById("cate_name").value;
    var data = "cate_name=" + cate_name;
    ajaxPost("/blog/index.php/Admin/Article/addCate", data, "message");
}
function ajaxDelCate(cateid) {
    if (!confirm("有些文章可能会归到未分类,确定要删除吗？")) {
        return ;
    }
    console.log("asdasd");
    var data = "cate_id=" + cateid;
    ajaxPost("/blog/index.php/Admin/Article/delCate", data, "message");
}
function ajaxUpdateCate(cateid) {
    var cate_name = prompt("请输入需要修改的分类名", '');
    if (cate_name) {
        //修改操作
        var data = "cate_id=" + cateid + "&cate_name=" + cate_name;
        ajaxPost("/blog/index.php/Admin/Article/updateCate", data, "message");
    }
}
