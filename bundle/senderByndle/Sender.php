<?php
namespace bundle\senderBundle;

use bundle\Query;
use engine\Bundle;

class Sender extends Bundle {

    private $sqlConfig;

    private $senderTableName = 'senders';

    public function __construct($sqlConfig)
    {
        $this->sqlConfig = $sqlConfig;
    }

    public function getSenders()
    {
        $query = new Query($this->sqlConfig);
        $senders = $query->getAllFromTable($this->senderTableName);

        return $senders;
    }

    public function getSenderById($id)
    {
        $sender = null;
        $query = new Query($this->sqlConfig);
        $senders = $query->getAllFromTable($this->senderTableName);

        foreach ($senders as $senderKey=>$senderInfo){
            if($senderInfo['id'] == $id){
                $sender = $senderInfo;
                break;
            }
        }

        return $sender;
    }
}