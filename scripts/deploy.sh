
set -eux -o pipefail

environment="centos_guest,dev"

if [ "$#" -ge 1 ]; then
    environment=$1
fi


find . -name "*.sh" -exec chmod 755 {} \;

su tierjigdocs -c "./scripts/deployAsUser.sh ${environment}"

sh ./autogen/addConfig.sh