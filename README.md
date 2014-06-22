Phalcon Bathtub aims at facilitating the initial setup of a [phalcon](http://phalconphp.com/)
project. It uses VirtualBox as hypervisor, Vagrant as a wrapper around it
and Salt as a provisioner for the initial box.

Installation
============

This project assumes that VirtualBox and Vagrant are installed and working
on the host machine.

The installation process is straight forward. All it has to be done is cloning
the repository and run `vagrant up`. Before spinning up the machine, take a look
at the configuration file and adjust the setting to fit your requirements.

Configuration
=============

Project config defines two settings. `project_name` is currently only
used for nginx log names. In the future the development environment
is planned to be more project centric, with folder structure and database
based on `project_name`.

`phalcon_version` defines the version of phalcon that is supposed to be
compiled and installed in the development machine. Use only the version number
to install specific version. Use this [list](https://github.com/phalcon/cphalcon/tags)
as a reference for versions.

```yaml
# Project config
project_name: my-project
phalcon_version: 1.3.2
```

Database config defines the vendor and database name that is supposed to
be created upon installation. Currently only `mariadb` is supported, but
support for `postgres` is planned.

```yaml
# DB config
db_vendor: mariadb
db_name: my_project
```

Memcache can be installed to speed up the php sessions. If `memcached_include`
will be set to `True`, memcache will be installed on the machine and php
sessions will be configured respectively to be saved in memory.

```yaml
# Memcached config
memcached_include: False
memcached_memory: 128
```

Machine comes with installed xdebug. Settings for phpstorm are
predefined. If a different configuration for xdebug is required,
configuration can be changed here

```yaml
# XDebug config
xdebug_idekey: PHPSTORM
xdebug_remote_port: 9000
```

Layout
======

`project` folder is mounted by vagrant at `/srv/project`.

Nginx document root points to `/srv/project/public`.

Nginx logs are located under `/var/log/nginx` with respective
`config['project_name]-access.log` and `config['project_name]-error.log`.

TODO
====
* add support for postgres
* make the setup more project oriented (symlink to `/srv` instead of mounting)
* add images for phpstorm xdebug setup
* provide basic setup for a phalcon app with multi module setup
* improve documentation and list all possible configuration changes, document layout of the machine