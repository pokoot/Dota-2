<?php

    $link = mysql_connect('localhost', 'root', '');
    if (!$link) { die('Could not connect: ' . mysql_error());}


    mysql_select_db('dota', $link);


    $query =  "SELECT * FROM hero ORDER BY name ASC";


    class Hero {

        public $heroes;

        function __construct(){
        }

        function getAll(){

            $q =  "SELECT * FROM hero ORDER BY name ASC";
            $r = mysql_query($q);

            $heroes = array();
            while ($row = mysql_fetch_assoc($r)) {
                $heroes[]  = array(
                    'id'    => $row['id'] ,
                    'type'  => $row['type'],
                    'role'  => $row['role'],
                    'name'  => $row["name"]
                );

            }


            return $this->heroes = $heroes;
        }

    }

    class SelectBox {

        static function create( $name, $value = '' , $options ) {
            $opt = '<option>Please Select</option>';
            foreach( $options AS $o ){
                $sel = ($value == $o['id']) ? 'selected' : '';
                $opt .= "<option value=" . $o['id'] . " $sel >" . $o['name'] . "</option>";
            }
            return "<select name='$name' onchange='submit();' >" . $opt . "</select>";
        }
    }

    $heroes = (new Hero())->getAll();


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


?>
<style type="text/css">
    .col {
        width: 180px;
        float:left;
    }
    .header {
        font-weight: bold;
        padding: 4px 0px 6px 0px;

    }
</style>
<html>

    <form action="index.php" method="post">
    <div>
        <div class="col">
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

         <div class="col">
            <div class="header">Your Pick</div>
            <div><?php print SelectBox::create("enemyPick1", $enemyPick1 , $heroes); ?></div>
            <div><?php print SelectBox::create("enemyPick2", $enemyPick2 , $heroes); ?></div>
            <div><?php print SelectBox::create("enemyPick3", $enemyPick3 , $heroes); ?></div>
            <div><?php print SelectBox::create("enemyPick4", $enemyPick4 , $heroes); ?></div>
            <div><?php print SelectBox::create("enemyPick5", $enemyPick5 , $heroes); ?></div>

            <div class="header">Your Ban</div>
            <div><?php print SelectBox::create("enemyBan1", $enemyBan1 , $heroes); ?></div>
            <div><?php print SelectBox::create("enemyBan2", $enemyBan2 , $heroes); ?></div>
            <div><?php print SelectBox::create("enemyBan3", $enemyBan3 , $heroes); ?></div>
            <div><?php print SelectBox::create("enemyBan4", $enemyBan4 , $heroes); ?></div>
            <div><?php print SelectBox::create("enemyBan5", $enemyBan5 , $heroes); ?></div>
        </div>


    </div>
    </form>

</html>
