<?php

    include_once "bootstrap.php";
    include_once "hero.php";
    include_once "selectbox.php";


    $query =  "SELECT * FROM hero ORDER BY name ASC";


    $obj = new Hero();
    $heroes = $obj->getAll();


    $yourPick1 = isset( $_POST['yourPick1'] ) ? $_POST['yourPick1'] : '';
    $yourPick2 = isset( $_POST['yourPick2'] ) ? $_POST['yourPick2'] : '';
    $yourPick3 = isset( $_POST['yourPick3'] ) ? $_POST['yourPick3'] : '';
    $yourPick4 = isset( $_POST['yourPick4'] ) ? $_POST['yourPick4'] : '';
    $yourPick5 = isset( $_POST['yourPick5'] ) ? $_POST['yourPick5'] : '';

    $yourBan1 = isset( $_POST['yourBan1'] ) ? $_POST['yourBan1'] : '';
    $yourBan2 = isset( $_POST['yourBan2'] ) ? $_POST['yourBan2'] : '';
    $yourBan3 = isset( $_POST['yourBan3'] ) ? $_POST['yourBan3'] : '';
    $yourBan4 = isset( $_POST['yourBan4'] ) ? $_POST['yourBan4'] : '';
    $yourBan5 = isset( $_POST['yourBan5'] ) ? $_POST['yourBan5'] : '';

    $enemyPick1 = isset( $_POST['enemyPick1'] ) ? $_POST['enemyPick1'] : '';
    $enemyPick2 = isset( $_POST['enemyPick2'] ) ? $_POST['enemyPick2'] : '';
    $enemyPick3 = isset( $_POST['enemyPick3'] ) ? $_POST['enemyPick3'] : '';
    $enemyPick4 = isset( $_POST['enemyPick4'] ) ? $_POST['enemyPick4'] : '';
    $enemyPick5 = isset( $_POST['enemyPick5'] ) ? $_POST['enemyPick5'] : '';

    $enemyBan1 = isset( $_POST['enemyBan1'] ) ? $_POST['enemyBan1'] : '';
    $enemyBan2 = isset( $_POST['enemyBan2'] ) ? $_POST['enemyBan2'] : '';
    $enemyBan3 = isset( $_POST['enemyBan3'] ) ? $_POST['enemyBan3'] : '';
    $enemyBan4 = isset( $_POST['enemyBan4'] ) ? $_POST['enemyBan4'] : '';
    $enemyBan5 = isset( $_POST['enemyBan5'] ) ? $_POST['enemyBan5'] : '';


    $yourPicks = array_filter( array( $yourPick1 , $yourPick2 , $yourPick3 , $yourPick4 , $yourPick5 ) );
    $enemyPicks = array_filter( array( $enemyPick1 , $enemyPick2 , $enemyPick3 , $enemyPick4 , $enemyPick5 ) );

    $banPicks = array_filter( array( $yourBan1 , $yourBan2 , $yourBan3 , $yourBan4 , $yourBan5, $enemyBan1, $enemyBan2, $enemyBan3, $enemyBan4, $enemyBan5) );

    $suggestedPicksCarry    = $obj->getSuggestedPicks( $enemyPicks , $yourPicks, $banPicks, "CARRY");
    $suggestedPicksSupport  = $obj->getSuggestedPicks( $enemyPicks , $yourPicks, $banPicks, "SUPPORT");
    $suggestedPicksMid      = $obj->getSuggestedPicks( $enemyPicks , $yourPicks, $banPicks, "MID");
    $suggestedPicksOfflane  = $obj->getSuggestedPicks( $enemyPicks , $yourPicks, $banPicks, "OFFLANE");
    $suggestedPicksTank     = $obj->getSuggestedPicks( $enemyPicks , $yourPicks, $banPicks, "TANK");


    $suggestedBanCarry      = $obj->getSuggestedPicks( $yourPicks, $enemyPicks , $banPicks, "CARRY");
    $suggestedBanSupport    = $obj->getSuggestedPicks( $yourPicks, $enemyPicks , $banPicks, "SUPPORT");
    $suggestedBanMid        = $obj->getSuggestedPicks( $yourPicks, $enemyPicks , $banPicks, "MID");
    $suggestedBanOfflane    = $obj->getSuggestedPicks( $yourPicks, $enemyPicks , $banPicks, "OFFLANE");
    $suggestedBanTank       = $obj->getSuggestedPicks( $yourPicks, $enemyPicks , $banPicks, "TANK");



?>
<style type="text/css">
    .col {
        float:left;
        padding: 10px;
    }
    .header {
        font-weight: bold;
        padding: 4px 0px 6px 0px;
    }

    .picks {
        float:left;
        padding: 10px;
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

    .red {
        background-color:#FFCCCC;
    }
    .green {
        background-color:#CCFFCC;
    }
    .yellow {
        background-color:#FFFFCC;
    }

</style>
<html>

    <form action="index.php" method="post">
    <div>
        <div style="float:left; height:600px;">
            <div class="col green">
                <div class="header">Your Pick</div>
                <div><?php print SelectBox::create("yourPick1", $yourPick1 , $heroes); ?></div>
                <div><?php print SelectBox::create("yourPick2", $yourPick2 , $heroes); ?></div>
                <div><?php print SelectBox::create("yourPick3", $yourPick3 , $heroes); ?></div>
                <div><?php print SelectBox::create("yourPick4", $yourPick4 , $heroes); ?></div>
                <div><?php print SelectBox::create("yourPick5", $yourPick5 , $heroes); ?></div>

                <div class="header">Your Ban</div>
                <div><?php print SelectBox::create("yourBan1", $yourBan1 , $heroes); ?></div>
                <div><?php print SelectBox::create("yourBan2", $yourBan2 , $heroes); ?></div>
                <div><?php print SelectBox::create("yourBan3", $yourBan3 , $heroes); ?></div>
                <div><?php print SelectBox::create("yourBan4", $yourBan4 , $heroes); ?></div>
                <div><?php print SelectBox::create("yourBan5", $yourBan5 , $heroes); ?></div>
            </div>
            <div class="col red">
                <div class="header">Enemy Pick</div>
                <div><?php print SelectBox::create("enemyPick1", $enemyPick1 , $heroes); ?></div>
                <div><?php print SelectBox::create("enemyPick2", $enemyPick2 , $heroes); ?></div>
                <div><?php print SelectBox::create("enemyPick3", $enemyPick3 , $heroes); ?></div>
                <div><?php print SelectBox::create("enemyPick4", $enemyPick4 , $heroes); ?></div>
                <div><?php print SelectBox::create("enemyPick5", $enemyPick5 , $heroes); ?></div>

                <div class="header">Enemy Ban</div>
                <div><?php print SelectBox::create("enemyBan1", $enemyBan1 , $heroes); ?></div>
                <div><?php print SelectBox::create("enemyBan2", $enemyBan2 , $heroes); ?></div>
                <div><?php print SelectBox::create("enemyBan3", $enemyBan3 , $heroes); ?></div>
                <div><?php print SelectBox::create("enemyBan4", $enemyBan4 , $heroes); ?></div>
                <div><?php print SelectBox::create("enemyBan5", $enemyBan5 , $heroes); ?></div>
            </div>
        </div>

        <div style="float:left;">
            <div class="picks yellow">
                <div class="header">Suggested Picks</div>
                <div class="container">
                    <div class="type">Carry</div>
                    <div><?php $obj->displaySuggestedHeroes( $suggestedPicksCarry ); ?></div>
                </div>
                <div class="container">
                    <div class="type">Support</div>
                    <div><?php $obj->displaySuggestedHeroes( $suggestedPicksSupport ); ?></div>
                </div>
                <div class="container">
                    <div class="type">Mid</div>
                    <div><?php $obj->displaySuggestedHeroes( $suggestedPicksMid); ?></div>
                </div>
                <div class="container">
                    <div class="type">Offlane</div>
                    <div><?php $obj->displaySuggestedHeroes( $suggestedPicksOfflane); ?></div>
                </div>
                <div class="container">
                    <div class="type">Tank</div>
                    <div><?php $obj->displaySuggestedHeroes( $suggestedPicksTank); ?></div>
                </div>
            </div>

            <div class="picks rows">
                <div class="header">Suggested Ban</div>
                <div class="container">
                    <div class="type">Carry</div>
                    <div><?php $obj->displaySuggestedHeroes( $suggestedBanCarry ); ?></div>
                </div>
                <div class="container">
                    <div class="type">Support</div>
                    <div><?php $obj->displaySuggestedHeroes( $suggestedBanSupport ); ?></div>
                </div>
                <div class="container">
                    <div class="type">Mid</div>
                    <div><?php $obj->displaySuggestedHeroes( $suggestedBanMid); ?></div>
                </div>
                <div class="container">
                    <div class="type">Offlane</div>
                    <div><?php $obj->displaySuggestedHeroes( $suggestedBanOfflane); ?></div>
                </div>
                <div class="container">
                    <div class="type">Tank</div>
                    <div><?php $obj->displaySuggestedHeroes( $suggestedBanTank); ?></div>
                </div>
            </div>

        </div>

    </div>
    </form>

</html>
