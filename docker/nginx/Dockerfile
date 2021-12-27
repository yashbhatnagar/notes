FROM nginx:1.19.8-alpine
COPY ./default.conf /nginx.conf.template
COPY ./entrypoint.sh /entrypoint.sh
CMD ["/bin/sh", "-c", "/entrypoint.sh"]
