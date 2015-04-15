<!DOCTYPE html>
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>
         $(document).ready(function(){
             $("button#getNews").click(function(){
                 getNews($("#N").val());
             });

             $("button#submitNew").click(function(){
                 submitNew($("#textToSubmit").val());
             });
         });

         function getNews(N) {
             $.post("api.php",
                    {
                        action: "getNews",
                        n: N
                    },
                    function(data,status){
                        data = JSON.parse(data);
                        $('#result').empty();
                        $('#result').append("Status: " + data['status'] + "<br>Msg: "+data["msg"]+"<br>");
                        if (data['status'] === "ok") {
                            $('#result').append("<ul id=\"resultList\"></ul>");
                            for (var i = 0; i < data['news'].length; i++) {
                                console.log(data['news'][i]);
                                $('#resultList').append("<li>" + data['news'][i] + "</li>");
                            }
                        }
                    }
             );
         }

         function submitNew(text) {
             $.post("api.php",
                    {
                        action: "addPieceOfNews",
                        text: text
                    },
                    function(data,status){
                        data = JSON.parse(data);
                        $('#result').empty();
                        $('#result').append("Status: " + data['status'] + "<br>Msg: "+data["msg"]+"<br>");

                    }
             );
         }
        </script>
    </head>
    <body>

        <div style="width:49%;height:99%;float:left;">
            N = <input type="number" id="N" value="30">
            <button id="getNews">Obtén N noticias...</button>

            <br><br><br><br><br>

            <input type="text" id="textToSubmit"><button id="submitNew">Enviar nueva noticia...</button>
        </div>
        <div style="width:49%;height:99%;border:1px solid black;float:left;" id="result">

        </div>



    </body>
</html>
