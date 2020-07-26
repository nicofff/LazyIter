#!/bin/bash
set -e
# Ensure that type errors didn't change

composer test:phpstan:types -- --error-format=json > new_errors.json | true

if cmp -s "new_errors.json" "type_errors.json" ; then
   echo "Type errors are the same"
   rm new_errors.json
   exit 0
else
   echo "ERROR: Type erros changed, please review and update type_erros.json"
   rm new_errors.json
   exit 1
fi
