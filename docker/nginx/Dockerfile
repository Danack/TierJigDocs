FROM debian:9-slim

USER root

RUN apt-get update -qq \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y nginx \
    ca-certificates

WORKDIR /var/www

# Set up configuration volumes
RUN mkdir -p /etc/config

# Copy everything to a standard place
COPY ./ /var/www

CMD ["/usr/sbin/nginx", "-c", "/var/www/docker/nginx/config/nginx.conf"]