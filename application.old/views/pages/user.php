
<div class="maincol left">
    
    <div class="box blue">
        <h1> Byt lösenord </h1>
    </div>
    <form action="/user/password" class="box" method="post">

        <p>
            Gammalt lösenord: <br />
            <input type="password" name="old" />
        </p>

        <p>
            Nytt lösenord: <br />
            <input type="password" name="new" />
        </p>

        <p>
            Upprepa lösenord: <br />
            <input type="password" name="confirm" />
        </p>

        <p>
            <input type="submit" value="Byt lösenord" />
        </p>

    </form>

    <div class="box blue">
        <h1> Byt epost </h1>
    </div>
    <form action="/user/email" class="box" method="post">

        <p>
            Ny epost: <br />
            <input type="text" name="email" />
        </p>

        <p>
            <input type="submit" value="Byt epost" />
        </p>

    </form>

    <div class="box blue">
        <h1> Byt namn </h1>
    </div>

    <form action="/user/fullname" class="box" method="post">

        <p>
            Nytt fullständigt namn: <br />
            <input type="text" name="fullname" />
        </p>

        <p>
            <input type="submit" value="Byt namn" />
        </p>

    </form>
</div>

{if $pageUser->type == "10"}
<div class="rightcol right">
    <div class="box blue">
        <h1> Länkar </h1>
    </div>
    <div class="box">
        <a href="/assets/files/traningsdagboken2utovare.pdf" target="_blank">Lathund</a><br />
        <a href="/student/plan/{$pageUser->id}">Planering</a><br />
        <a href="/student/coaches/{$pageUser->id}">Mina externa tränare</a><br />
        <a href="/student/move">Flytta</a><br />
    </div>
</div>
{/if}

{if $pageUser->type == "50"}
<div class="rightcol right">
    <div class="box blue">
        <h1> Länkar </h1>
    </div>
    <div class="box">
        <a href="/assets/files/traningsdagboken2tranare.pdf" target="_blank">Lathund</a><br />
        <a href="/external">Externa Utövare</a><br />
    </div>
</div>
{/if}

{if $pageUser->type == "150"}
<div class="rightcol right">
    <div class="box blue">
        <h1> Länkar </h1>
    </div>
    <div class="box">
        <a href="/assets/files/traningsdagboken2ssf.pdf" target="_blank">Lathund</a><br />
    </div>
</div>
{/if}


