#!/bin/bash
echo ">> INITIATING SLIPSPACE DEPLOYMENT TO WEBSPACE..."

expect -c '
set timeout -1
spawn rsync -avz --exclude=".git" --exclude="node_modules" -e "ssh -o StrictHostKeyChecking=accept-new" /Users/sascha/wp-ki-labor/html/wp-content/themes/ki-labor/ su72785@access-5019642512.webspace-host.com:~/public/wp-content/themes/ki-labor/
expect {
    "*?assword:*" {
        send "Jessilein@74\r"
        exp_continue
    }
    eof
}
'

echo ">> DEPLOYMENT COMPLETE. SYSTEM IN SYNC."
