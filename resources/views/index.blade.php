<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/static/css/index.css">
    <script type="text/javascript" src="/static/js/jquery-1.8.0.min.js"></script>
    <script>
       function test() {
           var domain=document.domain;
           var val=$("#info").val();
          $.ajax({
              url:"http://"+domain+"/send?_token={{csrf_token()}}",
              type:"POST",
              data:{"msg":val,"age":20},
              dataType:"text",
              success:function (str) {
                  alert(str);
              },
              error:function (str) {

              }
          })
       }
    </script>
</head>
<body>
<div>

        <input id="info" style="float:left;" type="text">
        <input style="float:left;" type="button" onclick="test()" value="确定">

</div>
</body>
</html>
