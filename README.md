������ �� git https://github.com/Aplear/technomatix

���������� ��������
-------------------
� ���������� ������� ��������� https://github.com/Aplear/technomatix.git

� ������� ��������� �������: composer install 

������: php yii init

��������� ����� �� vagrant � ��������� ������������ Yii2
-------------------
� ���������� /technomatix/vagrant/config/vagrant-local.yml  - ������� ���� ����� GitHub - <github_token>

����� ���������: vagrant up 

���� �� linux ��������� 

��������� �������: sudo nano /etc/hosts

������ ������

� ���� ����� �������: 192.168.83.137  backend.technomatix.loc

��� ���������� �������� ����������: Ctrl + x

�������� ������ ����� �������� �� ������ http://backend.technomatix.loc

������� � vagrant (� �������) � ��������� �������
-------------------

$vagrant ssh

$cd /app

$php yii migrate

$php rbac/init
