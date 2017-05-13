
<html>
    <head>
   <title>รายงาน</title>
   <style type="text/css">
      .mypg {width: 672px; height: 800px;
         margin: 2px auto 2px auto;
         background: rgb(224,216,192);
         padding: 24px;}
   </style>

</head>
    <body style='background:white;'>
        <div class='ZhCallListPrintView'>
            
            <div class="zPrintMsgs">
                <?= $content ?>


            </div>
        </div>
        <style type="text/css">
            .ZhCallListPrintView td, .zPrintMsgs :not(font){
                font-family: Tahoma,Arial,Helvetica,sans-serif;
                font-size: 12pt;
            }
            .ZhPrintSubject {
                padding: 10px;
                font-weight: bold;
            }
        </style>
        <script type="text/javascript">
            <!--
                // setTimeout('window.print()', 1000);
-->
        </script>
    </body>
</html>