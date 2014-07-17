for i in `seq 1 9`; do /usr/bin/curl --max-time 5 https://www.betarigs.com/api/v1/algorithm/$i; echo ""; done > /tmp/allbeta.json
