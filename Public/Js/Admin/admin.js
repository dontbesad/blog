//左侧列表
var list_titles = document.getElementsByClassName("list-title");
for (var i = 0; i < list_titles.length; ++i) {
    list_titles[i].show = false;
    list_titles[i].onclick = function() {
        if (this.show === false) {
            this.show = true;
            this.parentNode.getElementsByClassName("bar-list")[0].style.display = "block";
            var span_icon = this.getElementsByTagName("span")[0];
            span_icon.style.transform = "rotate(0deg)";
            span_icon.style.top = "13px";
            span_icon.style.right = "5px";
        } else {
            this.show = false;
            this.parentNode.getElementsByClassName("bar-list")[0].style.display = "none";
            var span_icon = this.getElementsByTagName("span")[0];
            span_icon.style.transform = "rotate(90deg)";
            span_icon.style.right = "10px";
            span_icon.style.top = "5px";
        }
    }
}

var ifm = document.getElementById("myiframe");
ifm.height = document.documentElement.clientHeight - 55; //设置iframe高度
