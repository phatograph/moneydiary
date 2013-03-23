<?php

class DoctrineTools extends Controller {

    function  __construct() {
        parent::Controller();
        require_once('./FirePHPCore/fb.php');
    }

    function CreateTables() {
        Doctrine::createTablesFromModels();
        echo 'table(s) created.';
    }

    function LoadFixtures() {
        Doctrine_Manager::connection()->execute('SET FOREIGN_KEY_CHECKS = 0');
        Doctrine_Manager::connection()->execute('SET CHARACTER SET utf8');
        /*
         * disable FOREIGN_KEY_CHECKS to avoid some foreign key related errors
         * during the purge.
        */
        Doctrine::loadData(APPPATH.'/fixtures');
        /*
         * Doctrine:loadData() does the work. Every time it is called,
         * it will purge existing data from the tables, and load the
         * Data Fixtures from the given path. If you don’t want the table purge
         * to happen, you need to pass a second argument as true.
        */
        echo "fixtures loaded.";
    }

    function YAML() {
        //Doctrine::generateYamlFromModels('schema.yml', 'C:\wamp\www\application\models');
        Doctrine::generateYamlFromDb('schema.yml');
        echo "YAML updated";
    }

    function Dropalltables() {
        Doctrine_Manager::connection()->execute('DROP DATABASE phatogra_expense');
        Doctrine_Manager::connection()->execute('CREATE DATABASE phatogra_expense COLLATE utf8_general_ci');

        echo "all tables dropped.";
    }

    function Profiler() {

        // set up the profiler
        
        $profiler = new Doctrine_Connection_Profiler();
        foreach (Doctrine_Manager::getInstance()->getConnections() as $conn) {
            $conn->setListener($profiler);
        }

        // BEGIN QUERY

        $q = Doctrine_Query::create()
                        ->select('ch.*')
                        ->from('ChangeLog ch')
        ;
        $changelogs = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

        $q = Doctrine_Query::create()
                        ->select('chl.*')
                        ->from('ChangeLog_list chl')
        ;
        $changelogs_list = $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);

        for ($i = 0; $i < sizeof($changelogs_list); $i++) {
            $chl_id = $changelogs_list[$i]['changelog_id'];
            for($j = 0; $j < sizeof($changelogs); $j++) {
                if($changelogs[$j]['id'] == $chl_id){
                    $changelogs[$j]['changelog_list'][] = $changelogs_list[$i]; /* append object to array */
                    break;
                }
            }
        }

        $result = $changelogs;

        // END QUERY

        $final = $result;

        // analyze the profiler data
        
        $time = 0;
        $events = array();
        foreach ($profiler as $event) {
            $time += $event->getElapsedSecs();
            if ($event->getName() == 'query' || $event->getName() == 'execute') {
                $event_details = array(
                        "type" => $event->getName(),
                        "query" => $event->getQuery(),
                        "time" => sprintf("%f", $event->getElapsedSecs())
                );
                if (count($event->getParams())) {
                    $event_details["params"] = $event->getParams();
                }
                $events []= $event_details;
            }
        }

        fb($final);
        fb($events);
        fb('Total Doctrine time: " '.$time);
        fb('"Peak Memory: " '.memory_get_peak_usage());
    }

}