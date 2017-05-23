#!/bin/bash

password=$(printf '%b' "${QUERY_STRING//%/\\x}")

# Call buff3r-ov3rfl0w with password
is_valid="$(./buff3r-ov3rfl0w $password)"

# PHP answer
echo "Content-type: text/html"
echo ""
echo "${is_valid}"
