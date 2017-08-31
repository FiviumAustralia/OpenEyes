#!/bin/bash

echo "Adding openeyes user..."
mysql -u root -Bse "CREATE USER '$DATABASE_TEST_USER'@'$DATABASE_TEST_HOST' IDENTIFIED BY '$DATABASE_TEST_PASS';
CREATE DATABASE \`$DATABASE_TEST_NAME\`;
CREATE DATABASE \`$DATABASE_NAME\`;
COMMIT;
GRANT ALL PRIVILEGES ON *.* TO '$DATABASE_TEST_USER'@'$DATABASE_TEST_HOST';
FLUSH PRIVILEGES;"
echo "Done."
echo "Importing sample data..."
mysql $DATABASE_NAME -u root  < protected/modules/sample/sql/openeyes_sample_data.sql
mysql $DATABASE_TEST_NAME -u root < protected/modules/sample/sql/openeyes_sample_data.sql
echo "Done."