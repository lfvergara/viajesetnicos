#!/bin/bash

# Supersimple minify script

echo "- Minify admin assets"
curl -X POST -s --data-urlencode 'input@admin/css/wame-random-phone.css' https://cssminifier.com/raw > admin/css/wame-random-phone.min.css
curl -X POST -s --data-urlencode 'input@admin/js/wame-random-phone.js' https://javascript-minifier.com/raw > admin/js/wame-random-phone.min.js
echo "- Minify public assets"
# curl -X POST -s --data-urlencode 'input@public/css/wame-random-phone.css' https://cssminifier.com/raw > public/css/wame-random-phone.min.css
curl -X POST -s --data-urlencode 'input@public/js/wame-random-phone.js' https://javascript-minifier.com/raw > public/js/wame-random-phone.min.js
echo
echo "OK"
echo
exit 0
