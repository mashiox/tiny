$(document).ready(function(){
    $("input#submitInput").click(function(){
        var uri = $("input#URInput").val();
        $("div#newURI").hide();
        $("div#loading").show();
        if ( !isEmpty(uri) && isURIMatch(uri) ){
            var data = {
                URI : uri
            }
            $.ajax({
                type:   "post",
                cache:  false,
                url:    window.location.origin + "/make.php",
                data:   data,
            })
            .done(function(m){
                var back = JSON.parse(m);
                try{
                    $("div#loading").hide();
                    if (back.status > 0){
                        $("div#outputURI p#longURI").text(back.uri);
                        $("div#outputURI p#shortURI").text(back.tiny);
                        $("div#outputURI").show();
                    }
                    else {
                        $("div#errorConsole p#status").text(back.status);
                        $("div#errorConsole p#error").text(back.error);
                        $("div#errorConsole").show();
                    }
                }
                catch(err){
                    alert("Don't know what you're doing.");
                }
            });
        }
        return;
    });
    $("div#outputURI input#enterNew").click(function(){
        $("div#outputURI").hide();
        $("div#outputURI p#longURI").text("");
        $("div#outputURI p#shortURI").text("");
        $("div#newURI input#URInput").val("");
        $("div#newURI").show();
    });
});
var isURIMatch = function(str){
    var rx = new RegExp(/[ftp|https?:]+\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[A-Za-z]{2,4}\b([-a-zA-Z0-9@:%_\+.~#;?&//=]*)/);
    return str.match(rx) ? true : false;
}
var isEmpty = function(str){
    return ( str.length === 0 ? true : false )
}