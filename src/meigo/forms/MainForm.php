<?php
namespace meigo\forms;

use discord\rpc\KDiscord;
use std, gui, framework, meigo;
use php\lib\str;


class MainForm extends AbstractForm
{

    /**
     * @event start.action 
     */
    function doStartAction(UXEvent $e = null)
    {    
        if (str::isNumber($this->appid->text)){
        
            $appid = $this->appid->text;
            $state = $this->state->text;
            $details = $this->details->text;
        
            $ipc = new KDiscord($appid);
            $ipc->setState($state);
            $ipc->setDetails($details);
            $ipc->updateActivity();
            
         $this->stop->visible = true;
         $this->start->visible = false;
         
         $this->appid->enabled = false;
         $this->details->enabled = false;
         $this->state->enabled = false;
            
        } else {
            alert("Application ID ERROR #1");
        }
    }

    /**
     * @event stop.action 
     */
    function doStopAction(UXEvent $e = null)
    {
         $appid = $this->appid->text;
         $ipc = new KDiscord($appid);
         $ipc->disconnect();
         $this->stop->visible = false;
         $this->start->visible = true;
         
         $this->appid->enabled = true;
         $this->details->enabled = true;
         $this->state->enabled = true;
    }

}
