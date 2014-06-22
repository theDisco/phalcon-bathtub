php:
  pkg.installed:
    - name: php5-fpm
  service.running:
    - name: php5-fpm
    - require:
      - pkg: php5-dev
      - pkg: php5-fpm
      - pkg: php5-gd
      - pkg: php5-mysqlnd
      - pkg: php5-memcached
      - pkg: php5-mcrypt
      - pkg: php5-curl
      - pkg: php5-cli
      - pkg: php5-xdebug
    - watch:
      - file: /etc/php5/mods-available/xdebug.ini
      - file: /etc/php5/fpm/conf.d/00-php-fpm.ini
      - file: /etc/php5/fpm/conf.d/30-phalcon.ini
      - file: /etc/php5/fpm/php-fpm.conf
      - file: /etc/php5/fpm/pool.d/phalcon-bathtub-pool.conf

php_dev:
  pkg.installed:
    - name: php5-dev

php_gd:
  pkg.installed:
    - name: php5-gd

php_mysqlnd:
  pkg.installed:
    - name: php5-mysqlnd

php_memcache:
  pkg.installed:
    - name: php5-memcached

php_mcrypt:
  pkg.installed:
    - name: php5-mcrypt

php_curl:
  pkg.installed:
    - name: php5-curl

php_cli:
  pkg.installed:
    - name: php5-cli

php_xdebug:
  pkg.installed:
    - name: php5-xdebug

/etc/php5/mods-available/php-fpm.ini:
  file.managed:
    - source: salt://php/config/php-fpm.ini
    - template: jinja
    - user: root
    - group: root
    - mode: 644

/etc/php5/fpm/conf.d/00-php-fpm.ini:
  file.symlink:
      - target: /etc/php5/mods-available/php-fpm.ini
      - require:
        - file: /etc/php5/mods-available/php-fpm.ini

/etc/php5/fpm/php-fpm.conf:
  file.managed:
    - source: salt://php/config/php-fpm.conf
    - user: root
    - group: root
    - mode: 644

/etc/php5/fpm/pool.d/www.conf:
  file:
    - absent

/etc/php5/fpm/pool.d/phalcon-bathtub-pool.conf:
  file.managed:
    - source: salt://php/config/phalcon-bathtub-pool.conf
    - user: root
    - group: root
    - mode: 644
    - require:
      - file: /etc/php5/fpm/pool.d/www.conf

/etc/php5/mods-available/xdebug.ini:
  file.managed:
    - source: salt://php/config/xdebug.ini
    - template: jinja
    - user: root
    - group: root
    - mode: 644

gcc:
  pkg.installed:
    - name: gcc

libpcre3_dev:
  pkg.installed:
    - name: libpcre3-dev

/opt/phalcon:
  file.directory:
    - user: root
    - group: root
    - mode: 775
    - makedirs: True
    - require:
      - pkg: gcc
      - pkg: libpcre3_dev
      - pkg: php_dev
      - pkg: php_mysqlnd

/opt/phalcon/install:
  file.managed:
    - source: salt://php/config/install-phalcon.sh
    - user: root
    - group: root
    - mode: 744
    - require:
      - file: /opt/phalcon

install-phalcon:
  cmd.run:
    - name: './install -v {{ pillar['phalcon_version'] }}'
    - unless: test -f `php-config --extension-dir`/phalcon.so
    - cwd: /opt/phalcon
    - require:
      - file: /opt/phalcon/install

/etc/php5/mods-available/phalcon.ini:
  file.managed:
    - source: salt://php/config/phalcon.ini
    - user: root
    - group: root
    - mode: 644
    - require:
      - cmd: install-phalcon

/etc/php5/fpm/conf.d/30-phalcon.ini:
  file.symlink:
      - target: /etc/php5/mods-available/phalcon.ini
      - require:
        - file: /etc/php5/mods-available/phalcon.ini
        - pkg: php5-fpm

/etc/php5/cli/conf.d/30-phalcon.ini:
  file.symlink:
    - target: /etc/php5/mods-available/phalcon.ini
    - require:
      - file: /etc/php5/mods-available/phalcon.ini