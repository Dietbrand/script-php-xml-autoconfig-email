# autoconfig-imap
Autoconfig (Thunderbird) and Autodiscover (Outlook for Windows) scripts and xml files

<b>Sources</b>

Autodiscover: https://technet.microsoft.com/en-us/library/cc511507.aspx
Autoconfig: https://developer.mozilla.org/en-US/docs/Mozilla/Thunderbird/Autoconfiguration

<b>Issues</b>

Nginx as the webserver for autodiscover doesn't allow POSTs to static content. needs a hack in the vhost:
location /autodiscover {
error_page 405 =200 $uri;
}
