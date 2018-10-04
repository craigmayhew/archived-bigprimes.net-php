FROM ubuntu:bionic

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get -y update
RUN apt-get -y upgrade
RUN apt-get install -y chromium-browser default-jre git nodejs npm xvfb
RUN apt-get install -y curl php php-dom php-mbstring php-simplexml zip

RUN git clone https://github.com/craigmayhew/bigprimes.net.git
RUN cd bigprimes.net && npm install
RUN cd bigprimes.net && curl --silent --show-error https://getcomposer.org/installer | php
RUN cd bigprimes.net && php composer.phar install

CMD Xvfb :0 -ac -screen 0 1024x768x24 &
RUN cd bigprimes.net && git pull && git checkout master && echo "branch checked out"
CMD cd bigprimes.net && npm run test-nightwatch