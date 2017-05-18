function returnTop() {
    var btn = document.getElementById("return_top_btn");
    var client_height = document.documentElement.clientHeight;
    client_height = 50;
    btn.onclick = function() {
        returnScroll();
    }
    if (getScrollTop() <= client_height) {
        btn.style.display = "none";
    }
    window.onscroll = function() {
        if (getScrollTop() <= client_height) {
            btn.style.display = "none";
        } else {
            btn.style.display= "block";
        }
    }

    function getScrollTop() {
        return document.documentElement.scrollTop || document.body.scrollTop;
    }
    function setScrollTop(length) {
        document.documentElement.scrollTop = document.body.scrollTop = length;
    }
    function returnScroll() {
        if (btn.clock) {
            clearInterval(btn.clock);
        }
        btn.clock = setInterval(function(){
            var length = getScrollTop();
            if (length > 0) {
                setScrollTop(getScrollTop() - Math.ceil(length / 10));
            } else if (!length) {
                clearInterval(btn.clock);
            }
        },10);
    }
}
returnTop();
