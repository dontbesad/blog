
    var editor = new UE.ui.Editor({initialFrameHeight:400,initialFrameWidth:null }); //宽度自适应 高度一定
    editor.render("editor");
    function ajaxPost(url,data,is_post_art) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        //console.log("~~~~" + data.length);
        xhr.send(data);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 304)) {
                var response = JSON.parse(xhr.responseText);
                if (is_post_art && response.flag) {
                    alert(response.message);
                    location.reload();
                } else if (is_post_art && !response.flag) {
                    document.getElementById("message_art").innerHTML = response.message;
                } else {
                    //添加标签
                    if (response.flag) {
                        var tag_list = document.getElementById("tag_list");
                        var tag_label = document.createElement("label");
                        tag_label.setAttribute("for", "tag" + response.tag.tag_id);
                        tag_label.innerHTML = response.tag.tag_name;
                        var tag_input = document.createElement("input");
                        tag_input.setAttribute("type","checkbox");
                        tag_input.setAttribute("class","checkbox-tag");
                        tag_input.setAttribute("id", "tag" + response.tag.tag_id);
                        tag_input.setAttribute("name", response.tag.tag_id);
                        tag_list.appendChild(tag_label);
                        tag_list.appendChild(tag_input);
                    }
                    document.getElementById("message_tag").innerHTML = response.message;
                }
            }
        }
    }
    //添加修改文章  //这里处理tag cate
    function editArt(opt,art_id=0) {
        var title = document.getElementById('title').value;
        var content = editor.getContent();

        var cates = document.getElementsByClassName("checkbox-cate");
        var cate_arr = new Array();
        for (var i = 0; i < cates.length; ++i) {
            if (cates[i].checked) {
                cate_arr.push(cates[i].name);
            }
        }
        var tags = document.getElementsByClassName("checkbox-tag");
        var tag_arr = new Array();
        for (var i = 0; i < tags.length; ++i) {
            if (tags[i].checked) {
                tag_arr.push(tags[i].name);
            }
        }
        content = encodeURIComponent(content);
        var data = "title=" + title + "&content=" + content + "&cates=" + JSON.stringify(cate_arr) + "&tags=" + JSON.stringify(tag_arr);
        if (opt == 'update') {
            data = data + "&art_id=" + art_id;
            console.log(data);
            ajaxPost("/blog/index.php/Admin/Article/updateArt", data, true);
        } else {
            ajaxPost("/blog/index.php/Admin/Article/addArt", data, true);
        }
    }
    //增加标签
    document.getElementById("add_tag").onclick = function() {
        var tag = document.getElementById("tag_name").value;
        tag = encodeURIComponent(tag);
        console.log(tag);
        var data = "tag_name=" + tag;
        ajaxPost("/blog/index.php/Admin/Article/addTag", data, false);
    }

    window.onbeforeunload = function() {

    }
