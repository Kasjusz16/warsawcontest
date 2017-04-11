<?php

class SendMail
        {
           private  $from, $Bcc, $CC, $headers, $to, $subject, $message, $htmlCodeStart, $htmlCodeEnd;
                            
           function __construct($from ,$CC='', $Bcc='', $html='yes') 
           {
               $this->from=$from;
               $this->Bcc=$Bcc;
               $this->CC=$CC;
               $this->headers='';
               $this->htmlCodeStart='';
               $this->htmlCodeEnd ='';
               
               if($html=='yes')
               {
                    $this->htmlCodeStart='
                            <!DOCTYPE html>
                            <html lang="pl">
                            <head>
                                <meta charset="utf-8">                               
                            </head>
                            <body>
                            ';
               
                    $this->htmlCodeStart='
                            </body>
                            </html>
                            ';
                    $this->headers="MIME-Version: 1.0\r\n";  // tryb ktory tworzy do interpretacji html!
                    $this->headers.="Content-type: text/html; charset=UTF-8\r\n";
               }
               $this->headers.="From:$this->from\r\n";
               if($this->CC !='')
               {
               $this->headers.="CC:$this->CC\r\n";
               }  
               if($this->Bcc !='')
               {
               $this->headers.="Bcc:$this->Bcc\r\n";
               }  
           }   
           
           function send($to, $subject, $message)
           {
               $this->to = $to;
               $this->subject = $subject;
               $this->message=$this->htmlCodeStart;
               $this->message.=$message;
               $this->message.=$this->htmlCodeEnd;
               
               $wyslij = mail($this->to, $this->subject, $this->message, $this->headers);
//               if($wyslij)
//               {
////                   header('location:'.WITRYNA.'?przypomnienie=tak');
//               }
           }
           
        }

