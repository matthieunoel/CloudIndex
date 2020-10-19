<!DOCTYPE HTML>

<!-- 
Notes :
    + Faire un système de navigation et d'affichage des sous-dossier via des paramètres passés en URL et lu par le PHP (sans param = "./")
    + Css pour le format mobile
    + Si HTML, ne pas Dl
    + Déposition de fichiers
-->

<head>
    <title>WEBQBE DRIVE</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        
        :root {
          --page-height-bonus: 0px;
        }
        
        html body {
            font-family: system-ui, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-flow: column;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh + var(--page-height-bonus));
            overflow-x: hidden;
            background-image: radial-gradient(circle at center center, transparent, rgb(240 246 250)),linear-gradient(467deg, rgba(90, 90, 90,0.05) 0%, rgba(90, 90, 90,0.05) 50%,rgba(206, 206, 206,0.05) 50%, rgba(206, 206, 206,0.05) 100%),linear-gradient(197deg, rgba(13, 13, 13,0.05) 0%, rgba(13, 13, 13,0.05) 50%,rgba(189, 189, 189,0.05) 50%, rgba(189, 189, 189,0.05) 100%),linear-gradient(302deg, rgba(249, 249, 249,0.05) 0%, rgba(249, 249, 249,0.05) 50%,rgba(111, 111, 111,0.05) 50%, rgba(111, 111, 111,0.05) 100%),linear-gradient(324deg, rgba(231, 231, 231,0.05) 0%, rgba(231, 231, 231,0.05) 50%,rgba(220, 220, 220,0.05) 50%, rgba(220, 220, 220,0.05) 100%),linear-gradient(370deg, rgba(80, 80, 80,0.05) 0%, rgba(80, 80, 80,0.05) 50%,rgba(243, 243, 243,0.05) 50%, rgba(243, 243, 243,0.05) 100%),radial-gradient(circle at center center, hsl(107,19%,100%),hsl(107,19%,100%));
        }
        
        #superTitle {
            font-size: 3em;
            position: fixed;
            right: 10vw;
            z-index: 0;
            text-align: right;
        }
        
        #new {
            z-index: 1;
            width: 350px;
            min-height: 850px;
            border-radius: 25px;
            display: flex;
            flex-flow: column;
            align-items: center;
            position: relative;
            bottom: 150px;
            box-shadow: inset -3px -5px 5px #54545499;
            padding-bottom: 25px;
            background-image: linear-gradient(45deg, rgb(51, 138, 249),rgb(47, 248, 255));
        }
        
        #new p {
            width: 80%;
            height: 25px;
            background: rgb(0, 0, 0, 0.1);
            color: white;
            border-radius: 3px;
            margin: 15px 0 0 0;
            display: flex;
            align-items: center;
            padding: 4px 10px 4px 10px;
        }
        
        #new p a {
            position: relative;
            left: 10px;
            color: white;
        }
        
        #new p a:hover {
            color: tomato;
        }
        
        #newTitle {
            height: 50px!important;
            font-size: x-large;
            font-size: bold;
            margin-top: 25px!important;
        }
        
        #background {
            position: absolute;
            width: 100%;
            height: calc(100vh + var(--page-height-bonus));
            display: flex;
            flex-flow: column;
            justify-content: center;
            align-items: center;
        }
        
        #shadow {
            background-color: rgb(0, 0, 0, 25%);
            border-radius: 20%;
            height: 150px;
            width: 450px;
            filter: blur(25px);
            z-index: -1;
            position: absolute;
            bottom: 50px;
            transform: rotateY(45deg) rotateX(-45deg) translate(10px, 0px);
        }
        
        #ground {
            width: 100%;
            height: 20%;
            z-index: -2;
            position: absolute;
            bottom: 0px;
            transform: rotate(-0.5deg);
            /*background-image: linear-gradient(-5deg, white, red);*/
            background-image: radial-gradient(circle at center center, rgb(240 246 250),rgb(246 247 248));
        }
        
    </style>
</head>

<body>
    
    <div id="superTitle">
        <h1>
            <div>WEBQBE</div>
            <div>DRIVE</div>
        </h1>
    </div>
    
    <div id="new" class="hover">
        <p id="newTitle">./</p>
    </div>
    
    <div id="background">
        <div id="shadow"></div>
        <div id="ground"></div>
    </div>
    
    
<script>

    var scanDir = JSON.parse(<?php
        $path = "./";
        $scanDir = scanDir($path);
        foreach ($scanDir as &$value) {
            $value = $path.$value;
            if(is_dir($value)) {
                $value = $value."/";
            }
        }
        echo("'".json_encode($scanDir)."'")
    ?>);
    
    // console.log('scanDir', scanDir)
    
    var FilesList = [];
    for (let i = 0; i < scanDir.length; i++) {
      if(!scanDir[i].endsWith('./') && !scanDir[i].endsWith('../') && !scanDir[i].endsWith('/index.php')) {
          FilesList.push(scanDir[i])
      }
    }
    
    // console.log('FilesList', FilesList);
    
    if(FilesList.length > 15) {
        document.documentElement.style.setProperty('--page-height-bonus', (FilesList.length - 15) * 44 + 'px');
    }
    
    for (let i = 0; i < FilesList.length; i++) {
        var File = FilesList[i];
        
        var a = document.createElement("a");
        var p = document.createElement("p");
        
        a.href = File;
        if(!File.endsWith('/')) {
            a.download = "";
        }
        
        a.appendChild(document.createTextNode(File));
        
        p.appendChild(a);
        document.getElementById("new").appendChild(p);
    }
    
</script>
<script>
    
    x = 0;
    y = Math.sin(x);
    speed = 0.02;
    height = 15;
    
    $(document).ready(function () {
        setInterval('breath()', 20);
    });

    function breath() {
        if(y >= 360) {
            y = 0;
        }
        x = x + speed;
        y = Math.sin(x);
        // console.log("Sin(" + x + ") =", y);
            $(".hover").css("bottom", (y * height + 150) + "px");
    }
    
</script>
<script>

        window.addEventListener('scroll', function(e) {

            const target = document.querySelectorAll('.scroll');

            var index = 0;
            for  (index; index < target.length; index++) {

                var posY = window.pageYOffset * target[index].dataset.ratey;
                var posX = window.pageYOffset * target[index].dataset.ratex;

                target[index].style.transform = 'translate3d(' + posX + 'px, ' + posY + 'px, 0px)';
            }
        });

    </script>
</body>

