node default {
    Exec {
        path => '/usr/local/bin:/bin:/usr/bin:/home/vagrant/bin:/usr/sbin:/sbin'
    }

    file { "/etc/timezone":
        content => "Europe/London\n",
    }

    exec { "timezonesetup":
        command => "dpkg-reconfigure -f noninteractive tzdata",
        require => File["/etc/timezone"]
    }

    Package { require => Exec["apt-get update"] }
    File { require => Exec["apt-get update"] }

    package { "curl":
        ensure => present,
    }

    package { "apache2":
        ensure => present,
    }

    exec { "apt-get update":
        command => "apt-get update",
    }

    $php = ["php5", "php5-dev", "php5-cli", "php5-mysql", "libapache2-mod-php5", "php-pear", "php5-mcrypt", "php5-curl", "php-apc"]
    package { $php: ensure => "installed" }

    exec { "enable ssl":
        command => "sudo a2enmod ssl",
        require => Exec["zend-server"]
    }

    exec { "add ssl port":
        command => "echo 'NameVirtualHost *:443' >> /etc/apache2/ports.conf",
        require => Exec["enable ssl"]
    }

    exec { "add ssl dir":
        command => "mkdir /etc/apache2/ssl",
        require => Exec["add ssl port"]
    }

    package { "imagemagick":
        ensure => installed
    }

    package { "mysql-server":
        ensure => installed
    }

    service { "mysql":
        enable => true,
        ensure => running,
        require => Package["mysql-server"],
    }

    

}
