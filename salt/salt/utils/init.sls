htop:
  pkg:
    - installed

vim:
  pkg:
    - installed

git:
  pkg:
    - installed

strace:
  pkg:
    - installed

unzip:
  pkg:
    - installed

build-essential:
  pkg:
    - installed

# TODO symlink to /srv/project_name and update nginx
#/srv/{{ pillar['project_name'] }}:
#  file.symlink:
#    - target: /opt/project