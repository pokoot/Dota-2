<?php

    include_once "bootstrap.php";
    include_once "hero.php";
    include_once "selectbox.php";


    $obj = new Hero();
    $heroes = $obj->getAll();





    $myHero = isset( $_POST['myHero'] ) ? $_POST['myHero'] : '';


    $counterHero = isset( $_POST['counterHero'] ) ? $_POST['counterHero'] : '';
    $counterScore = isset( $_POST['counterScore'] ) ? $_POST['counterScore'] : '';
    $submit = isset( $_POST['submit'] ) ? $_POST['submit'] : '';



     if (!empty($_POST)){

        if ( $myHero && $counterHero && $counterScore ) {
            $obj->insertCounter( $myHero , $counterHero, $counterScore );
        }
    }





    $counterList = array();
    if($myHero){
        $counterList = $obj->getHeroCounter($myHero);
    }

    $counterScores = array();
    $counterScores[] = array("id" => "1", "name" => "1" );
    $counterScores[] = array("id" => "2", "name" => "2" );
    $counterScores[] = array("id" => "3", "name" => "3" );
    $counterScores[] = array("id" => "4", "name" => "4" );
    $counterScores[] = array("id" => "5", "name" => "5" );





?>
<style type="text/css">
    .col {
        width: 100%;
        float:left;
    }
    .header {
        font-weight: bold;
        padding: 4px 0px 6px 0px;
    }

    .picks {
        float:left;
    }

    .picks .container  {
        width: 180px;
        float: left;
    }
    .picks .type {
        font-weight: bold;
        padding: 4px 0px 6px 0px;
    }

    .rows {
        clear: both;
        margin-top: 50px;

    }


</style>





<html>
<body>


    <script>

/*
        function deleteCounter(counter_hero_id, score){

            document.getElementById("hidden_counter_hero_id").value = counter_hero_id;
            document.getElementById("hidden_score").value = score;
        }
 */


    </script>

    <form action="admin.php" method="post">


    <div>
        <div style="float:left; height:600px;">
            <div class="col">
                <div class="header">
                    Your Pick
                    <?php if ( $myHero ) print ":: " . $myHero ; ?>
                </div>
                <div><?php print SelectBox::create("myHero", $myHero , $heroes); ?></div>





                 <br/><br/>
                <div class="header">Add a Counter</div>
                <div><?php print SelectBox::create("counterHero", $myHero , $heroes , false); ?></div>
                <div><?php print SelectBox::create("counterScore", '' , $counterScores, false); ?></div>









                <br/><br/>
                <div class="header">List of Counters</div>

                <input type="text" id="hidden_counter_hero_id" name="hidden_counter_hero_id">
                <input type="text" id="hidden_score" name="hidden_score">

                <div>
                    <table cellpadding="8" cellspacing="0" border="1">
                        <tr>
                            <th>Hero Id</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Type</th>
                            <th>Score</th>
                            <th>Delete</th>
                        </tr>
                        <?php print $obj->displayAdminCounterList( $counterList );  ?>
                    </table>
                </div>



            </div>

        </div>
    </div>
    </form>
</body>
</html>
