<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shroten URL</title>
            <style>
                ul{
                    list-style: none;
                    padding: 0;
                    margin: 0;
                }
                li {
                    padding: 10px;
                    border-bottom: 1px solid #e0e0e0;
                }
            </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div id="latestInput">
                
            </div>
                
            <div id="topKlik">
                
            </div>
                
            <div id="topCountry">
                
            </div>
        </div>
    </body>
    <script src="{{ asset('/js/jquery-1.11.3.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            
            var data = {
            }
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/report",
                data: data,
                crossDomain: true,
                success: function (response) {
                    if (typeof(response)=="string") {
                        response = $.parseJSON(response);
                    }
                    console.log(JSON.stringify(response));
                    
                    if(response.error_code == "0") {
                        var list = response.data.link_list;
                        var restHtml ="<ul class='list'><h1>Latest link</h1>";
                        for (var i=0;i<list.length;i++) {
                            restHtml+="<li>"+
                                        "<div><strong>Short Url = "+list[i].shorten_url+"</strong></div>"+
                                        "<div>Original Url  = "+list[i].original_url+"</div>"+
                                        "<div>hit  = "+list[i].hit+"</div>"+
                                        "<div>created date  = "+list[i].created_at+"</div>"+
                                        "</li>";
                        }
                        restHtml+="</ul>";
                        $("#latestInput").html(restHtml);
                        
                        var top = response.data.top10;
                        restHtml ="<ul class='list'><h1>Top klik link</h1>";
                        for (var i=0;i<top.length;i++) {
                            restHtml+="<li>"+
                                        "<div><strong>Short Url = "+top[i].shorten_url+"</strong></div>"+
                                        "<div>Original Url  = "+top[i].original_url+"</div>"+
                                        "<div>hit  = "+top[i].hit+"</div>"+
                                        "<div>created date  = "+top[i].created_at+"</div>"+
                                        "</li>";
                        }
                        restHtml+="</ul>";
                        $("#topKlik").html(restHtml);
                        
                        var country = response.data.topCountry;
                        restHtml ="<ul class='list'><h1>Country List</h1>";
                        for (var i=0;i<country.length;i++) {
                            restHtml+="<li>"+
                                        "<div>"+country[i].region+"</div>"+
                                        "</li>";
                        }
                        restHtml+="</ul>";
                        $("#topCountry").html(restHtml);
                    } else {
                        console.log("ERROR");
                        showAlert(response.message);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if(ajaxOptions === "timeout") {
                        showAlert("Your request reach time out, please try again later");
                    } else {
                        showAlert(xhr.responseText);
                    }
                }
            });
            
            
            $(document).on("click","#cpClip",function(e){
                e.stopPropagation();
                e.stopImmediatePropagation();
                var str = document.getElementById("cpClip");
                str.select();
                document.execCommand("copy");
                alert("Link copy to clipboard");
            });
        });
    </script>
</html>