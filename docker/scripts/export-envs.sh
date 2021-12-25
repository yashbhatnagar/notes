touch .env # in case it's not present

ENV=$1

export MYSQL_DATABASE=${DB_DATABASE:-notes_dev}
export MYSQL_ROOT_PASSWORD=${DB_PASSWORD:-root1234}
export MYSQL_PASSWORD=${DB_PASSWORD:-root1234}
export MYSQL_USER=${DB_USERNAME:-admin_user}

export $(cat .env | grep -v "#" | xargs)
