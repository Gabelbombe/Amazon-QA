#!/bin/bash
# Setup a blind env to work with
 
# CPR : Jd Daniel :: Ehime-ken
# MOD : 2014-06-30 @ 12:14:18
# INP : $ ./base-setup.sh

###############################
###############################

SCRIPT=$(readlink -f "$0")

# Absolute path this script
SCRIPTPATH="$(dirname "$SCRIPT")"
BASEINSTALL="$(echo $SCRIPTPATH |sed 's,/*[^/]\+/*$,,')/"


# Make a conf file for Apache
read -p "Localhost installation? [Y/n]: " LOCAL
[ 'y' == "$(echo ${LOCAL} | awk '{print tolower($0)}')" ] || {
    echo -e "<VirtualHost *:80>\n DocumentRoot   \"${BASEINSTALL}\"\n ServerName     amazon.io\n ServerAlias    www.amazon.io\n\n DirectoryIndex index.php index.html\n\n  <Directory \"${BASEINSTALL}/\">\n      Options Indexes MultiViews\n      AllowOverride All\n      Order allow,deny\n      Allow from all\n  </Directory>\n\n</VirtualHost>" \
    > "${SCRIPTPATH}/amazon-local.conf"
} && {
    echo -e "<VirtualHost *:80>\n DocumentRoot   \"${BASEINSTALL}\"\n\n DirectoryIndex index.php index.html\n\n  <Directory \"${BASEINSTALL}/\">\n      Options Indexes MultiViews\n      AllowOverride All\n      Order allow,deny\n      Allow from all\n  </Directory>\n\n</VirtualHost>" \
    > "${SCRIPTPATH}/amazon-live.conf"
}


# Composer
[ -f 'composer.json' ] && {
    [ -f 'composer.lock' ] && {
        rm -f 'composer.lock'
    }

    [ ! -z "$(hash composer)" ] && {
        curl -sS https://getcomposer.org/installer | php
        mv composer.phar /usr/local/bin/composer
    }

    composer install
}


# Make base directories
for directory in 'public/js' 'public/css' 'public/img' 'src/controller' 'src/database/migration' 'src/database/seed' 'src/model' 'src/tests' 'src/view'; do
    [ ! -d "${directory}" ] && {
        mkdir -p "${directory}"
    }
done


# Ignores
[ ! -f '.composer' ] && {
    echo -e "vendor\ncomposer.lock\n.idea\nshell/*.conf" > .gitignore
}



