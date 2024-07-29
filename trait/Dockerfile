ARG TAG_iMAGE
FROM php:${TAG_iMAGE}

RUN apk update && apk add --no-cache \
    git \
    curl \
    openssh

COPY --from=composer:2.7.7 /usr/bin/composer /usr/bin/composer

ARG GID
ARG UID

RUN addgroup -g ${GID} group-trait && \
    adduser -D -u ${UID} -G group-trait user-trait

WORKDIR /app
RUN chown -R user-trait:group-trait /app
USER user-trait

CMD [ "php", "-S", "0.0.0.0:9000", "-t", "/app" ]