Для формирования и отправки письма были использованы билиотеки PEAR (https://pear.php.net/):
Mail 1.3.0 (https://pear.php.net/package/Mail/) и Mail_Mime 1.10.0 (https://pear.php.net/package/Mail_Mime), которые необходимо подключать к ядру php.

Библиотека шаблонизатора (Fenom) и библиотека формирования файла .xls находятся в папке src.

В преременной $patch_file (в index.php) необходимо указть папку куда будут сохраняться файлы отчета в  .xls. По умолчанию это 'C:/WebServers/home/localhost/www/tasks/0_1_2/xls/';