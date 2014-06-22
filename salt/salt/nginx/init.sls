nginx:
  pkg:
    - installed
  service.running:
    - require:
      - pkg: nginx
    - watch:
      - file: /etc/nginx/sites-enabled/phalcon-bathtub

/etc/nginx/sites-enabled/default:
  file:
    - absent

/etc/nginx/sites-available/phalcon-bathtub:
  file.managed:
    - source: salt://nginx/config/sites-available/phalcon-bathtub
    - user: root
    - group: root
    - mode: 644
    - template: jinja
    - require:
      - file: /etc/nginx/sites-enabled/default

/etc/nginx/sites-enabled/phalcon-bathtub:
  file.symlink:
    - target: /etc/nginx/sites-available/phalcon-bathtub
    - require:
      - file: /etc/nginx/sites-available/phalcon-bathtub