base:
  '*':
    - utils
    - nginx
    {% if pillar['db_vendor'] == 'mariadb' %}
    - mariadb
    {% endif %}
    {% if pillar['memcached_include'] %}
    - memcached
    {% endif %}
    - php
    - composer