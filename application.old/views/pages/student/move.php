
<div class="box blue">

    <h1> Flytta </h1>

</div>

<form class="box" method="post" action="/student/move">

    <p>Använd detta förmulär för att initiera en flytt till ny anläggning/grupp.<br /> 
        Ett e-postmeddelande kommer att gå till ansvarig som ser till att flytten blir utförd.<br />
        Observera att flytten inte sker direkt utan sköts manuellt.</p>

    <p>
        Flytta till: <br />
        <select name="schoolselect" id="schoolselect" onchange="getGroups()">
            {foreach $schools as $school}
            <option value="{$school->id}">{$school->title}</option>
            {/foreach}
        </select>
    </p>
    
    <p>
        Eventuell ytterligare information om din flytt:<br />
         <textarea rows="4" cols="50" id="movemessage" name="movemessage"></textarea> 
    </p>

    <p>
        <input type="submit" value="Ok" onclick="return confirm('Är du säker?');" />
    </p>

</form>

<script>

            function getGroups() {
                school_id = document.getElementById("schoolselect").value;

                $.ajax({
                    type: 'POST',
                    url: '/student/ajax_groups/' + school_id,
                    data: {},
                    dataType: 'json',
                    success: function(data) {

                        $("#groupselect").find('option').remove();
                        $.each(data, function(dataKey, dataVal) {
                            console.log(dataVal.title);
                            $("#groupselect").append("<option value='" + dataVal.id + "'>" + dataVal.title + "</option>");
                        });

                        $('input[type="submit"]').removeAttr('disabled');

                    }
                });
            }
</script>