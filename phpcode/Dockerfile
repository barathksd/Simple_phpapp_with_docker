FROM php:7.4-fpm
ARG uid=1000
ARG user=phpuser
COPY . /code
WORKDIR /code
RUN apt-get update && apt-get install -y \
	git \
	curl \
	libpng-dev \
	libonig-dev \
	libxml2-dev \
	zip \
	unzip
	
RUN apt-get clean

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN useradd -G root -u $uid -d /home/$user $user


#CMD [ "php", "./your-script.php" ]