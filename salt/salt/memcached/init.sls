memcached:
  pkg:
    - installed

  service.running:
    - name: memcached
    - require:
      - pkg: memcached
      - file: /etc/memcached.conf
      - file: /var/run/memcached
    - watch:
      - file: /etc/memcached.conf

/var/run/memcached:
  file.directory:
    - user: memcache
    - group: memcache
    - mode: 775
    - makedirs: True

/etc/memcached.conf:
  file.managed:
    - source: salt://memcached/config/memcached.conf
    - template: jinja