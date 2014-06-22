#!/bin/bash

WGET=`which wget`
UNZIP=`which unzip`
WORKING_DIR=/opt/phalcon
VERSION=""

function print_help {
    echo ""
    echo "Usage:"
    echo -e "\t-v\tphalcon version"
}

while getopts :v: option
do
    case "${option}"
    in
        v)
            VERSION=${OPTARG}
            ;;
        \?)
            echo "Invalid option: -${OPTARG}"
            print_help
            exit 1
            ;;
        :)
            echo "Option -${OPTARG} requires an argument"
            print_help
            exit 1
            ;;
    esac
done

if [ "${VERSION}" == "" ]; then
    echo "Version was not set, please set phalcon version"
    print_help
    exit 1
fi

if [ "${UNZIP}" == "" ]; then
    echo "unzip was not installed on this machine and is necessary for unpacking the phalcon"
    print_help
    exit 1
fi

cd ${WORKING_DIR}
${WGET} --quiet  https://github.com/phalcon/cphalcon/archive/phalcon-v${VERSION}.zip

if [ "$?" -gt 0 ]; then
    echo "Specified version of phalcon '${VERSION}' cannot be downloaded"
    exit 1
fi

${UNZIP} -q phalcon-v${VERSION}.zip
cd cphalcon-phalcon-v${VERSION}/build
./install
rm -fr ${WORKING_DIR}/cphalcon-phalcon-v${VERSION}
rm ${WORKING_DIR}/phalcon-v${VERSION}.zip

echo "Phalcon was installed correctly"
exit 0