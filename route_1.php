// Made By: Jacob Rothschild & Miguel Velasco Espinosa
// PHP for sending data to the database
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>T.S.R.N Form</title>
    <style>
        body {
            background-color: rgb(112, 4, 4);
            text-align: center;
            color: rgb(255, 255, 255)
        }

        h1 {
            font: normal 50px algerian;
        }

        h2 {
            font: normal 30px algerian;
        }

        p {
            font: normal 18px calibri;
        }

        button {
            font: normal 18px calibri;
        }

        input {
            font: normal 18px calibri;
        }
    </style>
</head>

<body>
    <h1>Welcome to the T.S.R.N</h1>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "1234";

        $conn = mysqli_connect($servername, $username, $password);
        $w = mysqli_query($conn, "USE db");
        if (!$conn)
        {
            die("Connection Failed: ".mysqli_connect_error());
        }
        $ti = mysqli_query ($conn, "SELECT ticketN FROM rou WHERE routeN = 1");
        $ti2 = mysqli_query ($conn, "SELECT ticketN FROM rou WHERE routeN = 2");
        $ti3 = mysqli_query ($conn, "SELECT ticketN FROM rou WHERE routeN = 3");
        $ti4 = mysqli_query ($conn, "SELECT ticketN FROM rou WHERE routeN = 4");
        $result = $ti->fetch_array()[0] ?? '';
        $result2 = $ti2->fetch_array()[0] ?? '';
        $result3 = $ti3->fetch_array()[0] ?? '';
        $result4 = $ti4->fetch_array()[0] ?? '';
        
        ?>

    <form action="test.php" method="get">
        <p>
            Which route would you like to go on?
            <br />
            <input name="route" type="radio" value="1" onclick="routeselected(<?php echo $result/2?>, <?php echo $result/2?>)" /> Lubbock->Dallas
            <input name="route" type="radio" value="2" onclick="routeselected(<?php echo $result2/2?>, <?php echo $result2/2?>)" /> Lubbock->Houston
            <input name="route" type="radio" value="3" onclick="routeselected(<?php echo $result3/2?>, <?php echo $result3/2?>)" /> Lubbock->San Antonio
            <input name="route" type="radio" value="4" onclick="routeselected(<?php echo $result4/2?>, <?php echo $result4/2?>)" /> Lubbock->Corpus Christi
            <br /> <br /> <br />

            How many tickets for adults would you like to purchase?
            <select name="numadults" onchange="numadults_changed()" id="numadults">
                <option id="selectnumadults" ; value="">Please select the route first</option>
            </select>
        </p>

        <h2 id="one_adult_heading"></h2>
        <p id="one_adult_paragraph"></p>

        <h2 id="two_adult_heading"></h2>
        <p id="two_adult_paragraph"></p>

        <h2 id="three_adult_heading"></h2>
        <p id="three_adult_paragraph"></p>

        <h2 id="four_adult_heading"></h2>
        <p id="four_adult_paragraph"></p>

        <h2 id="five_adult_heading"></h2>
        <p id="five_adult_paragraph"></p>

        <h2 id="six_adult_heading"></h2>
        <p id="six_adult_paragraph"></p>

        <h2 id="seven_adult_heading"></h2>
        <p id="seven_adult_paragraph"></p>

        <h2 id="eight_adult_heading"></h2>
        <p id="eight_adult_paragraph"></p>

        <h2 id="nine_adult_heading"></h2>
        <p id="nine_adult_paragraph"></p>

        <h2 id="ten_adult_heading"></h2>
        <p id="ten_adult_paragraph"></p>

        <h2 id="eleven_adult_heading"></h2>
        <p id="eleven_adult_paragraph"></p>

        <h2 id="twelve_adult_heading"></h2>
        <p id="twelve_adult_paragraph"></p>

        <h2 id="thirteen_adult_heading"></h2>
        <p id="thirteen_adult_paragraph"></p>

        <h2 id="fourteen_adult_heading"></h2>
        <p id="fourteen_adult_paragraph"></p>

        <h2 id="fifteen_adult_heading"></h2>
        <p id="fifteen_adult_paragraph"></p>


        <p>
            <br /> <br />
            How many tickets for children would you like to purchase?
            <select name="numchildren" onchange="numchildren_changed()" id="numchildren">
                <option id="selectnumchildren" ; value="">Please select the route first</option>
            </select>
        </p>

        <h2 id="one_child_heading"></h2>
        <p id="one_child_paragraph"></p>

        <h2 id="two_child_heading"></h2>
        <p id="two_child_paragraph"></p>

        <h2 id="three_child_heading"></h2>
        <p id="three_child_paragraph"></p>

        <h2 id="four_child_heading"></h2>
        <p id="four_child_paragraph"></p>

        <h2 id="five_child_heading"></h2>
        <p id="five_child_paragraph"></p>

        <h2 id="six_child_heading"></h2>
        <p id="six_child_paragraph"></p>

        <h2 id="seven_child_heading"></h2>
        <p id="seven_child_paragraph"></p>

        <h2 id="eight_child_heading"></h2>
        <p id="eight_child_paragraph"></p>

        <h2 id="nine_child_heading"></h2>
        <p id="nine_child_paragraph"></p>

        <h2 id="ten_child_heading"></h2>
        <p id="ten_child_paragraph"></p>

        <h2 id="eleven_child_heading"></h2>
        <p id="eleven_child_paragraph"></p>

        <h2 id="twelve_child_heading"></h2>
        <p id="twelve_child_paragraph"></p>

        <h2 id="thirteen_child_heading"></h2>
        <p id="thirteen_child_paragraph"></p>

        <h2 id="fourteen_child_heading"></h2>
        <p id="fourteen_child_paragraph"></p>

        <h2 id="fifteen_child_heading"></h2>
        <p id="fifteen_child_paragraph"></p>

        <p id="test"></p>

        <input type="Submit" name="Submit" value="Submit" />
    </form>

    <script>
        function routeselected(max_num_adults, max_num_children) {
            var x = document.getElementById("selectnumadults");
            var y = document.getElementById("selectnumchildren");

            if (x) {
                x.text = "Please select an option";
            }

            if (y) {
                y.text = "Please select an option";
            }

            var numadultsoptions = document.getElementById("numadults");

            var current_max_num_adults = numadultsoptions.lastElementChild.value;

            if (current_max_num_adults == "") {
                current_max_num_adults = 0;
            }


            if (current_max_num_adults < max_num_adults) {
                var i = parseInt(current_max_num_adults) + 1;
                for (i; i <= max_num_adults; i++) {
                    var option = document.createElement("option");
                    option.value = i;
                    option.text = i;
                    option.id = "adultoption" + i;
                    numadultsoptions.add(option);
                }
            }

            else {
                for (var i = current_max_num_adults; i > max_num_adults; i--) {
                    var option = document.getElementById("adultoption" + i);
                    option.remove();
                }
            }

            if(max_num_adults == 0){
                if(x){
                    x.remove();
                }

                var option = document.createElement("option");
                option.value = 0;
                option.text = "tickets are sold out";
                option.id = "adultoptionso";
                numadultsoptions.add(option);
            }

            else{
                var adultssoldout = document.getElementById("adultoptionso");

                if(adultssoldout){
                    adultssoldout.remove();
                }
            }


            var numchildrenoptions = document.getElementById("numchildren");

            var current_max_num_children = numchildrenoptions.lastElementChild.value;

            if (current_max_num_children == "") {
                current_max_num_children = 0;
            }

            if (current_max_num_children < max_num_children) {
                if (current_max_num_children != 0) {
                    var i = parseInt(current_max_num_children) + 1;
                }

                else {
                    var i = parseInt(current_max_num_children);
                }

                for (i; i <= max_num_children; i++) {
                    var option = document.createElement("option");
                    option.value = i;
                    option.text = i;
                    option.id = "childoption"+i;
                    numchildrenoptions.add(option);
                }
            }

            else {
                for (var i = current_max_num_children; i > max_num_children; i--) {
                    var option = document.getElementById("childoption" + i);
                    option.remove();
                }
            }

            z = document.getElementById("childoption0");
            if(max_num_children == 0){
                if(y){
                    y.remove();
                }

                if(z){
                    z.remove();
                }

                var option = document.createElement("option");
                option.value = 0;
                option.text = "tickets are sold out";
                option.id = "childoptionso";
                numchildrenoptions.add(option);
            }

            else{
                var childrensoldout = document.getElementById("childoptionso");

                if(childrensoldout){
                    childrensoldout.remove();
                }
            }

        }

        function numadults_changed() {
            // Sees if the "Please select an option" option has not been removed.
            var x = document.getElementById("selectnumadults");
            var numadults = document.querySelector("#numadults").value;

            // Remove "Please select an option" option when a number is selected.
            if (x) {
                x.remove();
            }


            var adults = new Change(["one_adult_heading", "two_adult_heading", "three_adult_heading", "four_adult_heading", "five_adult_heading", "six_adult_heading", "seven_adult_heading", "eight_adult_heading",
                "nine_adult_heading", "ten_adult_heading", "eleven_adult_heading", "twelve_adult_heading", "thirteen_adult_heading", "fourteen_adult_heading", "fifteen_adult_heading"],
                ["one_adult_paragraph", "two_adult_paragraph", "three_adult_paragraph", "four_adult_paragraph", "five_adult_paragraph", "six_adult_paragraph", "seven_adult_paragraph", "eight_adult_paragraph",
                    "nine_adult_paragraph", "ten_adult_paragraph", "eleven_adult_paragraph", "twelve_adult_paragraph", "thirteen_adult_paragraph", "fourteen_adult_paragraph", "fifteen_adult_paragraph"], "adult");

            adults.add(numadults);
        }

        function numchildren_changed() {
            var x = document.getElementById("selectnumchildren");

            if (x) {
                x.remove();
            }

            var numchildren = document.querySelector("#numchildren").value;

            var children = new Change(["one_child_heading", "two_child_heading", "three_child_heading", "four_child_heading", "five_child_heading", "six_child_heading", "seven_child_heading", "eight_child_heading",
                "nine_child_heading", "ten_child_heading", "eleven_child_heading", "twelve_child_heading", "thirteen_child_heading", "fourteen_child_heading", "fifteen_child_heading"],
                ["one_child_paragraph", "two_child_paragraph", "three_child_paragraph", "four_child_paragraph", "five_child_paragraph", "six_child_paragraph", "seven_child_paragraph", "eight_child_paragraph",
                    "nine_child_paragraph", "ten_child_paragraph", "eleven_child_paragraph", "twelve_child_paragraph", "thirteen_child_paragraph", "fourteen_child_paragraph", "fifteen_child_paragraph"], "child");


            children.add(numchildren);
        }

        class Change {
            constructor(idh, idp, type) {
                this.idh = idh;
                this.idp = idp;
                this.type = type;
            }

            add(num) {
                for (var a = 0; a < num; a++) {
                    this.add_enter_name(this.idh[a], this.idp[a], a + 1);
                }

                for (var a = num; a < this.idh.length && a < this.idp.length; a++) {
                    this.remove_paragraph_heading(this.idh[a], this.idp[a]);
                }
            }

            reset() {
                var i = 0;

                for (i; i < length(idh) && i < length(idp); i++) {
                    this.remove_paragraph_heading(this.idh[i], this.idp[i]);
                }
            }

            add_enter_name(heading, paragraph, num) {
                document.getElementById(heading).innerHTML = this.type.toUpperCase() + " " + num;
                document.getElementById(paragraph).innerHTML = "Enter the first name of " + this.type + " " + num + ": <input type='text' name= 'fn" + this.type + num + "'/>" +
                    "<br /> <br /> Enter the last name of " + this.type + " " + num + ": <input type='text'" + "name='ln" + this.type + num + "'/>";
            }

            remove_paragraph_heading(h, p) {
                document.getElementById(h).innerHTML = "";
                document.getElementById(p).innerHTML = "";
            }
        }


    </script>

</body>

</html>
