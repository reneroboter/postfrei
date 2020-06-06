# Postfrei

## Getting started
1. Copy source to target folder e.g /home/myuser/postfrei
1. Edit postfrei.service replace ExecStart path with /home/myuser/postfrei/app.php
1. `cp postfrei.service /etc/systemd/system`
1. `systemctl enable postfrei.service`

## TODO
* Key='wifi-password?!' at postfrei.service 
