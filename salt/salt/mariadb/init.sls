mariadb_server:
  pkg.installed:
    - name: mariadb-server
  service.running:
    - name: mysql

mariadb_client:
  pkg.installed:
    - name: mariadb-client

python-mysqldb:
  pkg:
    - installed

mysql_db:
  mysql_database.present:
    - name: {{ pillar['db_name'] }}
  require:
    - pkg: python-mysqldb