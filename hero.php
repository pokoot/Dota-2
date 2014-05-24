<?php

class Hero {

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
        return $heroes;
    }

    /**
        * Get all suggested pics
        *
        * @access public
        * @param mixed $enemyPicks
        * @param mixed $yourPicks
        * @param mixed $banPicks
        * @param mixed $role
        * @return void
        */
    function getSuggestedPicks( $enemyPicks, $yourPicks, $banPicks, $role ){

        $heroes = array();

        $enemyPicks = implode(",", $enemyPicks);

        $yourPicks[] = "0";
        $banPicks   = array_merge( $yourPicks , $banPicks );
        $banPicks  = implode(",", $banPicks);

        if(!$enemyPicks) {
            return $heroes;
        }

        $q = "
                SELECT
                    h.name,
                    h.type,
                    h.role,
                    c.* ,
                    SUM(c.score) as total
                FROM counter AS c
                INNER JOIN hero AS h
                ON c.counter_hero_id = h.id
                WHERE
                    c.hero_id IN ($enemyPicks )
                    AND c.counter_hero_id NOT IN ($banPicks)
                    AND h.role = '$role'
                GROUP BY c.counter_hero_id
                ORDER BY total DESC
                ";


        //print "<pre>$q</pre>";

        $r = mysql_query($q);


        while ($row = mysql_fetch_assoc($r)) {
            $heroes[]  = array(
                'type'  => $row['type'],
                'role'  => $row['role'],
                'name'  => $row["name"],
                'total' => $row["total"]
            );

        }
        return $heroes;

    }

    function getHeroCounter($heroId){

         $heroes = array();

        $q = "
                    SELECT
                        h.name ,
                        h.type ,
                        h.role ,
                        c.*
                    FROM counter AS c
                    INNER JOIN hero AS h
                    ON c.counter_hero_id = h.id
                    WHERE c.hero_id = '$heroId'

                    ";

        //print "<pre>$q</pre>";

        $r = mysql_query($q);


        while ($row = mysql_fetch_assoc($r)) {
            $heroes[]  = array(
                'type'  => $row['type'],
                'role'  => $row['role'],
                'name'  => $row["name"],
                'score' => $row["score"],
                'counter_hero_id' => $row['counter_hero_id']
            );

        }
        return $heroes;

    }


    function displaySuggestedHeroes($heroes){

        foreach( $heroes AS $p ){
            print "<div>{$p['total']} - {$p['name']}</div>";
        }
    }

    function displayAdminCounterList($heroes){

        $html = '';
        foreach( $heroes AS $h ){
            $html .= "
                    <tr>
                        <td>{$h['counter_hero_id']}</td>
                        <td>{$h['name']}</td>
                        <td>{$h['role']}</td>
                        <td>{$h['type']}</td>
                        <td>{$h['score']}</td>
                        <td>
                            <input id='test' type='button' onclick=' deleteCounter({$h['counter_hero_id']},{$h['score']})' value='X'>
                        </td>

                    </tr>
                    ";
        }

        return $html;
    }


    function insertCounter( $heroId, $counterHeroId, $score ){

        $q = "INSERT INTO  counter (hero_id , counter_hero_id ,score) values ($heroId, $counterHeroId, $score )";

        print $q;

        mysql_query($q);

    }


    function deleteCounter($heroId, $counterHeroId, $score ){

        $q = "DELETE FROM counter where hero_id = '$heroId' and counter_hero_id = '$counterHeroId' and score = '$score'  LIMIT 1";

        print $q;

        mysql_query($q);

    }

}
