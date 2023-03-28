<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;


class MailController extends Controller
{
    public function index(){
        $oClient = Client::account('default');
        $oClient->connect();

        //Connect to the IMAP Server

//Get all Mailboxes
        $aFolder = $oClient->getFolders();
//Loop through every Mailbox
        foreach($aFolder as $oFolder){
            //Get all Messages of the current Mailbox $oFolder
            $aMessage = $oFolder->messages()->all()->get();

            foreach($aMessage as $oMessage){
                echo $oMessage->getSubject().'<br />';
                echo 'Attachments: '.$oMessage->getAttachments()->count().'<br />';
                echo $oMessage->getHTMLBody(true);
            }
        }

    }
}
