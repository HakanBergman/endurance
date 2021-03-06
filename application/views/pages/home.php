<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>{'title'|Domains}</title>
        <link rel="shortcut icon" href="/img/favicon.png" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="initial-scale=1">
        <style type="text/css">

            html {
                min-height: 100%;
            }

            body {
                min-height: 100%;
                background: #226699;
                background: -moz-radial-gradient(center top, circle, #226699 0px, #003366 500px);
                background: -webkit-gradient(radial, center top, 0, center top, 500, from(#226699), to(#003366));
                font-family: 'Ubuntu', sans-serif;
                width: 700px;
                margin: 0px auto;
                color: white;
            }

            h1, h2, h3, h4, h5, h6 {
                font-weight: normal;
            }

            h1 {
                margin-top: 48px;
                margin-bottom: 4px;
            }

            h2, a {
                color: #66ccff;
            }

            .line {
                overflow: auto;
                margin-bottom: 64px;
            }

            .line tt {
                display: block;
                float: left;
                background-color: #f7931e;
                width: 64px;
                height: 12px;
                margin: 4px;
            }

            .half {
                overflow: auto;
                width: 50%;
                float: left;
            }

            .footer {
                margin-top: 96px;
                float: left;
                width: 100%;
                text-align: center;
                font-size: 8pt;
            }

            input {
                margin-left: 24px;
            }

            input[type=text],
            input[type=password] {
                width: 220px;
                padding: 6px 10px;
                border: none;
                border-radius: 4px;
                box-shadow: 0px 0px 2px black;
            }

            input[type=submit] {
                margin-left: 16px;
                color: #229999;
                font-weight: bold;
                padding: 4px 8px;
                border: 1px solid #449999;
                border-bottom-width: 4px;
                border-radius: 4px;
                background: #bbffff;
                background: -moz-linear-gradient(top, #bbffff 0%, #88eeee 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#bbffff), color-stop(100%,#88eeee));
                background: -webkit-linear-gradient(top, #bbffff 0%,#88eeee 100%);
                background: -o-linear-gradient(top, #bbffff 0%,#88eeee 100%);
                background: -ms-linear-gradient(top, #bbffff 0%,#88eeee 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#bbffff', endColorstr='#88eeee',GradientType=0 );
                background: linear-gradient(top, #bbffff 0%,#88eeee 100%);
            }

            input[type=submit]:hover,
            input[type=submit]:focus {
                color: #44CCCC;
            }

            input[type=submit]:active {
                border-width: 0px;
                padding: 7px 9px 5px;
                box-shadow: inset 0px 1px 4px black;
            }

        </style>

        {if $ismobile}
        <link rel="stylesheet" type="text/css" href="/assets/css/x_mobile.css" />
        {/if}

        <script type="text/javascript">



        </script>
        <link href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold" rel="stylesheet" type="text/css" />
    </head>
    <body class="home">

        <h1 id="homelogo"><b>Tränings</b>dagboken</h1>

        <div id="homelogo" class="line"><tt></tt><tt></tt><tt></tt><tt></tt></div>

        <div class="half">

            <h2>Välkommen till<br />Träningsdagboken!</h2>

            <p>
                Här kan du enkelt hålla reda på din<br />träning och mäta din framgång
            </p>

        </div>

        <form action="/login" method="post" class="half">

            <p>
                <input type="text" name="mail" placeholder="Epost" />
            </p>
            <p>
                <input type="password" name="pass" placeholder="Lösenord" />
            </p>

            <div class="half">
                <a href="/reset" style="margin-left: 24px;">Glömt lösenord?</a>
                <a href="/assets/files/traningsdagboken2utovare.pdf" target="_blank" style="margin-left: 24px;">Lathund</a>
            </div>
            <div class="half"><input type="submit" value="Logga in" id="btnlogin" /></div>

        </form>

        <p class="footer">
            About us · Security · Privacy policy · Legal
            <br />
            © 2010 - {$smarty.now|date_format:"%Y"}
        </p>

    </body>
</html>