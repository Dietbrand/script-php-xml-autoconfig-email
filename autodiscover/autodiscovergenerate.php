<?php
/*
$serverName = $_SERVER['HTTP_HOST'];
$domainName = explode(".",$serverName);
$domainName = array_reverse($domainName);


if (getmxrr("$domainName[1].$domainName[0]",$mxHosts)){
$domainName = "$domainName[1].$domainName[0]";
echo $domainName."<br>";
} elseif (getmxrr("$domainName[2].$domainName[1].$domainName[0]",$mxHosts)){
echo $domainName."<br>";
}
*/

$inputFromAutodiscover = file_get_contents("php://input");
//file_put_contents("test.txt",$inputFromAutodiscover);
$xml = simplexml_load_string($inputFromAutodiscover);
$loginName = $xml->Request[0]->EMailAddress;
$AutodiscoverXML = 
'<?xml version="1.0" encoding="UTF-8"?>
<Autodiscover xmlns="http://schemas.microsoft.com/exchange/autodiscover/responseschema/2006">
<Response xmlns="http://schemas.microsoft.com/exchange/autodiscover/outlook/responseschema/2006a">
<Account>
<AccountType>email</AccountType>
<Action>settings</Action>
<Protocol>
<Type>IMAP</Type>
<Server>imap.mailprotect.be</Server>
<Port>993</Port>
<LoginName>'.$loginName.'</LoginName>
<SPA>off</SPA>
<SSL>on</SSL>
<AuthRequired>on</AuthRequired>
</Protocol>
<Protocol>
<Type>SMTP</Type>
<Server>smtp-auth.mailprotect.be</Server>
<Port>465</Port>
<SPA>off</SPA>
<SSL>on</SSL>
<AuthRequired>on</AuthRequired>
<UsePOPAuth>on</UsePOPAuth>
<SMTPLast>off</SMTPLast>
</Protocol>
</Account>
</Response>
</Autodiscover>';

$output = new SimpleXMLElement($AutodiscoverXML);
echo $output->asXML();
