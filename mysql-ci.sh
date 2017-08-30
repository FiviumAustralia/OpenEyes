#!/bin/bash

echo "Adding openeyes user..."
mysql -u root
CREATE USER $DATABASE_TEST_USER@$DATABASE_TEST_HOST IDENTIFIED BY password($DATABASE_TEST_PASS);
COMMIT;
GRANT ALL PRIVILEGES ON *.* TO $DATABASE_TEST_USER@$DATABASE_TEST_HOST;
FLUSH PRIVILEGES;
exit;
echo "Done."
echo "Importing sample data..."
mysql -u $DATABASE_TEST_USER -p$DATABASE_TEST_PASS < protected/modules/sample/sql/openeyes_sample_data.sql
echo "Done."