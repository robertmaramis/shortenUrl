<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Shroten URL</title>
            <style>
                #shortForm{
                    text-align: center;
                }
                
                #shortForm input {
                    border: none;
                    width: 100%;
                    text-align: center;
                }
                #url {
                    border-bottom: 1px solid #e0e0e0;
                    padding: 10px 0px;
                }
                #shorthenBtn {
                    width: 50%;
                    margin: 10px auto;
                    padding: 10px;
                    border: 1px solid #e0e0e0;
                    border-radius: 8px;
                    cursor: pointer;
                }
                #cpClip {
                    font-size: 1.4em;
                    padding: 10px;
                }
            </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div id="shortForm">
                <input type="url" id="url" name="url" placeholder="http://example.com/..."/>
                <div id="shorthenBtn">make it short</div>
                <div id="result">
                    
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('/js/jquery-1.11.3.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on("click","#shorthenBtn",function(e){
                e.stopPropagation();
                e.stopImmediatePropagation();
                
                var url = $("#url").val();
                if (url=="") {
                    alert("Please fill URL");
                    return false;
                }
                var data = {
                    url: url
                }
                $.ajax({
                    type: "POST",
                    url: "http://127.0.0.1:8000/api/shorten",
                    data: data,
                    crossDomain: true,
                    success: function (response) {
                        if (typeof(response)=="string") {
                            response = $.parseJSON(response);
                        }
                        console.log(JSON.stringify(response));
                        
                        if(response.error_code == "0") {
                            var html="Your Link successfully shorten"+
                                    //"<div id='resultLink'>"+response.data.result+"</div>"+
                                    "<input type='text' id='cpClip' value='"+response.data.result+"'/>"+
                                    "<span class='legend'>click link to copy to clipboard</span>";
                            $("#result").html(html);
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